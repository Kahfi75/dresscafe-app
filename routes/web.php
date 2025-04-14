<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    PembelianController,
    PengajuanBarangController,
    PaymentController,
    CustomerController,
    ReportController,
    ExportImportController,
    NotificationController,
    ExportController
};

use App\Models\{Menu, Category, Order, Customer, Pembelian};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DynamicExport;

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
// ROUTES UNTUK SEMUA USER YANG LOGIN
// ==========================
Route::middleware(['auth'])->group(function () {

    // Notifications
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');

    // ==========================
    // Export/Import Routes
    // ==========================
    Route::prefix('export-import')->group(function () {
        Route::get('/', [ExportImportController::class, 'index'])->name('export-import.index');
        Route::get('/export', [ExportImportController::class, 'index'])->name('export.index');
        Route::get('/export/excel/{type}', [ExportImportController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf/{type}', [ExportImportController::class, 'exportPdf'])->name('export.pdf');
        Route::post('/import/excel/{type}', [ExportImportController::class, 'importExcel'])->name('import.excel');

        Route::get('/export/menu', [MenuController::class, 'getMenuData']);
        Route::get('/menu/export', [MenuController::class, 'export'])->name('menu.export');

        Route::get('/export/{table}', [ExportImportController::class, 'export'])->name('export.data');
        Route::get('/export-pdf/{table}', [ExportImportController::class, 'exportPdf'])->name('export.pdf');
        Route::post('/import', [ExportImportController::class, 'import'])->name('import.data');

        Route::get('/export/pdf/orders', [ExportImportController::class, 'exportOrdersPdf'])->name('export.pdf.orders');
        
    });

    // Dynamic export/import routes
    Route::get('/export/import/data', function (Request $request) {
        $modelClass = $request->input('model');
        $model = app($modelClass);
        return response()->json(['data' => $model::all()]);
    });

    Route::post('/export/export-data', function (Request $request) {
        $modelClass = $request->input('model');
        $ids = $request->input('ids');
        $model = app($modelClass);
        $data = $model::whereIn('id', $ids)->get();
        return Excel::download(new DynamicExport($data), 'exported_data.xlsx');
    });

    // ==========================
    // Orders
    // ==========================
    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('orders.index');
        Route::get('/{id}', 'show')->where('id', '[0-9]+')->name('orders.show');
        Route::put('/{id}/cancel', 'markCancel')->name('orders.cancel');
        Route::put('/{id}/complete', 'markComplete')->name('orders.complete');
        Route::delete('/clear-all', 'clearAll')->name('orders.clearAll');
        Route::get('/export-excel', 'exportExcel')->name('orders.exportExcel');
        Route::get('/export-pdf', 'exportPdf')->name('orders.exportPdf');
        Route::get('/{id}/print', 'print')->name('orders.print');
        Route::get('/{id}/print-receipt', 'printReceipt')->name('orders.printReceipt');
        Route::post('/', 'store')->name('orders.store');

        Route::middleware(['auth'])->prefix('orders')->controller(OrderController::class)->group(function () {
            Route::get('/', 'index')->name('orders.index');
            Route::get('/create', 'create')->name('orders.create');
            Route::post('/', 'store')->name('orders.store');
            Route::get('/{order}', 'show')->name('orders.show');
            Route::get('/{order}/edit', 'edit')->name('orders.edit');
            Route::put('/{order}', 'update')->name('orders.update');
            Route::delete('/{order}', 'destroy')->name('orders.destroy');
        
            // Additional order actions
            Route::post('/{order}/complete', 'markComplete')->name('orders.markComplete');
            Route::post('/{order}/cancel', 'markCancel')->name('orders.markCancel');
            Route::post('/{order}/status', 'updateStatus')->name('orders.updateStatus');
            Route::delete('/clear', 'clearAll')->name('orders.clearAll');
        
            // Receipt
            Route::get('/{order}/receipt', 'receipt')->name('orders.receipt');
            Route::get('/{order}/print-receipt', 'printReceipt')->name('orders.printReceipt');
        
            // Notification
            Route::post('/mark-notifications-read', 'markNotificationsRead')->name('orders.markNotificationsRead');
        
            // Export
            Route::get('/export-excel', 'exportExcel')->name('orders.exportExcel');
            Route::get('/export-pdf', 'exportPdf')->name('orders.exportPdf');
        });
    });

    // ==========================
    // Menu Routes
    // ==========================
    Route::resource('menus', MenuController::class);

    // ==========================
    // Payments
    // ==========================
    Route::prefix('payments')->controller(PaymentController::class)->group(function () {
        Route::get('/', 'index')->name('payments.index');
        Route::post('/', 'store')->name('payments.store');
    });

    // ==========================
    // Pengajuan Barang Routes
    // ==========================
    Route::prefix('pengajuan_barang')->controller(PengajuanBarangController::class)->name('pengajuan_barang.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->where('id', '[0-9]+')->name('edit');
        Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
        Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('destroy');
        Route::get('/data', 'getData')->name('data');
        Route::get('/export-excel', 'exportExcel')->name('export-excel');
        Route::get('/export-pdf', 'exportPdf')->name('export-pdf');
        Route::put('/{id}/update-status', 'updateStatus')->where('id', '[0-9]+')->name('update-status');
    });

    // ==========================
    // Customers Routes
    // ==========================
    Route::resource('customers', CustomerController::class);

    // ==========================
    // Dashboard Chart Data
    // ==========================
    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chartData');
});

