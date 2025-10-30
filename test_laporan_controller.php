<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "=== Testing AdminLaporanController Route ===\n\n";

try {
    // Test instantiate controller
    $controller = new \App\Http\Controllers\AdminLaporanController();
    echo "✅ Controller instantiated successfully\n";

    // Test request creation
    $request = \Illuminate\Http\Request::create('/admin/laporan', 'GET');
    echo "✅ Request created successfully\n";

    // Test controller method
    $response = $controller->index($request);
    echo "✅ Controller index method executed successfully\n";
    echo "Response type: " . get_class($response) . "\n";

    if ($response instanceof \Illuminate\Http\Response || $response instanceof \Illuminate\View\View) {
        echo "✅ Response is valid view or HTTP response\n";

        if (method_exists($response, 'getContent')) {
            $content = $response->getContent();
            if (strpos($content, 'Laporan Admin') !== false) {
                echo "✅ Response contains expected content\n";
            } else {
                echo "❌ Response does not contain expected content\n";
            }
        }
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Completed ===\n";
