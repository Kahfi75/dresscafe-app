<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UserExport;
use App\Exports\SalesExport;
use App\Exports\MenusExport;
use App\Exports\OrderItemsExport;
use App\Exports\CategoriesExport;
use App\Exports\MenuExport;
use App\Imports\UsersImport;
use App\Imports\SalesImport;
use App\Imports\MenusImport;
use App\Imports\OrderItemsImport;
use App\Imports\CategoriesImport;
use App\Models\User;
use App\Models\Sale;
use App\Models\Menu;
use App\Models\OrderItem;
use App\Models\Category;
use Carbon\Carbon;

class ExportImportController extends Controller
{
    // View to handle export/import
    public function index()
    {
        return view('export-import.index');
    }

    // Export data to Excel
    public function exportExcel($type)
    {
        $date = Carbon::now()->format('Y-m-d_H-i-s'); // Adding timestamp to filename

        return match ($type) {
            'users' => Excel::download(new UserExport, 'users_' . $date . '.xlsx'),
            'sales' => Excel::download(new SalesExport, 'sales_' . $date . '.xlsx'),
            'menus' => Excel::download(new MenuExport, 'menus_' . $date . '.xlsx'),
            'order_items' => Excel::download(new OrderItemsExport, 'order_items_' . $date . '.xlsx'),
            'categories' => Excel::download(new CategoriesExport, 'categories_' . $date . '.xlsx'),
            default => abort(404, 'Tipe data tidak ditemukan'),
        };
    }

    // Import data from Excel
    public function importExcel(Request $request, $type)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = match ($type) {
            'users' => new UsersImport,
            'sales' => new SalesImport,
            'menus' => new MenusImport,
            'order_items' => new OrderItemsImport,
            'categories' => new CategoriesImport,
            default => abort(404, 'Tipe data tidak ditemukan'),
        };

        Excel::import($import, $request->file('file'));

        return back()->with('success', ucfirst($type) . ' berhasil diimpor.');
    }

    // Export data to PDF
    public function exportPdf($type)
    {
        // Retrieve data based on the type
        $data = match ($type) {
            'users' => User::all(),
            'sales' => Sale::all(),
            'menus' => Menu::all(),
            'order_items' => OrderItem::all(),
            'categories' => Category::all(),
            default => abort(404, 'Tipe data tidak ditemukan'),
        };

        // Generate PDF using the PDF view
        $pdf = Pdf::loadView('export-import.pdf', compact('data', 'type'));

        return $pdf->download("{$type}_" . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf');
    }
}
