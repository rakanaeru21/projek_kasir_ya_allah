<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;

echo "=== Debug Authentication Issue ===\n\n";

// Check if there are admin users
echo "1. Checking admin users in database:\n";
$adminUsers = User::where('role', 'admin')->get();

if ($adminUsers->count() > 0) {
    echo "✅ Found {$adminUsers->count()} admin user(s):\n";
    foreach ($adminUsers as $admin) {
        echo "   - ID: {$admin->id}, Name: {$admin->nama}, Email: {$admin->email}, Active: " . ($admin->is_active ? 'Yes' : 'No') . "\n";
    }
} else {
    echo "❌ No admin users found in database!\n";
    echo "Creating a test admin user...\n";

    $admin = User::create([
        'nama' => 'Test Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'is_active' => true,
        'nomor_telepon' => '081234567890'
    ]);

    echo "✅ Created admin user: ID {$admin->id}, Email: {$admin->email}\n";
}

echo "\n2. Testing route access simulation:\n";

try {
    // Simulate authenticated request as admin
    $adminUser = User::where('role', 'admin')->first();

    if ($adminUser) {
        // Set auth user
        \Illuminate\Support\Facades\Auth::login($adminUser);
        echo "✅ Simulated login as admin: {$adminUser->nama}\n";

        // Test middleware
        $middleware = new \App\Http\Middleware\CheckRole();
        $request = \Illuminate\Http\Request::create('/admin/laporan', 'GET');

        $result = $middleware->handle($request, function($req) {
            return response('Access granted');
        }, 'admin');

        if ($result instanceof \Illuminate\Http\Response) {
            echo "✅ Middleware check passed\n";
        } else {
            echo "❌ Middleware redirected or blocked access\n";
            echo "Redirect location: " . $result->getTargetUrl() . "\n";
        }

    } else {
        echo "❌ No admin user available for testing\n";
    }

} catch (Exception $e) {
    echo "❌ Error during simulation: " . $e->getMessage() . "\n";
}

echo "\n3. Route accessibility check:\n";
echo "Route name: admin.laporan\n";
echo "Route URL: " . route('admin.laporan') . "\n";
echo "Route exists: " . (\Illuminate\Support\Facades\Route::has('admin.laporan') ? 'Yes' : 'No') . "\n";

echo "\n=== Debug Completed ===\n";
