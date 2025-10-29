<?php

require_once 'vendor/autoload.php';

// Initialize Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking products table structure and data...\n\n";

// Check table structure
echo "=== PRODUCTS TABLE STRUCTURE ===\n";
try {
    $columns = DB::select("DESCRIBE produks");
    foreach ($columns as $column) {
        echo "Column: {$column->Field}, Type: {$column->Type}, Null: {$column->Null}, Default: {$column->Default}\n";
    }
} catch (Exception $e) {
    echo "Error getting table structure: " . $e->getMessage() . "\n";
}

echo "\n=== PRODUCTS DATA ===\n";
try {
    $products = DB::select("SELECT id, nama_produk, harga, harga_diskon, stok FROM produks LIMIT 10");
    foreach ($products as $product) {
        echo "ID: {$product->id}, Name: {$product->nama_produk}, Harga: " . ($product->harga ?? 'NULL') . ", Harga Diskon: " . ($product->harga_diskon ?? 'NULL') . ", Stock: {$product->stok}\n";
    }
} catch (Exception $e) {
    echo "Error getting products data: " . $e->getMessage() . "\n";
}

echo "\n=== CHECKING FOR NULL PRICES ===\n";
try {
    $nullPrices = DB::select("SELECT COUNT(*) as count FROM produks WHERE harga IS NULL");
    echo "Products with NULL harga: " . $nullPrices[0]->count . "\n";

    $validPrices = DB::select("SELECT COUNT(*) as count FROM produks WHERE harga IS NOT NULL");
    echo "Products with valid harga: " . $validPrices[0]->count . "\n";
} catch (Exception $e) {
    echo "Error checking null prices: " . $e->getMessage() . "\n";
}

echo "\nChecking completed.\n";
