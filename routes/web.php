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
    SaleController,
    PengajuanBarangController,
    PaymentController,
    CustomerController
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

    // Orders
    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('orders.index');
        Route::get('/{id}', 'show')->where('id', '[0-9]+')->name('orders.show');
        Route::put('/{id}/cancel', 'cancel')->name('orders.cancel');
        Route::get('/export-excel', 'exportExcel')->name('orders.exportExcel');
        Route::get('/export-pdf', 'exportPdf')->name('orders.exportPdf');
        Route::resource('/', OrderController::class);

        Route::resource('orders', OrderController::class);  // Menggunakan resource route untuk CRUD
    });

    // Menus
    Route::resource('menus', MenuController::class);

    // Sales (Transaksi Penjualan)
    Route::prefix('sales')->controller(SaleController::class)->group(function () {
        Route::get('/', 'index')->name('sales.index');
        Route::get('/create', 'create')->name('sales.create');
        Route::post('/store', 'store')->name('sales.store');
        Route::get('/edit/{id}', 'edit')->name('sales.edit');
        Route::put('/update/{id}', 'update')->name('sales.update');
        Route::get('/show/{id}', 'show')->name('sales.show');
        Route::get('/receipt/{id}', 'receipt')->name('sales.receipt');
    });

    // Payment (Pembayaran)
    Route::prefix('payments')->controller(PaymentController::class)->group(function () {
        Route::get('/', 'index')->name('payments.index');
        Route::post('/', 'store')->name('payments.store');
    });

    // Pengajuan Barang
    Route::prefix('pengajuan_barang')->controller(PengajuanBarangController::class)->name('pengajuan_barang.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit')->where('id', '[0-9]+');
        Route::put('/{id}', 'update')->name('update')->where('id', '[0-9]+');
        Route::delete('/{id}', 'destroy')->name('destroy')->where('id', '[0-9]+');
        Route::get('/data', 'getData')->name('data');
        Route::get('/export-excel', 'exportExcel')->name('export-excel');
        Route::get('/export-pdf', 'exportPdf')->name('export-pdf');
        Route::put('/{id}/update-status', 'updateStatus')->name('update-status')->where('id', '[0-9]+');
    });
});

// ==========================
// ROUTES KHUSUS ADMIN
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus.index');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');
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

// Route untuk Customer
Route::resource('customers', CustomerController::class);
