<?php

require_once 'vendor/autoload.php';

// Initialize Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\TransaksiController;

echo "Testing TransaksiController with simulated request...\n\n";

// Find a kasir user to authenticate
$kasir = User::where('role', 'kasir')->first();
if (!$kasir) {
    echo "No kasir user found!\n";
    exit;
}

// Simulate authentication
Auth::login($kasir);
echo "Authenticated as: {$kasir->nama} (ID: {$kasir->id})\n";

// Get a valid product
$produk = \App\Models\Produk::where('stok', '>', 0)->first();
if (!$produk) {
    echo "No products with stock found!\n";
    exit;
}

echo "Using product: {$produk->nama_produk} (Price: {$produk->getFinalPrice()})\n";

// Simulate the request data that would come from the frontend
$requestData = [
    'customer_name' => 'Test Customer',
    'member_phone' => null,
    'payment_method' => 'cash',
    'items' => [
        [
            'id' => $produk->id,
            'quantity' => 1,
            'price' => $produk->getFinalPrice()
        ]
    ],
    'subtotal' => $produk->getFinalPrice() / 1.1, // Remove tax
    'tax' => $produk->getFinalPrice() - ($produk->getFinalPrice() / 1.1),
    'total_amount' => $produk->getFinalPrice(),
    'cash_amount' => $produk->getFinalPrice() + 5000,
    '_token' => 'test_token'
];

echo "Request data:\n";
print_r($requestData);

// Create a simulated Request object
$request = new Request();
$request->replace($requestData);

// Create the controller and call the store method
$controller = new TransaksiController();

try {
    $response = $controller->store($request);

    echo "Response status: " . $response->getStatusCode() . "\n";
    echo "Response content: " . $response->getContent() . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}

echo "\nTest completed.\n";
