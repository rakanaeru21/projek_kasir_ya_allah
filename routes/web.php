<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KasirDashboardController;
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
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk');
        Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
        Route::get('/admin/produk/{id}', [ProdukController::class, 'show'])->name('admin.produk.show');
        Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
        Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');
        Route::delete('/admin/produk/{id}/force', [ProdukController::class, 'forceDestroy'])->name('admin.produk.force-destroy');
        Route::patch('/admin/produk/{id}/toggle-status', [ProdukController::class, 'toggleStatus'])->name('admin.produk.toggle-status');

        // Promo routes
        Route::get('/admin/promo', [PromoController::class, 'index'])->name('admin.promo');
        Route::post('/admin/promo', [PromoController::class, 'store'])->name('admin.promo.store');
        Route::get('/admin/promo/{promo}', [PromoController::class, 'show'])->name('admin.promo.show');
        Route::put('/admin/promo/{promo}', [PromoController::class, 'update'])->name('admin.promo.update');
        Route::delete('/admin/promo/{promo}', [PromoController::class, 'destroy'])->name('admin.promo.destroy');

        // User Management routes
        Route::get('/admin/user-management', [UserManagementController::class, 'index'])->name('admin.user-management');
        Route::get('/admin/user-management/{id}', [UserManagementController::class, 'show'])->name('admin.user-management.show');
        Route::put('/admin/user-management/{id}/role', [UserManagementController::class, 'updateRole'])->name('admin.user-management.update-role');
        Route::put('/admin/user-management/{id}/status', [UserManagementController::class, 'toggleStatus'])->name('admin.user-management.toggle-status');

        // Laporan Admin routes
        Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan');
        Route::get('/admin/laporan/export-pdf', [AdminLaporanController::class, 'exportPdf'])->name('admin.laporan.export.pdf');
        Route::get('/admin/laporan/export-excel', [AdminLaporanController::class, 'exportExcel'])->name('admin.laporan.export.excel');
    });

    // Kasir routes
    Route::middleware(['auth', 'role:kasir,admin'])->group(function () {
        Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])->name('kasir.dashboard');

        Route::get('/kasir/transaksi', [TransaksiController::class, 'index'])->name('kasir.transaksi');
        Route::post('/kasir/transaksi', [TransaksiController::class, 'store'])->name('kasir.transaksi.store');
        Route::get('/kasir/transaksi/search', [TransaksiController::class, 'searchProduct'])->name('kasir.transaksi.search');
        Route::get('/kasir/transaksi/product/{id}', [TransaksiController::class, 'getProduct'])->name('kasir.transaksi.product');
        Route::post('/kasir/transaksi/check-stock', [TransaksiController::class, 'checkStock'])->name('kasir.transaksi.check-stock');
        Route::post('/kasir/check-member', [TransaksiController::class, 'checkMember'])->name('kasir.check-member');
        Route::get('/kasir/transaksi/{id}/print', [TransaksiController::class, 'printReceipt'])->name('kasir.transaksi.print');

        // Debug route for testing
        Route::post('/kasir/debug-transaction', [\App\Http\Controllers\DebugController::class, 'testTransactionData'])->name('kasir.debug-transaction');
        Route::get('/kasir/test-transaction', function() {
            return view('test-transaction');
        })->name('kasir.test-transaction');

        // History routes
        Route::get('/kasir/history', [\App\Http\Controllers\HistoryController::class, 'index'])->name('kasir.history');
        Route::get('/kasir/history/{id}', [\App\Http\Controllers\HistoryController::class, 'show'])->name('kasir.history.show');
        Route::get('/kasir/history/{id}/print', [\App\Http\Controllers\HistoryController::class, 'printReceipt'])->name('kasir.history.print');

        // Transaksi pengguna routes
        Route::get('/kasir/transaksi-pengguna', [KasirDashboardController::class, 'transaksiPengguna'])->name('kasir.transaksi-pengguna');
        Route::get('/kasir/transaksi-pengguna/{id}', [KasirDashboardController::class, 'detailTransaksiPengguna'])->name('kasir.transaksi-pengguna.detail');
        Route::post('/kasir/transaksi-pengguna/{id}/konfirmasi', [KasirDashboardController::class, 'konfirmasiTransaksi'])->name('kasir.transaksi-pengguna.konfirmasi');
        Route::post('/kasir/transaksi-pengguna/{id}/tolak', [KasirDashboardController::class, 'tolakTransaksi'])->name('kasir.transaksi-pengguna.tolak');

        // Laporan routes
        Route::get('/kasir/laporan', [LaporanController::class, 'index'])->name('kasir.laporan');
        Route::get('/kasir/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('kasir.laporan.export-pdf');
        Route::get('/kasir/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('kasir.laporan.export-excel');
    });

    // Pengguna routes
    Route::middleware(['auth', 'role:pengguna,admin'])->group(function () {
        Route::get('/pengguna/dashboard', [\App\Http\Controllers\PenggunaController::class, 'dashboard'])->name('pengguna.dashboard');
        Route::get('/pengguna/produk', [\App\Http\Controllers\PenggunaController::class, 'produk'])->name('pengguna.produk');
        Route::get('/pengguna/produk/{id}', [\App\Http\Controllers\PenggunaController::class, 'detailProduk'])->name('pengguna.produk.detail');

        // Cart routes
        Route::post('/pengguna/cart/add', [\App\Http\Controllers\PenggunaController::class, 'addToCart'])->name('pengguna.cart.add');
        Route::get('/pengguna/keranjang', [\App\Http\Controllers\PenggunaController::class, 'keranjang'])->name('pengguna.keranjang');
        Route::post('/pengguna/cart/update', [\App\Http\Controllers\PenggunaController::class, 'updateCart'])->name('pengguna.cart.update');
        Route::delete('/pengguna/cart/remove/{produk_id}', [\App\Http\Controllers\PenggunaController::class, 'removeFromCart'])->name('pengguna.cart.remove');
        Route::post('/pengguna/cart/clear', [\App\Http\Controllers\PenggunaController::class, 'clearCart'])->name('pengguna.cart.clear');
        Route::get('/pengguna/cart/count', [\App\Http\Controllers\PenggunaController::class, 'getCartCount'])->name('pengguna.cart.count');

        // Checkout routes
        Route::get('/pengguna/checkout', [\App\Http\Controllers\PenggunaController::class, 'checkout'])->name('pengguna.checkout');
        Route::post('/pengguna/checkout', [\App\Http\Controllers\PenggunaController::class, 'processCheckout'])->name('pengguna.checkout.process');

        // History routes
        Route::get('/pengguna/history', [\App\Http\Controllers\PenggunaController::class, 'history'])->name('pengguna.history');
        Route::get('/pengguna/history/{id}', [\App\Http\Controllers\PenggunaController::class, 'detailHistory'])->name('pengguna.history.detail');
    });

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
