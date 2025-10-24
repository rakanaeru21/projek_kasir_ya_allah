<?php

require_once 'vendor/autoload.php';

// Load Laravel bootstrap
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "Membuat promo aktif untuk testing...\n\n";

// Update promo yang sudah ada agar aktif hari ini
$promo = App\Models\Promo::first();

if ($promo) {
    $promo->update([
        'mulai' => now()->toDateString(),
        'berakhir' => now()->addDays(7)->toDateString()
    ]);

    echo "Promo '{$promo->nama}' berhasil diupdate!\n";
    echo "Periode baru: {$promo->mulai} s/d {$promo->berakhir}\n";

    // Update harga diskon produk
    foreach ($promo->produks as $produk) {
        $produk->updateDiscountPrice();
        echo "- {$produk->nama_produk}: Rp " . number_format((float)$produk->getFinalPrice(), 0, ',', '.') . "\n";
    }
} else {
    echo "Tidak ada promo yang ditemukan.\n";
}
