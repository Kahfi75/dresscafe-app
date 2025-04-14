<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\SalesImport;
use App\Imports\MenusImport;
use App\Imports\OrderItemsImport;
use App\Imports\CategoriesImport;
use Carbon\Carbon;

class ImportController extends Controller
{
    // View to handle the import page
    public function index()
    {
        return view('import.index');
    }

    // Import data from Excel
    public function importExcel(Request $request, $type)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Determine the import logic based on the type of data
        $import = match ($type) {
            'users' => new UsersImport(),
            'sales' => new SalesImport(),
            'menus' => new MenusImport(),
            'order_items' => new OrderItemsImport(),
            'categories' => new CategoriesImport(),
            default => abort(404, 'Tipe data tidak ditemukan'),
        };

        // Perform the import
        Excel::import($import, $request->file('file'));

        // Redirect back with success message
        return back()->with('success', ucfirst($type) . ' berhasil diimpor.');
    }
}
