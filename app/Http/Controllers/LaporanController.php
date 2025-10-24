<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Set default filter untuk hari ini jika tidak ada parameter
        $tanggalMulai = $request->get('tanggal_mulai', Carbon::today()->format('Y-m-d'));
        $tanggalSelesai = $request->get('tanggal_selesai', Carbon::today()->format('Y-m-d'));
        $periode = $request->get('periode', 'harian');

        // Statistik Umum - hanya transaksi kasir yang sedang login
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

        // Transaksi berdasarkan periode yang dipilih - hanya dari kasir yang sedang login
        $transaksis = Transaksi::with(['details.produk'])
            ->whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai)
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Total berdasarkan filter periode - hanya dari kasir yang sedang login
        $totalTransaksiPeriode = Transaksi::whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai)
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->count();

        $totalPenjualanPeriode = Transaksi::whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai)
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->sum('total_amount');

        $totalItemTerjualPeriode = TransaksiDetail::join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->whereDate('transaksis.created_at', '>=', $tanggalMulai)
            ->whereDate('transaksis.created_at', '<=', $tanggalSelesai)
            ->where('transaksis.status', 'completed')
            ->where('transaksis.user_id', Auth::id())
            ->sum('transaksi_details.quantity');

        // Produk terlaris periode ini - hanya dari kasir yang sedang login
        $produkTerlaris = DB::table('transaksi_details')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->join('produks', 'transaksi_details.produk_id', '=', 'produks.id')
            ->whereDate('transaksis.created_at', '>=', $tanggalMulai)
            ->whereDate('transaksis.created_at', '<=', $tanggalSelesai)
            ->where('transaksis.status', 'completed')
            ->where('transaksis.user_id', Auth::id())
            ->select(
                'produks.nama_produk as nama',
                'produks.harga_untung as harga',
                DB::raw('SUM(transaksi_details.quantity) as total_terjual'),
                DB::raw('SUM(transaksi_details.subtotal) as total_pendapatan')
            )
            ->groupBy('produks.id', 'produks.nama_produk', 'produks.harga_untung')
            ->orderBy('total_terjual', 'desc')
            ->limit(5)
            ->get();

        // Data untuk chart penjualan harian (7 hari terakhir) - hanya dari kasir yang sedang login
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $penjualan = Transaksi::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->where('user_id', Auth::id())
                ->sum('total_amount');

            $chartData[] = [
                'tanggal' => $date->format('d/m'),
                'penjualan' => $penjualan
            ];
        }

        return view('kasir.laporan', compact(
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'totalItemTerjualHariIni',
            'transaksis',
            'totalTransaksiPeriode',
            'totalPenjualanPeriode',
            'totalItemTerjualPeriode',
            'produkTerlaris',
            'chartData',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ));
    }

    public function exportPdf(Request $request)
    {
        // Get the same data as index method
        $tanggalMulai = $request->get('tanggal_mulai', Carbon::today()->format('Y-m-d'));
        $tanggalSelesai = $request->get('tanggal_selesai', Carbon::today()->format('Y-m-d'));
        $periode = $request->get('periode', 'harian');

        // Statistik Umum - hanya transaksi kasir yang sedang login
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

        // Transaksi berdasarkan periode yang dipilih (untuk PDF ambil semua, tidak pakai pagination) - hanya dari kasir yang sedang login
        $transaksis = Transaksi::with(['details.produk'])
            ->whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai)
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get(); // Gunakan get() bukan paginate() untuk PDF

        // Total berdasarkan filter periode - hanya dari kasir yang sedang login
        $totalTransaksiPeriode = Transaksi::whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai)
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->count();

        $totalPenjualanPeriode = Transaksi::whereDate('created_at', '>=', $tanggalMulai)
            ->whereDate('created_at', '<=', $tanggalSelesai)
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->sum('total_amount');

        $totalItemTerjualPeriode = TransaksiDetail::join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->whereDate('transaksis.created_at', '>=', $tanggalMulai)
            ->whereDate('transaksis.created_at', '<=', $tanggalSelesai)
            ->where('transaksis.status', 'completed')
            ->where('transaksis.user_id', Auth::id())
            ->sum('transaksi_details.quantity');

        // Produk terlaris periode ini - hanya dari kasir yang sedang login
        $produkTerlaris = DB::table('transaksi_details')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->join('produks', 'transaksi_details.produk_id', '=', 'produks.id')
            ->whereDate('transaksis.created_at', '>=', $tanggalMulai)
            ->whereDate('transaksis.created_at', '<=', $tanggalSelesai)
            ->where('transaksis.status', 'completed')
            ->where('transaksis.user_id', Auth::id())
            ->select(
                'produks.nama_produk',
                'produks.harga_untung',
                DB::raw('SUM(transaksi_details.quantity) as total_terjual'),
                DB::raw('SUM(transaksi_details.subtotal) as total_pendapatan')
            )
            ->groupBy('produks.id', 'produks.nama_produk', 'produks.harga_untung')
            ->orderBy('total_terjual', 'desc')
            ->limit(5)
            ->get();

        // Generate PDF
        $pdf = Pdf::loadView('kasir.laporan-pdf', compact(
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'totalItemTerjualHariIni',
            'transaksis',
            'totalTransaksiPeriode',
            'totalPenjualanPeriode',
            'totalItemTerjualPeriode',
            'produkTerlaris',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ));

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Generate filename
        $filename = 'laporan-penjualan-' . date('Y-m-d', strtotime($tanggalMulai)) . '-sampai-' . date('Y-m-d', strtotime($tanggalSelesai)) . '.pdf';

        // Download PDF
        return $pdf->download($filename);
    }

    public function exportExcel(Request $request)
    {
        // Implementasi export Excel bisa ditambahkan nanti
        // Untuk sekarang redirect kembali dengan pesan
        return redirect()->back()->with('info', 'Fitur export Excel akan segera tersedia');
    }
}