// ==========================
// EXPORT/IMPORT ROUTES
// ==========================
Route::prefix('export-import')->group(function () {
    // Routes for export/import general
    Route::get('/', [ExportImportController::class, 'index'])->name('export-import.index');
    Route::get('/export', [ExportImportController::class, 'index'])->name('export.index');
    Route::get('/export/excel/{type}', [ExportImportController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf/{type}', [ExportImportController::class, 'exportPdf'])->name('export.pdf');
    Route::post('/import/excel/{type}', [ExportImportController::class, 'importExcel'])->name('import.excel');
    
    // Routes for menu data export/import
    Route::get('/export/menu', [MenuController::class, 'getMenuData']);
    Route::get('/menu/export', [MenuController::class, 'export'])->name('menu.export');
    
    // Export data for specific tables
    Route::get('/export/{table}', [ExportImportController::class, 'export'])->name('export.data');
    Route::get('/export-pdf/{table}', [ExportImportController::class, 'exportPdf'])->name('export.pdf');
    Route::post('/import', [ExportImportController::class, 'import'])->name('import.data');
    
    // Export PDF orders specifically
    Route::get('/export/pdf/orders', [ExportImportController::class, 'exportOrdersPdf'])->name('export.pdf.orders');
    Route::get('/export-import/export-pdf/{type}', [ExportImportController::class, 'exportPdf'])->name('export.pdf');
});

// ==========================
// REPORT ROUTES (ADMIN)
// ==========================
Route::prefix('laporan')->controller(ReportController::class)->group(function () {
    Route::get('/order', 'order')->name('laporan.order');
    Route::get('/omset', 'omset')->name('laporan.omset');
    Route::get('/pengeluaran', 'pengeluaran')->name('laporan.pengeluaran');
});

// ROUTES ADMIN
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/chart-data', [AdminController::class, 'chartData'])->name('admin.dashboard.chart-data');

    Route::resource('categories', CategoryController::class);
    Route::resource('pembelian', PembelianController::class);
    Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus.index');

    // Category Export/Import
    Route::get('/categories/export-excel', [CategoryController::class, 'exportExcel'])->name('categories.export.excel');
    Route::get('/categories/export-pdf', [CategoryController::class, 'exportPdf'])->name('categories.export.pdf');
    Route::post('/categories/import-excel', [CategoryController::class, 'importExcel'])->name('categories.import.excel');

    // Report Routes (Admin)
Route::prefix('reports')->controller(ReportController::class)->group(function () {
    Route::get('/', 'index')->name('reports.index');  // This is the missing route
    Route::get('/order', 'order')->name('laporan.order');
    Route::get('/omset', 'omset')->name('laporan.omset');
    Route::get('/pengeluaran', 'pengeluaran')->name('laporan.pengeluaran');
});

});

// ==========================
// ROUTES KASIR
// ==========================
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');

    Route::prefix('sales')->controller(SaleController::class)->group(function () {
        Route::get('/', 'index')->name('sales.index');
        Route::get('/create', 'create')->name('sales.create');
        Route::post('/', 'store')->name('sales.store');
        Route::get('/{id}/edit', 'edit')->name('sales.edit');
        Route::put('/{id}', 'update')->name('sales.update');
        Route::delete('/{id}', 'destroy')->name('sales.destroy');
    });
});
