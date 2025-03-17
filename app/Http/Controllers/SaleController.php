<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Menu;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user', 'customer')->latest()->get(); // Fix: 'customer' instead of 'customers'
        $menu = Menu::all();

        return view('sales.index', compact('sales', 'menu'));
    }

    public function create()
    {
        $menu = Menu::where('stock', '>', 0)->get();
        $customers = Customer::all();
        return view('sales.create', compact('menu', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'menu_id' => 'required|array',
            'menu_id.*' => 'exists:menu,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'payment_method' => 'required|in:cash,card'
        ]);

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'user_id' => Auth::id(),
                'total_price' => 0,
                'payment_method' => $request->payment_method,
            ]);

            $totalPrice = 0;
            foreach ($request->menu_id as $index => $menuId) {
                $menu = Menu::findOrFail($menuId);
                $quantity = $request->quantity[$index];

                if ($menu->stock < $quantity) {
                    return back()->withErrors(['error' => 'Stok tidak mencukupi untuk ' . $menu->name]);
                }

                $subtotal = $menu->price * $quantity;

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'menu_id' => $menuId,
                    'quantity' => $quantity,
                    'price' => $menu->price,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok menu setelah transaksi
                $menu->decrement('stock', $quantity);
                $totalPrice += $subtotal;
            }

            $sale->update(['total_price' => $totalPrice]);

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Transaksi gagal: ' . $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $sale = Sale::with('details')->findOrFail($id);
        $menu = Menu::where('stock', '>', 0)->get();
        $customers = Customer::all();
        return view('sales.edit', compact('sale', 'menu', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_id' => 'required|array',
            'menu_id.*' => 'exists:menu,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'payment_method' => 'required|in:cash,card'
        ]);

        DB::beginTransaction();
        try {
            $sale = Sale::findOrFail($id);

            // Pastikan ada detail sebelum dihapus
            if ($sale->details->count() > 0) {
                foreach ($sale->details as $detail) {
                    $menu = Menu::find($detail->menu_id);
                    if ($menu) {
                        $menu->increment('stock', $detail->quantity);
                    }
                }
                $sale->details()->delete();
            }

            $totalPrice = 0;
            foreach ($request->menu_id as $index => $menuId) {
                $menu = Menu::findOrFail($menuId);
                $quantity = $request->quantity[$index];

                if ($menu->stock < $quantity) {
                    return back()->withErrors(['error' => 'Stock tidak mencukupi untuk ' . $menu->name]);
                }

                $subtotal = $menu->price * $quantity;

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'menu_id' => $menuId,
                    'quantity' => $quantity,
                    'price' => $menu->price,
                    'subtotal' => $subtotal,
                ]);

                $menu->decrement('stock', $quantity);
                $totalPrice += $subtotal;
            }

            $sale->update([
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
            ]);

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Transaksi berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Gagal memperbarui transaksi: ' . $e->getMessage()]);
        }
    }

    public function receipt($id)
    {
        $sale = Sale::with('details.menu', 'user', 'customer')->findOrFail($id);
        return view('sales.receipt', compact('sale'));
    }
    public function show($id)
    {
        $sale = Sale::with('details.menu', 'customer', 'user')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }
}
