<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * Tampilkan halaman transaksi kasir
     */
    public function index()
    {
        // Ambil semua produk yang tersedia (stok > 0) dengan promo info
        $produks = Produk::with('promos')->where('stok', '>', 0)->orderBy('nama_produk', 'asc')->get();

        // Update harga diskon untuk setiap produk berdasarkan promo aktif
        foreach ($produks as $produk) {
            $produk->updateDiscountPrice();
        }

        return view('kasir.transaksi', compact('produks'));
    }

    /**
     * Proses transaksi baru
     */
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Transaction store request received', [
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'data' => $request->all(),
            'user_id' => Auth::id(),
            'user_role' => Auth::user()->role ?? 'guest'
        ]);

        try {
            $validatedData = $request->validate([
                'customer_name' => 'required|string|max:255',
                'member_phone' => 'nullable|string|max:15',
                'payment_method' => 'required|in:cash,card,transfer',
                'items' => 'required|array|min:1',
                'items.*.id' => 'required|exists:produks,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.price' => 'required|numeric|min:0',
                'subtotal' => 'required|numeric|min:0',
                'tax' => 'required|numeric|min:0',
                'total_amount' => 'required|numeric|min:0',
                'cash_amount' => 'nullable|numeric|min:0',
            ]);

            Log::info('Validation passed', ['validated_data' => $validatedData]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            // Mulai database transaction
            DB::beginTransaction();

            // Cek apakah ada member berdasarkan nomor telepon
            $member = null;
            if ($request->member_phone) {
                $member = User::where('role', 'pengguna')
                            ->where('nomor_telepon', $request->member_phone)
                            ->first();
            }

            // Validasi stok produk
            foreach ($request->items as $item) {
                $produk = Produk::findOrFail($item['id']);
                if ($produk->stok < $item['quantity']) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi! Stok tersedia: {$produk->stok}");
                }
            }

            // Generate kode transaksi
            $kodeTransaksi = Transaksi::generateKodeTransaksi();

            // Hitung kembalian jika pembayaran tunai
            $changeAmount = null;
            if ($request->payment_method === 'cash' && $request->cash_amount) {
                $changeAmount = $request->cash_amount - $request->total_amount;
            }

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => $kodeTransaksi,
                'user_id' => Auth::id(),
                'member_id' => $member ? $member->id : null, // Simpan member_id jika ada
                'customer_name' => $request->customer_name,
                'payment_method' => $request->payment_method,
                'subtotal' => $request->subtotal,
                'tax' => $request->tax,
                'total_amount' => $request->total_amount,
                'cash_amount' => $request->cash_amount,
                'change_amount' => $changeAmount,
                'status' => 'completed',
            ]);

            // Simpan detail transaksi dan kurangi stok produk
            foreach ($request->items as $item) {
                $produk = Produk::findOrFail($item['id']);

                // Simpan detail transaksi
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['id'],
                    'nama_produk' => $produk->nama_produk,
                    'kategori_produk' => $produk->kategori,
                    'quantity' => $item['quantity'],
                    'harga' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Kurangi stok produk
                $produk->decrement('stok', $item['quantity']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil diproses!',
                'kode_transaksi' => $kodeTransaksi,
                'transaksi_id' => $transaksi->id,
                'total_amount' => $request->total_amount,
                'change_amount' => $changeAmount
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Transaction store error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error_details' => [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'type' => get_class($e)
                ]
            ], 500);
        }
    }

    /**
     * Cari produk berdasarkan nama atau kode
     */
    public function searchProduct(Request $request)
    {
        $search = $request->get('search');

        $produks = Produk::with('promos')->where('stok', '>', 0)
            ->where(function($query) use ($search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                      ->orWhere('kode_produk', 'like', "%{$search}%");
            })
            ->orderBy('nama_produk', 'asc')
            ->get();

        // Update harga diskon untuk setiap produk
        foreach ($produks as $produk) {
            $produk->updateDiscountPrice();
        }

        return response()->json($produks);
    }

    /**
     * Get product details by ID
     */
    public function getProduct($id)
    {
        $produk = Produk::with('promos')->findOrFail($id);

        // Update harga diskon berdasarkan promo aktif
        $produk->updateDiscountPrice();

        // Get promo info
        $promoInfo = $produk->getActivePromoInfo();

        return response()->json([
            'id' => $produk->id,
            'nama' => $produk->nama_produk,
            'harga' => $produk->getFinalPrice(), // Gunakan harga final (diskon atau normal)
            'harga_normal' => $produk->harga_untung,
            'harga_diskon' => $produk->harga_diskon,
            'stok' => $produk->stok,
            'deskripsi' => $produk->deskripsi,
            'promo_info' => $promoInfo
        ]);
    }

    /**
     * Validasi stok produk
     */
    public function checkStock(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:produks,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $stockErrors = [];

        foreach ($request->items as $item) {
            $produk = Produk::findOrFail($item['id']);
            if ($produk->stok < $item['quantity']) {
                $stockErrors[] = [
                    'product_id' => $item['id'],
                    'product_name' => $produk->nama_produk,
                    'requested' => $item['quantity'],
                    'available' => $produk->stok
                ];
            }
        }

        return response()->json([
            'valid' => empty($stockErrors),
            'errors' => $stockErrors
        ]);
    }

    /**
     * Check member by phone number
     */
    public function checkMember(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        try {
            // Cari user dengan role 'pengguna' berdasarkan nomor telepon
            $member = User::where('role', 'pengguna')
                          ->where('nomor_telepon', $request->phone)
                          ->first();

            if ($member) {
                return response()->json([
                    'success' => true,
                    'member' => [
                        'id' => $member->id,
                        'nama' => $member->nama,
                        'email' => $member->email,
                        'created_at' => $member->created_at->format('d/m/Y')
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Member tidak ditemukan'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cetak struk transaksi
     */
    public function printReceipt($id)
    {
        // Hanya kasir yang bisa mengakses
        if (Auth::user()->role !== 'kasir') {
            abort(403, 'Unauthorized');
        }

        // Ambil detail transaksi hanya jika milik kasir yang sedang login
        $transaksi = Transaksi::with(['details.produk', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // Return view khusus untuk print
        return view('kasir.print-receipt', compact('transaksi'));
    }
}
