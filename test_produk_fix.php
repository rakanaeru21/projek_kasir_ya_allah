<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\TransaksiDetail;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

echo "=== Testing Laporan Produk Fix ===\n\n";

// Test query yang diperbaiki
echo "1. Testing TransaksiDetail with product info:\n";
$transaksiDetails = TransaksiDetail::leftJoin('produks', 'transaksi_details.produk_id', '=', 'produks.id')
    ->select(
        'transaksi_details.produk_id',
        'transaksi_details.nama_produk',
        'transaksi_details.kategori_produk',
        'transaksi_details.harga',
        'produks.nama_produk as produk_nama_current',
        DB::raw('SUM(transaksi_details.quantity) as total_terjual'),
        DB::raw('SUM(transaksi_details.subtotal) as total_pendapatan')
    )
    ->groupBy(
        'transaksi_details.produk_id',
        'transaksi_details.nama_produk',
        'transaksi_details.kategori_produk',
        'transaksi_details.harga',
        'produks.nama_produk'
    )
    ->orderBy('total_terjual', 'desc')
    ->limit(5)
    ->get();

foreach ($transaksiDetails as $index => $item) {
    $namaProduk = $item->nama_produk ?: ($item->produk_nama_current ?: 'Produk ID: ' . $item->produk_id);
    $kategoriProduk = $item->kategori_produk ?: 'Tidak Diketahui';

    echo sprintf(
        "%d. %s (%s) - Terjual: %d, Pendapatan: Rp %s\n",
        $index + 1,
        $namaProduk,
        $kategoriProduk,
        $item->total_terjual,
        number_format($item->total_pendapatan, 0, ',', '.')
    );
}

echo "\n2. Testing data migration status:\n";
$totalTransaksiDetail = TransaksiDetail::count();
$withNamaProduk = TransaksiDetail::whereNotNull('nama_produk')->count();
$withoutNamaProduk = TransaksiDetail::whereNull('nama_produk')->count();

echo "Total TransaksiDetail: $totalTransaksiDetail\n";
echo "With nama_produk: $withNamaProduk\n";
echo "Without nama_produk: $withoutNamaProduk\n";

if ($withoutNamaProduk > 0) {
    echo "⚠️  Warning: Ada $withoutNamaProduk transaksi detail tanpa nama produk\n";
} else {
    echo "✅ All transaksi details have product info\n";
}

echo "\n3. Testing existing products vs deleted references:\n";
$totalProduk = Produk::count();
$uniqueProdukIdsInTransactions = TransaksiDetail::distinct('produk_id')->count('produk_id');

echo "Total active products: $totalProduk\n";
echo "Unique product IDs in transactions: $uniqueProdukIdsInTransactions\n";

if ($uniqueProdukIdsInTransactions > $totalProduk) {
    $deletedProductTransactions = $uniqueProdukIdsInTransactions - $totalProduk;
    echo "📊 Transactions referencing deleted products: ~$deletedProductTransactions\n";
} else {
    echo "✅ All transaction products still exist\n";
}

echo "\n=== Test Completed ===\n";
