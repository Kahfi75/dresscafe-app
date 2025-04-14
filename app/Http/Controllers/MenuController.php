<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MenuExport;
use App\Imports\MenuImport;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category');

        // Filter pencarian nama menu
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menus = $query->get();
        $categories = Category::all();

        return view('menus.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Menu::create($request->only(['name', 'price', 'category_id']));

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();
        return view('menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->only(['name', 'price', 'category_id']));

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
    }

    public function exportExcel()
    {
        return Excel::download(new MenuExport, 'menus.xlsx');
    }

    public function exportPdf()
    {
        $menus = Menu::with('category')->get();
        $pdf = Pdf::loadView('menus.pdf', compact('menus'));
        return $pdf->download('menus.pdf');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new MenuImport, $request->file('file'));
            return redirect()->route('menus.index')->with('success', 'Import menu berhasil!');
        } catch (\Exception $e) {
            return redirect()->route('menus.index')->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function getMenuData()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }
}
