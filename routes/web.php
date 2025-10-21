<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard routes berdasarkan role
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    Route::get('/pengguna/dashboard', function () {
        return view('pengguna.dashboard');
    })->name('pengguna.dashboard');

    // Default dashboard (redirect ke role masing-masing)
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'kasir':
                return redirect()->route('kasir.dashboard');
            case 'pengguna':
                return redirect()->route('pengguna.dashboard');
            default:
                return view('dashboard');
        }
    })->name('dashboard');
});

Route::get('/', function () {
    return redirect('/login');
});
