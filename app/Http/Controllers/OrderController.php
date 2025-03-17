<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Tampilkan daftar pesanan
    public function index(Request $request)
    {
        $query = Order::with('orderItems.menu')->orderBy('created_at', 'desc');

        if ($request->has('status') && in_array($request->status, ['Pending', 'Completed', 'Canceled'])) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();
        return view('orders.index', compact('orders'));
    }

    // Tampilkan form tambah pesanan
    public function create()
    {
        $menus = Menu::all(); // Ambil semua menu
        return view('orders.create', compact('menus'));
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'menus' => 'required|array', // Menu harus berupa array
            'menus.*.menu_id' => 'required|exists:menus,id',
            'menus.*.quantity' => 'required|integer|min:1',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an order.');
        }

        $total_price = 0;
        foreach ($request->menus as $menu) {
            $menuData = Menu::findOrFail($menu['menu_id']);
            $total_price += $menuData->price * $menu['quantity'];
        }

        // Simpan order utama
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'total_price' => $total_price,
            'status' => 'Pending',
        ]);

        // Simpan detail pesanan (order items)
        foreach ($request->menus as $menu) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu['menu_id'],
                'quantity' => $menu['quantity'],
                'subtotal' => Menu::findOrFail($menu['menu_id'])->price * $menu['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order successfully created!');
    }

    // Tampilkan detail pesanan
    public function show($id)
    {
        $order = Order::with('orderItems.menu')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Tampilkan form edit pesanan
    public function edit($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $menus = Menu::all();
        return view('orders.edit', compact('order', 'menus'));
    }

    // Update pesanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed,Canceled',
            'menus' => 'required|array',
            'menus.*.menu_id' => 'required|exists:menus,id',
            'menus.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'customer_name' => $request->customer_name,
            'status' => $request->status,
        ]);

        // Hapus order_items lama dan buat ulang
        $order->orderItems()->delete();
        $total_price = 0;
        foreach ($request->menus as $menu) {
            $menuData = Menu::findOrFail($menu['menu_id']);
            $subtotal = $menuData->price * $menu['quantity'];
            $total_price += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu['menu_id'],
                'quantity' => $menu['quantity'],
                'subtotal' => $subtotal,
            ]);
        }

        $order->update(['total_price' => $total_price]);

        return redirect()->route('orders.index')->with('success', 'Order successfully updated!');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order successfully deleted!');
    }
}
