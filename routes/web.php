<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    OrderController,
    AuthController,
    AdminController,
    KasirController,
    PelayanController,
    MenuController,
    CategoryController,
    SaleController
};

// Halaman Awal
Route::get('/', fn() => view('welcome'));

// ==========================
// AUTH ROUTES
// ==========================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::post('/register', 'register');
});

// ==========================
// ROUTES UNTUK SEMUA PENGGUNA YANG SUDAH LOGIN
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orders (Semua Pengguna Bisa Melihat Pesanan)
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->where('id', '[0-9]+')->name('orders.show');
    });

    // Menus
    Route::resource('menus', MenuController::class);
    
    // Sales (Transaksi Penjualan)
    Route::prefix('sales')->group(function () {
        Route::get('/', [SaleController::class, 'index'])->name('sales.index');
        Route::get('/create', [SaleController::class, 'create'])->name('sales.create');
        Route::post('/store', [SaleController::class, 'store'])->name('sales.store');
        Route::get('/edit/{id}', [SaleController::class, 'edit'])->name('sales.edit');
        Route::put('/update/{id}', [SaleController::class, 'update'])->name('sales.update');
        Route::get('/receipt/{id}', [SaleController::class, 'receipt'])->name('sales.receipt');
        Route::get('/show/{id}', [SaleController::class, 'show'])->name('sales.show');

    });
});

// ==========================
// ROUTES KHUSUS ADMIN
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
});

// ==========================
// ROUTES KHUSUS KASIR
// ==========================
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
    Route::get('/orders/new', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
});

// ==========================
// ROUTES KHUSUS PELAYAN
// ==========================
Route::middleware(['auth', 'role:pelayan'])->prefix('pelayan')->group(function () {
    Route::get('/dashboard', [PelayanController::class, 'index'])->name('pelayan.dashboard');
});
