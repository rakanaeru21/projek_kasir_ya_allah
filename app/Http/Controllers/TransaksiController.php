<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Tampilkan halaman transaksi kasir
     */
    public function index()
    {
        // Ambil semua produk yang tersedia (stok > 0)
        $produks = Produk::where('stok', '>', 0)->orderBy('nama_produk', 'asc')->get();

        return view('kasir.transaksi', compact('produks'));
    }

    /**
     * Proses transaksi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
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

        try {
            // Mulai database transaction
            DB::beginTransaction();

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
                    'quantity' => $item['quantity'],
                    'harga_satuan' => $item['price'],
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

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Cari produk berdasarkan nama atau kode
     */
    public function searchProduct(Request $request)
    {
        $search = $request->get('search');

        $produks = Produk::where('stok', '>', 0)
            ->where(function($query) use ($search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                      ->orWhere('kode_produk', 'like', "%{$search}%");
            })
            ->orderBy('nama_produk', 'asc')
            ->get();

        return response()->json($produks);
    }

    /**
     * Get product details by ID
     */
    public function getProduct($id)
    {
        $produk = Produk::findOrFail($id);

        return response()->json([
            'id' => $produk->id,
            'nama' => $produk->nama_produk,
            'harga' => $produk->harga_untung,
            'stok' => $produk->stok,
            'deskripsi' => $produk->deskripsi
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
}
