<?php

require_once 'vendor/autoload.php';

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Initialize Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Mock a test transaction data to see what happens
$testData = [
    'customer_name' => 'Test Customer',
    'member_phone' => null,
    'payment_method' => 'cash',
    'items' => [
        [
            'id' => 1,
            'quantity' => 2,
            'price' => 10000
        ]
    ],
    'subtotal' => 18000,
    'tax' => 2000,
    'total_amount' => 20000,
    'cash_amount' => 25000,
    '_token' => 'test'
];

echo "Testing transaction data validation...\n";

// Check if product exists
echo "Checking products...\n";
$produks = Produk::all();
echo "Found " . $produks->count() . " products:\n";
foreach ($produks as $produk) {
    echo "- ID: {$produk->id}, Name: {$produk->nama_produk}, Stock: {$produk->stok}, Price: {$produk->harga}\n";
}

echo "\nChecking users...\n";
$users = User::where('role', 'kasir')->get();
echo "Found " . $users->count() . " kasir users:\n";
foreach ($users as $user) {
    echo "- ID: {$user->id}, Name: {$user->nama}, Role: {$user->role}\n";
}

// Test transaction creation
echo "\nTesting manual transaction creation...\n";
try {
    DB::beginTransaction();

    // Check if we have valid product IDs
    if ($produks->count() > 0) {
        $firstProduct = $produks->first();

        // Update test data with valid product ID
        $testData['items'][0]['id'] = $firstProduct->id;
        $testData['items'][0]['price'] = $firstProduct->getFinalPrice(); // Use the getFinalPrice method

        echo "Using product: {$firstProduct->nama_produk} (ID: {$firstProduct->id})\n";

        // Validate stock
        if ($firstProduct->stok >= $testData['items'][0]['quantity']) {
            echo "Stock validation passed\n";

            // Generate kode transaksi
            $kodeTransaksi = Transaksi::generateKodeTransaksi();
            echo "Generated code: {$kodeTransaksi}\n";

            // Try to create transaction (with dummy user_id if needed)
            $kasir = $users->first();
            if (!$kasir) {
                echo "No kasir user found, creating dummy transaction data...\n";
                $userId = null;
            } else {
                $userId = $kasir->id;
                echo "Using kasir: {$kasir->nama} (ID: {$userId})\n";
            }

            $changeAmount = $testData['cash_amount'] - $testData['total_amount'];

            $transaksi = Transaksi::create([
                'kode_transaksi' => $kodeTransaksi,
                'user_id' => $userId,
                'member_id' => null,
                'customer_name' => $testData['customer_name'],
                'payment_method' => $testData['payment_method'],
                'subtotal' => $testData['subtotal'],
                'tax' => $testData['tax'],
                'total_amount' => $testData['total_amount'],
                'cash_amount' => $testData['cash_amount'],
                'change_amount' => $changeAmount,
                'status' => 'completed',
            ]);

            echo "Transaction created successfully with ID: {$transaksi->id}\n";

            // Create transaction detail
            foreach ($testData['items'] as $item) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'harga' => $item['price'], // Using 'harga' not 'harga_satuan'
                    'subtotal' => $item['quantity'] * $item['price']
                ]);
                echo "Transaction detail created for product ID: {$item['id']}\n";
            }

            // Update stock
            foreach ($testData['items'] as $item) {
                $produk = Produk::find($item['id']);
                $produk->stok -= $item['quantity'];
                $produk->save();
                echo "Updated stock for {$produk->nama_produk}: new stock = {$produk->stok}\n";
            }

            DB::commit();
            echo "Transaction completed successfully!\n";

        } else {
            echo "Stock validation failed: need {$testData['items'][0]['quantity']}, have {$firstProduct->stok}\n";
        }
    } else {
        echo "No products found in database\n";
    }

} catch (Exception $e) {
    DB::rollback();
    echo "Transaction failed: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}

echo "\nTest completed.\n";
