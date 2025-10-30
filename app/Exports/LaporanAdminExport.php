<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanAdminExport
{
    protected $tanggalMulai;
    protected $tanggalSelesai;

    public function __construct($tanggalMulai, $tanggalSelesai)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
    }

    public function generateCSV()
    {
        $filename = 'laporan-admin-' . $this->tanggalMulai . '-to-' . $this->tanggalSelesai . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');

        // UTF-8 BOM for Excel compatibility
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Header
        fputcsv($output, ['LAPORAN PENJUALAN AERUSTORE']);
        fputcsv($output, ['Periode: ' . Carbon::parse($this->tanggalMulai)->format('d F Y') . ' - ' . Carbon::parse($this->tanggalSelesai)->format('d F Y')]);
        fputcsv($output, ['Generated: ' . Carbon::now()->format('d F Y H:i:s')]);
        fputcsv($output, []);

        // Statistik Umum
        fputcsv($output, ['RINGKASAN STATISTIK']);
        fputcsv($output, []);

        $totalTransaksi = Transaksi::whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai])->count();
        $totalPendapatan = Transaksi::whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai])->sum('total_amount');
        $totalProdukTerjual = TransaksiDetail::whereHas('transaksi', function ($query) {
            $query->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai]);
        })->sum('quantity');
        $rataRataTransaksi = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        fputcsv($output, ['Metrik', 'Nilai']);
        fputcsv($output, ['Total Transaksi', $totalTransaksi]);
        fputcsv($output, ['Total Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.')]);
        fputcsv($output, ['Total Produk Terjual', $totalProdukTerjual]);
        fputcsv($output, ['Rata-rata Transaksi', 'Rp ' . number_format($rataRataTransaksi, 0, ',', '.')]);
        fputcsv($output, []);

        // Laporan Per Kasir
        fputcsv($output, ['LAPORAN PER KASIR']);
        fputcsv($output, []);
        fputcsv($output, ['Nama Kasir', 'Email', 'Jumlah Transaksi', 'Total Penjualan', 'Cash', 'Transfer', 'Card']);

        $laporanKasir = User::where('role', 'kasir')
            ->withCount(['transaksiSebagaiKasir as jumlah_transaksi' => function ($query) {
                $query->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai]);
            }])
            ->get();

        foreach ($laporanKasir as $kasir) {
            $totalPenjualan = Transaksi::where('user_id', $kasir->id)
                ->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai])
                ->sum('total_amount');

            $metodePembayaran = Transaksi::where('user_id', $kasir->id)
                ->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai])
                ->select('payment_method', DB::raw('COUNT(*) as jumlah'))
                ->groupBy('payment_method')
                ->pluck('jumlah', 'payment_method')
                ->toArray();

            fputcsv($output, [
                $kasir->nama,
                $kasir->email,
                $kasir->jumlah_transaksi,
                'Rp ' . number_format($totalPenjualan, 0, ',', '.'),
                isset($metodePembayaran['cash']) ? $metodePembayaran['cash'] : 0,
                isset($metodePembayaran['transfer']) ? $metodePembayaran['transfer'] : 0,
                isset($metodePembayaran['card']) ? $metodePembayaran['card'] : 0,
            ]);
        }

        fputcsv($output, []);

        // Metode Pembayaran
        fputcsv($output, ['METODE PEMBAYARAN']);
        fputcsv($output, []);
        fputcsv($output, ['Metode Pembayaran', 'Jumlah Transaksi', 'Total Amount', 'Persentase']);

        $laporanPembayaran = Transaksi::whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai])
            ->select('payment_method',
                     DB::raw('COUNT(*) as jumlah_transaksi'),
                     DB::raw('SUM(total_amount) as total_amount'))
            ->groupBy('payment_method')
            ->orderBy('total_amount', 'desc')
            ->get();

        foreach ($laporanPembayaran as $pembayaran) {
            $persentase = $totalPendapatan > 0
                ? ($pembayaran->total_amount / $totalPendapatan) * 100
                : 0;

            fputcsv($output, [
                ucfirst($pembayaran->payment_method),
                $pembayaran->jumlah_transaksi,
                'Rp ' . number_format($pembayaran->total_amount, 0, ',', '.'),
                number_format($persentase, 1) . '%'
            ]);
        }

        fputcsv($output, []);

        // Produk Terlaris
        fputcsv($output, ['TOP 20 PRODUK TERLARIS']);
        fputcsv($output, []);
        fputcsv($output, ['Ranking', 'Nama Produk', 'Kategori', 'Harga', 'Total Terjual', 'Total Pendapatan']);

        $produkTerjual = TransaksiDetail::whereHas('transaksi', function ($query) {
            $query->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai]);
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
        ->limit(20)
        ->get();

        foreach ($produkTerjual as $index => $produk) {
            $namaProduk = $produk->nama_produk ?: ($produk->produk_nama_current ?: 'Produk ID: ' . $produk->produk_id);
            $kategoriProduk = $produk->kategori_produk ?: ($produk->produk_kategori_current ?: 'Tidak Diketahui');
            $hargaProduk = $produk->harga ?: ($produk->produk_harga_current ?: 0);

            fputcsv($output, [
                $index + 1,
                $namaProduk,
                $kategoriProduk,
                'Rp ' . number_format($hargaProduk, 0, ',', '.'),
                $produk->total_terjual,
                'Rp ' . number_format($produk->total_pendapatan, 0, ',', '.')
            ]);
        }

        fputcsv($output, []);

        // Transaksi Harian
        fputcsv($output, ['TRANSAKSI HARIAN']);
        fputcsv($output, []);
        fputcsv($output, ['Tanggal', 'Jumlah Transaksi', 'Total Penjualan']);

        $transaksiHarian = Transaksi::whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai])
            ->select(DB::raw('DATE(created_at) as tanggal'),
                     DB::raw('COUNT(*) as jumlah_transaksi'),
                     DB::raw('SUM(total_amount) as total_penjualan'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal')
            ->get();

        foreach ($transaksiHarian as $item) {
            fputcsv($output, [
                Carbon::parse($item->tanggal)->format('d F Y'),
                $item->jumlah_transaksi,
                'Rp ' . number_format($item->total_penjualan, 0, ',', '.')
            ]);
        }

        fclose($output);
    }
}
