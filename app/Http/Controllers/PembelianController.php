<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Supplier;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    // Tampilkan halaman index pembelian
    public function index()
    {
        $pembelians = Pembelian::with('supplier')->latest()->get();
        $suppliers = Supplier::all();
        $menus = Menu::all();

        return view('pembelian.index', compact('pembelians', 'suppliers', 'menus'));
    }

    // Simpan data pembelian baru
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menu,id',
            'items.*.jumlah' => 'required|numeric|min:1',
            'items.*.harga_beli' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $total = collect($request->items)->sum(function ($item) {
                return $item['jumlah'] * $item['harga_beli'];
            });

            $pembelian = Pembelian::create([
                'supplier_id' => $request->supplier_id,
                'tanggal' => $request->tanggal,
                'total_harga' => $total,
            ]);

            foreach ($request->items as $item) {
                PembelianDetail::create([
                    'pembelian_id' => $pembelian->id,
                    'menu_id' => $item['menu_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_beli' => $item['harga_beli'],
                ]);
            }

            DB::commit();
            return redirect()->route('pembelian.index')->with('success', 'Transaksi pembelian berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // Hapus data pembelian
    public function destroy($id)
    {
        try {
            $pembelian = Pembelian::with('details')->findOrFail($id);

            // Hapus semua detail terlebih dahulu
            $pembelian->details()->delete();

            // Lalu hapus pembelian
            $pembelian->delete();

            return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
