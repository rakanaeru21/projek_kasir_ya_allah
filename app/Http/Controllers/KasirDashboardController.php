<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KasirDashboardController extends Controller
{
    public function index()
    {
        // Hanya kasir yang bisa mengakses
        if (Auth::user()->role !== 'kasir') {
            abort(403, 'Unauthorized');
        }

        // Statistik untuk kasir yang sedang login
        $totalTransaksiHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->count();

        $totalPenjualanHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->sum('total_amount');

        $totalItemTerjualHariIni = TransaksiDetail::join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->whereDate('transaksis.created_at', Carbon::today())
            ->where('transaksis.status', 'completed')
            ->where('transaksis.user_id', Auth::id())
            ->sum('transaksi_details.quantity');

        return view('kasir.dashboard', compact(
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'totalItemTerjualHariIni'
        ));
    }
}
