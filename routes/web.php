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

// ==========================
// HALAMAN AWAL
// ==========================
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
// ROUTES UNTUK PENGGUNA LOGIN
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('orders.index');
        Route::get('/{id}', 'show')->where('id', '[0-9]+')->name('orders.show');
        Route::put('/{id}/cancel', 'markCancel')->name('orders.cancel');
        Route::put('/{id}/complete', 'markComplete')->name('orders.complete');
        Route::post('/{id}/cancel', 'markCancel')->name('orders.markCancel');
        Route::post('/{id}/complete', 'markComplete')->name('orders.markComplete');
        Route::delete('/clear-all', 'clearAll')->name('orders.clearAll');
        Route::get('/export-excel', 'exportExcel')->name('orders.exportExcel');
        Route::get('/export-pdf', 'exportPdf')->name('orders.exportPdf');
        Route::get('/order', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/order/{id}/print', [OrderController::class, 'print'])->name('order.print');
    });

    // Menus
    Route::resource('menus', MenuController::class);

    // Payments
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

    // Customers
    Route::resource('customers', CustomerController::class);
});

// ==========================
// ROUTES ADMIN
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus.index');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');
});

// ==========================
// ROUTES KASIR
// ==========================
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
    Route::get('/orders/new', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/receipt', [OrderController::class, 'receipt'])->name('orders.receipt');
    Route::get('/orders/{id}/receipt', [OrderController::class, 'receipt'])->name('orders.receipt');



    // Sales (Penjualan)
    Route::prefix('sales')->controller(SaleController::class)->group(function () {
        Route::get('/', 'index')->name('sales.index');
        Route::get('/create', 'create')->name('sales.create');
        Route::post('/', 'store')->name('sales.store');
        Route::get('/{id}/edit', 'edit')->name('sales.edit');
        Route::put('/{id}', 'update')->name('sales.update');
        Route::delete('/{id}', 'destroy')->name('sales.destroy');
        Route::get('/show/{id}', 'show')->name('sales.show');
        Route::get('/receipt/{id}', 'receipt')->name('sales.receipt');
    });
});

// ==========================
// ROUTES PELAYAN
// ==========================
Route::middleware(['auth', 'role:pelayan'])->prefix('pelayan')->group(function () {
    Route::get('/dashboard', [PelayanController::class, 'index'])->name('pelayan.dashboard');
});
