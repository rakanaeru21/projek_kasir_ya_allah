<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    public function index()
    {
        // Hanya kasir yang bisa mengakses
        if (Auth::user()->role !== 'kasir') {
            abort(403, 'Unauthorized');
        }

        // Ambil semua transaksi dengan relasi detail dan produk, urutkan dari yang terbaru
        $transaksis = Transaksi::with(['details.produk'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('kasir.history', compact('transaksis'));
    }

    public function show($id)
    {
        // Hanya kasir yang bisa mengakses
        if (Auth::user()->role !== 'kasir') {
            abort(403, 'Unauthorized');
        }

        // Ambil detail transaksi
        $transaksi = Transaksi::with(['details.produk'])->findOrFail($id);

        return view('kasir.history-detail', compact('transaksi'));
    }

    /**
     * Helper function untuk konversi status database ke status display
     */
    private function convertStatus($dbStatus)
    {
        switch ($dbStatus) {
            case 'completed':
                return 'selesai';
            case 'cancelled':
                return 'batal';
            default:
                return 'pending';
        }
    }
}
