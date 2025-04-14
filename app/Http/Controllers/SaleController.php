<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Menu;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer')->latest()->paginate(10);
        $customers = Customer::all();
        $menus = Menu::all();

        return view('sales.index', compact(
            'sales',
            'customers',
            'menus'
        ));
    }

    public function create()
    {
        $customers = Customer::all();
        $menus = Menu::all();

        return view('sales.create', compact('customers', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'menu_id' => 'required|array',
            'menu_id.*' => 'required|exists:menu,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card,digital',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $total_price = 0;
            foreach ($request->menu_id as $index => $menuId) {
                $menu = Menu::findOrFail($menuId);
                $total_price += $menu->price * $request->quantity[$index];
            }

            $sale = Sale::create([
                'user_id' => $request->user_id,
                'customer_id' => $request->customer_id,
                'tanggal' => now(),
                'total_price' => $total_price,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->paid_amount - $total_price,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->paid_amount >= $total_price ? 'Lunas' : 'Tertunda',
            ]);

            foreach ($request->menu_id as $index => $menuId) {
                $menu = Menu::findOrFail($menuId);
                $quantity = $request->quantity[$index];

                if ($menu->stock < $quantity) {
                    throw new \Exception("Stok menu '{$menu->name}' tidak mencukupi.");
                }

                $menu->decrement('stock', $quantity);

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'menu_id' => $menuId,
                    'quantity' => $quantity,
                    'price' => $menu->price,
                ]);
            }

            DB::commit();
            return redirect()->route('sales.receipt', $sale->id)->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $sale = Sale::with('saleDetails')->findOrFail($id);
        $customers = Customer::all();
        $menus = Menu::all();

        return view('sales.edit', compact('sale', 'customers', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'menu_id' => 'required|array',
            'menu_id.*' => 'required|exists:menu,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card,digital',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $sale = Sale::with('saleDetails')->findOrFail($id);

            // Kembalikan stok lama
            foreach ($sale->saleDetails as $detail) {
                $menu = Menu::find($detail->menu_id);
                if ($menu) {
                    $menu->increment('stock', $detail->quantity);
                }
            }

            SaleDetail::where('sale_id', $sale->id)->delete();

            $total_price = 0;
            foreach ($request->menu_id as $index => $menuId) {
                $menu = Menu::findOrFail($menuId);
                $total_price += $menu->price * $request->quantity[$index];
            }

            $sale->update([
                'customer_id' => $request->customer_id,
                'total_price' => $total_price,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->paid_amount - $total_price,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->paid_amount >= $total_price ? 'Lunas' : 'Tertunda',
            ]);

            foreach ($request->menu_id as $index => $menuId) {
                $menu = Menu::findOrFail($menuId);
                $quantity = $request->quantity[$index];

                if ($menu->stock < $quantity) {
                    throw new \Exception("Stok menu '{$menu->name}' tidak mencukupi.");
                }

                $menu->decrement('stock', $quantity);

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'menu_id' => $menuId,
                    'quantity' => $quantity,
                    'price' => $menu->price,
                ]);
            }

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $sale = Sale::with('saleDetails')->findOrFail($id);

            foreach ($sale->saleDetails as $detail) {
                $menu = Menu::find($detail->menu_id);
                if ($menu) {
                    $menu->increment('stock', $detail->quantity);
                }
            }

            $sale->saleDetails()->delete();
            $sale->delete();

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }

    public function receipt($id)
    {
        $sale = Sale::with('saleDetails.menu')->findOrFail($id);
        return view('sales.receipt', compact('sale'));
    }

    public function show($id)
    {
        $sale = Sale::with(['user', 'customer', 'saleDetails.menu'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }
}