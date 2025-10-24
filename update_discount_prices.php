<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Load Laravel bootstrap
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Update harga diskon untuk semua produk
$produks = App\Models\Produk::all();

echo "Mengupdate harga diskon untuk " . $produks->count() . " produk...\n";

foreach ($produks as $produk) {
    $produk->updateDiscountPrice();
    echo "- {$produk->nama_produk}: ";

    if ($produk->harga_diskon) {
        echo "Rp " . number_format((float)$produk->harga_diskon, 0, ',', '.') . " (DISKON AKTIF)\n";
    } else {
        echo "Rp " . number_format((float)$produk->harga_untung, 0, ',', '.') . " (NORMAL)\n";
    }
}

echo "\nSelesai mengupdate harga diskon!\n";
