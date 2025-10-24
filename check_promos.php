<?php

require_once 'vendor/autoload.php';

// Load Laravel bootstrap
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "=== STATUS PROMO AKTIF ===\n\n";

$promos = App\Models\Promo::with('produks')->get();

foreach ($promos as $promo) {
    $today = now()->toDateString();
    $status = 'TIDAK AKTIF';

    if ($promo->berakhir < $today) {
        $status = 'BERAKHIR';
    } elseif ($promo->mulai > $today) {
        $status = 'AKAN DATANG';
    } else {
        $status = 'AKTIF';
    }

    echo "Promo: {$promo->nama}\n";
    echo "Diskon: {$promo->diskon}%\n";
    echo "Periode: {$promo->mulai} s/d {$promo->berakhir}\n";
    echo "Status: {$status}\n";
    echo "Produk: ";

    if ($promo->produks->count() > 0) {
        echo $promo->produks->pluck('nama_produk')->join(', ');
    } else {
        echo "Tidak ada produk";
    }

    echo "\n\n";
}

echo "=== PRODUK DENGAN HARGA DISKON ===\n\n";

$produksDiskon = App\Models\Produk::whereNotNull('harga_diskon')->get();

if ($produksDiskon->count() > 0) {
    foreach ($produksDiskon as $produk) {
        $promoInfo = $produk->getActivePromoInfo();
        echo "- {$produk->nama_produk}\n";
        echo "  Harga Normal: Rp " . number_format((float)$produk->harga_untung, 0, ',', '.') . "\n";
        echo "  Harga Diskon: Rp " . number_format((float)$produk->harga_diskon, 0, ',', '.') . "\n";
        echo "  Hemat: Rp " . number_format((float)$promoInfo['savings'], 0, ',', '.') . " ({$promoInfo['discount_percent']}%)\n\n";
    }
} else {
    echo "Tidak ada produk dengan diskon aktif.\n";
}
