<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{

    /**
     * Dashboard pengguna
     */
    public function dashboard()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Statistik transaksi pengguna (termasuk transaksi sebagai member)
        $totalTransaksi = Transaksi::where(function($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhere('member_id', $userId);
        })->count();

        $totalBelanja = Transaksi::where(function($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhere('member_id', $userId);
        })->sum('total_amount');

        $transaksiTerbaru = Transaksi::where(function($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhere('member_id', $userId);
        })
        ->with(['user', 'member']) // Load relasi kasir dan member
        ->latest()
        ->limit(3)
        ->get();

        // Item di keranjang
        $cartCount = count(Session::get('cart', []));

        return view('pengguna.dashboard', compact(
            'user',
            'totalTransaksi',
            'totalBelanja',
            'transaksiTerbaru',
            'cartCount'
        ));
    }

    /**
     * Daftar produk untuk pengguna
     */
    public function produk(Request $request)
    {
        $query = Produk::where('status', 'aktif')
            ->where('stok', '>', 0);

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Pencarian
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_produk', 'like', "%{$searchTerm}%")
                  ->orWhere('kode_produk', 'like', "%{$searchTerm}%")
                  ->orWhere('deskripsi', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'nama_produk');
        $sortOrder = $request->get('order', 'asc');

        if (in_array($sortBy, ['nama_produk', 'harga_untung', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $produks = $query->paginate(12);

        // Dapatkan semua kategori untuk filter
        $categories = Produk::where('status', 'aktif')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->sort();

        // Update harga diskon jika ada promo
        foreach ($produks as $produk) {
            $produk->updateDiscountPrice();
        }

        return view('pengguna.produk', compact('produks', 'categories'));
    }

    /**
     * Detail produk
     */
    public function detailProduk($id)
    {
        $produk = Produk::where('status', 'aktif')
            ->where('stok', '>', 0)
            ->findOrFail($id);

        $produk->updateDiscountPrice();

        // Produk terkait (kategori sama)
        $produkTerkait = Produk::where('kategori', $produk->kategori)
            ->where('id', '!=', $produk->id)
            ->where('status', 'aktif')
            ->where('stok', '>', 0)
            ->limit(4)
            ->get();

        return view('pengguna.detail-produk', compact('produk', 'produkTerkait'));
    }

    /**
     * Tambah ke keranjang
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $produk = Produk::where('id', $request->produk_id)
            ->where('status', 'aktif')
            ->first();

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan atau sudah tidak aktif'
            ]);
        }

        // Cek stok
        if ($produk->stok < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $produk->stok
            ]);
        }

        // Update harga diskon
        $produk->updateDiscountPrice();

        // Ambil keranjang dari session
        $cart = Session::get('cart', []);

        $productKey = $produk->id;

        if (isset($cart[$productKey])) {
            // Jika produk sudah ada, tambah quantity
            $newQuantity = $cart[$productKey]['quantity'] + $request->quantity;

            if ($newQuantity > $produk->stok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total quantity melebihi stok. Stok tersedia: ' . $produk->stok
                ]);
            }

            $cart[$productKey]['quantity'] = $newQuantity;
        } else {
            // Jika produk baru, tambah ke keranjang
            $cart[$productKey] = [
                'id' => $produk->id,
                'nama_produk' => $produk->nama_produk,
                'kode_produk' => $produk->kode_produk,
                'harga' => $produk->getFinalPrice(),
                'harga_normal' => $produk->harga_untung,
                'quantity' => $request->quantity,
                'stok' => $produk->stok,
                'gambar' => $produk->gambar,
                'promo_info' => $produk->getActivePromoInfo()
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => count($cart)
        ]);
    }

    /**
     * Lihat keranjang
     */
    public function keranjang()
    {
        $cart = Session::get('cart', []);

        // Update informasi produk di keranjang
        foreach ($cart as $key => $item) {
            $produk = Produk::where('id', $item['id'])
                ->where('status', 'aktif')
                ->first();
                
            if ($produk) {
                $produk->updateDiscountPrice();
                $cart[$key]['harga'] = $produk->getFinalPrice();
                $cart[$key]['stok'] = $produk->stok;
                $cart[$key]['promo_info'] = $produk->getActivePromoInfo();

                // Cek jika quantity melebihi stok
                if ($item['quantity'] > $produk->stok) {
                    $cart[$key]['quantity'] = $produk->stok;
                }
            } else {
                // Produk tidak ditemukan atau sudah nonaktif, hapus dari keranjang
                unset($cart[$key]);
            }
        }

        Session::put('cart', $cart);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['harga'] * $item['quantity'];
        }

        $tax = $subtotal * 0.1; // PPN 10%
        $total = $subtotal + $tax;

        return view('pengguna.keranjang', compact('cart', 'subtotal', 'tax', 'total'));
    }

    /**
     * Update keranjang
     */
    public function updateCart(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|integer',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = Session::get('cart', []);
        $productKey = $request->produk_id;

        if ($request->quantity == 0) {
            // Hapus item jika quantity 0
            unset($cart[$productKey]);
        } else {
            // Update quantity
            if (isset($cart[$productKey])) {
                $produk = Produk::where('id', $productKey)
                    ->where('status', 'aktif')
                    ->first();

                if (!$produk) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Produk sudah tidak aktif dan dihapus dari keranjang'
                    ]);
                }

                if ($request->quantity <= $produk->stok) {
                    $cart[$productKey]['quantity'] = $request->quantity;
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Quantity melebihi stok tersedia'
                    ]);
                }
            }
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diupdate',
            'cart_count' => count($cart)
        ]);
    }

    /**
     * Hapus dari keranjang
     */
    public function removeFromCart($produk_id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$produk_id]);
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang',
            'cart_count' => count($cart)
        ]);
    }

    /**
     * Kosongkan keranjang
     */
    public function clearCart()
    {
        Session::forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }

    /**
     * Halaman checkout
     */
    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('pengguna.produk')
                ->with('error', 'Keranjang kosong. Silakan pilih produk terlebih dahulu.');
        }

        // Update informasi produk dan cek stok serta status
        foreach ($cart as $key => $item) {
            $produk = Produk::where('id', $item['id'])
                ->where('status', 'aktif')
                ->first();
                
            if (!$produk) {
                return redirect()->route('pengguna.keranjang')
                    ->with('error', 'Ada produk yang sudah tidak aktif. Silakan periksa keranjang.');
            }
            
            if ($produk->stok < $item['quantity']) {
                return redirect()->route('pengguna.keranjang')
                    ->with('error', 'Ada produk yang stoknya tidak mencukupi. Silakan periksa keranjang.');
            }
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['harga'] * $item['quantity'];
        }

        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        return view('pengguna.checkout', compact('cart', 'subtotal', 'tax', 'total'));
    }

    /**
     * Proses checkout
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'payment_method' => 'required|in:cash,transfer,card',
            'notes' => 'nullable|string|max:1000'
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong'
            ]);
        }

        DB::beginTransaction();

        try {
            // Cek stok dan status semua produk
            foreach ($cart as $item) {
                $produk = Produk::lockForUpdate()
                    ->where('id', $item['id'])
                    ->where('status', 'aktif')
                    ->first();
                    
                if (!$produk) {
                    throw new \Exception("Produk {$item['nama_produk']} sudah tidak aktif atau tidak ditemukan");
                }
                
                if ($produk->stok < $item['quantity']) {
                    throw new \Exception("Stok produk {$item['nama_produk']} tidak mencukupi");
                }
            }

            // Hitung total
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['harga'] * $item['quantity'];
            }
            $tax = $subtotal * 0.1;
            $total = $subtotal + $tax;

            // Buat transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX' . date('YmdHis') . rand(100, 999),
                'member_id' => Auth::id(), // Member yang melakukan transaksi
                'customer_name' => $request->customer_name,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total_amount' => $total,
                'status' => 'waiting_confirmation', // Perlu konfirmasi kasir
                'notes' => $request->notes
            ]);

            // Buat detail transaksi (stok belum dikurangi karena masih menunggu konfirmasi)
            foreach ($cart as $item) {
                $produk = Produk::find($item['id']);

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['id'],
                    'nama_produk' => $produk ? $produk->nama_produk : 'Produk Tidak Ditemukan',
                    'kategori_produk' => $produk ? $produk->kategori : 'Tidak Diketahui',
                    'quantity' => $item['quantity'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['harga'] * $item['quantity']
                ]);

                // Stok akan dikurangi setelah kasir konfirmasi transaksi
            }

            // Kosongkan keranjang
            Session::forget('cart');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil diproses',
                'transaksi_id' => $transaksi->id,
                'kode_transaksi' => $transaksi->kode_transaksi
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Transaksi gagal: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * History transaksi pengguna
     */
    public function history(Request $request)
    {
        $userId = Auth::id();

        // Ambil transaksi dimana user adalah pembeli langsung ATAU sebagai member
        $query = Transaksi::where(function($q) use ($userId) {
                $q->where('user_id', $userId)  // Transaksi yang dibuat langsung oleh user
                  ->orWhere('member_id', $userId); // Transaksi kasir dimana user sebagai member
            })
            ->with(['details.produk', 'user']) // Tambahkan relasi ke kasir yang melayani
            ->latest();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transaksis = $query->paginate(10);

        return view('pengguna.history', compact('transaksis'));
    }

    /**
     * Detail transaksi
     */
    public function detailHistory($id)
    {
        $userId = Auth::id();

        $transaksi = Transaksi::where(function($q) use ($userId) {
                $q->where('user_id', $userId)  // Transaksi yang dibuat langsung oleh user
                  ->orWhere('member_id', $userId); // Transaksi kasir dimana user sebagai member
            })
            ->with(['details.produk', 'user', 'member']) // Tambahkan relasi ke member dan kasir
            ->findOrFail($id);

        return view('pengguna.detail-history', compact('transaksi'));
    }

    /**
     * Get cart count untuk ajax
     */
    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        return response()->json(['count' => count($cart)]);
    }
}
