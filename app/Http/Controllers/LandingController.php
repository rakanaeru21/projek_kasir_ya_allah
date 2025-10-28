<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Promo;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil data untuk landing page
        $featuredProducts = Produk::where('status', 'aktif')
            ->where('stok', '>', 0)
            ->take(6)
            ->get();

        // Menggunakan scope active yang sudah didefinisikan di model Promo
        $activePromos = Promo::active()
            ->take(3)
            ->get();

        $totalProducts = Produk::where('status', 'aktif')->count();
        $totalTransactions = Transaksi::count();

        return view('landing', compact(
            'featuredProducts',
            'activePromos',
            'totalProducts',
            'totalTransactions'
        ));
    }
}
