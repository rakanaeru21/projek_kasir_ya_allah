<?php

require_once 'vendor/autoload.php';

// Initialize Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking transaksi_details table structure...\n\n";

try {
    $columns = DB::select("DESCRIBE transaksi_details");
    echo "=== TRANSAKSI_DETAILS TABLE STRUCTURE ===\n";
    foreach ($columns as $column) {
        echo "Column: {$column->Field}, Type: {$column->Type}, Null: {$column->Null}, Default: {$column->Default}\n";
    }
} catch (Exception $e) {
    echo "Error getting table structure: " . $e->getMessage() . "\n";
}

echo "\n";
