<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DebugController extends Controller
{
    public function testTransactionData(Request $request)
    {
        Log::info('Debug endpoint called', [
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'data' => $request->all(),
            'json' => $request->json()->all(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Debug data received',
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'data_received' => $request->all(),
            'json_data' => $request->json()->all(),
            'raw_content' => $request->getContent()
        ]);
    }
}
