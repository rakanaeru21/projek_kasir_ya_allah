<?php

require_once 'vendor/autoload.php';

// Initialize Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Produk;

echo "Checking products with proper field names...\n\n";

$products = Produk::limit(10)->get();

echo "=== PRODUCTS DATA ===\n";
foreach ($products as $product) {
    echo "ID: {$product->id}\n";
    echo "Name: {$product->nama_produk}\n";
    echo "Harga Normal: " . ($product->harga_normal ?? 'NULL') . "\n";
    echo "Harga Untung: " . ($product->harga_untung ?? 'NULL') . "\n";
    echo "Harga Diskon: " . ($product->harga_diskon ?? 'NULL') . "\n";
    echo "Final Price: " . $product->getFinalPrice() . "\n";
    echo "Stock: {$product->stok}\n";
    echo "---\n";
}

echo "Checking completed.\n";
