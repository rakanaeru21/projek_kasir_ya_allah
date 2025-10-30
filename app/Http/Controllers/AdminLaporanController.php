<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil filter tanggal dari request
        $tanggalMulai = $request->get('tanggal_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tanggalSelesai = $request->get('tanggal_selesai', Carbon::now()->format('Y-m-d'));

        // Data statistik umum
        $statistikUmum = $this->getStatistikUmum($tanggalMulai, $tanggalSelesai);

        // Data kasir dan transaksi mereka
        $laporanKasir = $this->getLaporanKasir($tanggalMulai, $tanggalSelesai);

        // Data metode pembayaran
        $laporanPembayaran = $this->getLaporanMetodePembayaran($tanggalMulai, $tanggalSelesai);

        // Data produk
        $laporanProduk = $this->getLaporanProduk($tanggalMulai, $tanggalSelesai);

        // Data transaksi per hari untuk chart
        $transaksiHarian = $this->getTransaksiHarian($tanggalMulai, $tanggalSelesai);

        return view('admin.laporan', compact(
            'statistikUmum',
            'laporanKasir',
            'laporanPembayaran',
            'laporanProduk',
            'transaksiHarian',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }

    private function getStatistikUmum($tanggalMulai, $tanggalSelesai)
    {
        $totalTransaksi = Transaksi::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])->count();

        $totalPendapatan = Transaksi::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->sum('total_amount');

        $totalProdukTerjual = TransaksiDetail::whereHas('transaksi', function ($query) use ($tanggalMulai, $tanggalSelesai) {
            $query->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai]);
        })->sum('quantity');

        $rataRataTransaksi = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;
        $totalUsers = User::count();

        return [
            'total_users' => $totalUsers,
            'total_transaksi' => $totalTransaksi,
            'total_pendapatan' => $totalPendapatan,
            'total_produk_terjual' => $totalProdukTerjual,
            'rata_rata_transaksi' => $rataRataTransaksi
        ];
    }

    private function getLaporanKasir($tanggalMulai, $tanggalSelesai)
    {
        return User::where('role', 'kasir')
            ->withCount(['transaksiSebagaiKasir as jumlah_transaksi' => function ($query) use ($tanggalMulai, $tanggalSelesai) {
                $query->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai]);
            }])
            ->with(['transaksiSebagaiKasir' => function ($query) use ($tanggalMulai, $tanggalSelesai) {
                $query->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
                      ->select('user_id', DB::raw('SUM(total_amount) as total_penjualan'), DB::raw('COUNT(*) as total_transaksi'))
                      ->groupBy('user_id');
            }])
            ->get()
            ->map(function ($kasir) use ($tanggalMulai, $tanggalSelesai) {
                $totalPenjualan = Transaksi::where('user_id', $kasir->id)
                    ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
                    ->sum('total_amount');

                $metodePembayaran = Transaksi::where('user_id', $kasir->id)
                    ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
                    ->select('payment_method', DB::raw('COUNT(*) as jumlah'))
                    ->groupBy('payment_method')
                    ->pluck('jumlah', 'payment_method')
                    ->toArray();

                return [
                    'nama' => $kasir->nama,
                    'email' => $kasir->email,
                    'jumlah_transaksi' => $kasir->jumlah_transaksi,
                    'total_penjualan' => $totalPenjualan,
                    'metode_pembayaran' => $metodePembayaran
                ];
            });
    }

    private function getLaporanMetodePembayaran($tanggalMulai, $tanggalSelesai)
    {
        return Transaksi::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->select('payment_method',
                     DB::raw('COUNT(*) as jumlah_transaksi'),
                     DB::raw('SUM(total_amount) as total_amount'))
            ->groupBy('payment_method')
            ->orderBy('total_amount', 'desc')
            ->get();
    }

    private function getLaporanProduk($tanggalMulai, $tanggalSelesai)
    {
        $produkTerjual = TransaksiDetail::whereHas('transaksi', function ($query) use ($tanggalMulai, $tanggalSelesai) {
            $query->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai]);
        })
        ->leftJoin('produks', 'transaksi_details.produk_id', '=', 'produks.id')
        ->select(
            'transaksi_details.produk_id',
            'transaksi_details.nama_produk',
            'transaksi_details.kategori_produk',
            'transaksi_details.harga',
            'produks.nama_produk as produk_nama_current',
            'produks.kategori as produk_kategori_current',
            'produks.harga_normal as produk_harga_current',
            DB::raw('SUM(transaksi_details.quantity) as total_terjual'),
            DB::raw('SUM(transaksi_details.subtotal) as total_pendapatan')
        )
        ->groupBy(
            'transaksi_details.produk_id',
            'transaksi_details.nama_produk',
            'transaksi_details.kategori_produk',
            'transaksi_details.harga',
            'produks.nama_produk',
            'produks.kategori',
            'produks.harga_normal'
        )
        ->orderBy('total_terjual', 'desc')
        ->limit(10)
        ->get()
        ->map(function ($item) {
            return (object) [
                'produk_id' => $item->produk_id,
                'total_terjual' => $item->total_terjual,
                'total_pendapatan' => $item->total_pendapatan,
                'produk' => (object) [
                    'nama' => $item->nama_produk ?: ($item->produk_nama_current ?: 'Produk ID: ' . $item->produk_id),
                    'kategori' => $item->kategori_produk ?: ($item->produk_kategori_current ?: 'Tidak Diketahui'),
                    'harga' => $item->harga ?: ($item->produk_harga_current ?: 0),
                ]
            ];
        });

        $totalProdukAktif = Produk::count();
        $produkTanpaStok = Produk::where('stok', 0)->count();

        return [
            'produk_terlaris' => $produkTerjual,
            'total_produk_aktif' => $totalProdukAktif,
            'produk_tanpa_stok' => $produkTanpaStok
        ];
    }

    private function getTransaksiHarian($tanggalMulai, $tanggalSelesai)
    {
        return Transaksi::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->select(DB::raw('DATE(created_at) as tanggal'),
                     DB::raw('COUNT(*) as jumlah_transaksi'),
                     DB::raw('SUM(total_amount) as total_penjualan'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal')
            ->get();
    }

    public function exportPdf(Request $request)
    {
        // Mengambil filter tanggal dari request
        $tanggalMulai = $request->get('tanggal_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tanggalSelesai = $request->get('tanggal_selesai', Carbon::now()->format('Y-m-d'));

        // Mengambil semua data yang sama seperti di index
        $statistikUmum = $this->getStatistikUmum($tanggalMulai, $tanggalSelesai);
        $laporanKasir = $this->getLaporanKasir($tanggalMulai, $tanggalSelesai);
        $laporanPembayaran = $this->getLaporanMetodePembayaran($tanggalMulai, $tanggalSelesai);
        $laporanProduk = $this->getLaporanProduk($tanggalMulai, $tanggalSelesai);
        $transaksiHarian = $this->getTransaksiHarian($tanggalMulai, $tanggalSelesai);

        // Generate PDF menggunakan DomPDF
        $pdf = Pdf::loadView('admin.laporan-pdf', compact(
            'statistikUmum',
            'laporanKasir',
            'laporanPembayaran',
            'laporanProduk',
            'transaksiHarian',
            'tanggalMulai',
            'tanggalSelesai'
        ));

        // Set paper size dan orientation
        $pdf->setPaper('A4', 'portrait');

        // Generate filename
        $filename = 'laporan-admin-' . $tanggalMulai . '-to-' . $tanggalSelesai . '.pdf';

        // Return PDF download
        return $pdf->download($filename);
    }

    public function exportExcel(Request $request)
    {
        // Mengambil filter tanggal dari request
        $tanggalMulai = $request->get('tanggal_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tanggalSelesai = $request->get('tanggal_selesai', Carbon::now()->format('Y-m-d'));

        // Create export instance
        $export = new \App\Exports\LaporanAdminExport($tanggalMulai, $tanggalSelesai);

        // Generate CSV (sebagai alternatif Excel)
        return response()->streamDownload(function() use ($export) {
            $export->generateCSV();
        }, 'laporan-admin-' . $tanggalMulai . '-to-' . $tanggalSelesai . '.csv');
    }
}
