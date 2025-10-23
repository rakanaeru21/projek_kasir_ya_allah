<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\PromoController;
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
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk');
        Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
        Route::get('/admin/produk/{id}', [ProdukController::class, 'show'])->name('admin.produk.show');
        Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
        Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');

        // Promo routes
        Route::get('/admin/promo', [PromoController::class, 'index'])->name('admin.promo');
        Route::post('/admin/promo', [PromoController::class, 'store'])->name('admin.promo.store');
        Route::get('/admin/promo/{promo}', [PromoController::class, 'show'])->name('admin.promo.show');
        Route::put('/admin/promo/{promo}', [PromoController::class, 'update'])->name('admin.promo.update');
        Route::delete('/admin/promo/{promo}', [PromoController::class, 'destroy'])->name('admin.promo.destroy');
    });

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
