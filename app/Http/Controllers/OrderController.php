<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan daftar order
    public function index(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::with('orderItems.menu')
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Menampilkan form untuk membuat order baru
    public function create()
    {
        $menus = Menu::all(); // Mengambil semua menu
        return view('orders.create', compact('menus'));
    }

    // Menyimpan order baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'menu' => 'required|array',
            'menu.*.menu_id' => 'required|exists:menu,id', // Validasi ID menu
            'menu.*.quantity' => 'required|integer|min:1', // Validasi kuantitas
        ]);

        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an order.');
        }

        // Menghitung total harga
        $total_price = 0;
        foreach ($request->menu as $menuItem) {
            $menuData = Menu::findOrFail($menuItem['menu_id']);
            $total_price += $menuData->price * $menuItem['quantity'];
        }

        // Membuat entry order baru
        $order = Order::create([
            'user_id' => Auth::id(),  // Menyimpan user_id yang sedang login
            'customer_name' => $request->customer_name,
            'total_price' => $total_price,
            'status' => 'Pending',  // Status default
        ]);

        // Menyimpan item-item pesanan
        foreach ($request->menu as $menuItem) {
            $menuData = Menu::findOrFail($menuItem['menu_id']);
            $subtotal = $menuData->price * $menuItem['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menuItem['menu_id'],
                'quantity' => $menuItem['quantity'],
                'subtotal' => $subtotal,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Order successfully created!');
    }

    // Menampilkan detail order
    public function show($id)
    {
        $order = Order::with('orderItems.menu')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Menampilkan form untuk edit order
    public function edit($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $menus = Menu::all();
        return view('orders.edit', compact('order', 'menus'));
    }

    // Memperbarui data order
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed,Canceled',
            'menu' => 'required|array',
            'menu.*.menu_id' => 'required|exists:menu,id',
            'menu.*.quantity' => 'required|integer|min:1',
        ]);

        // Menemukan order berdasarkan ID
        $order = Order::findOrFail($id);
        $order->update([
            'customer_name' => $request->customer_name,
            'status' => $request->status,
        ]);

        // Menghapus order items lama dan menambahkan yang baru
        $order->orderItems()->delete();

        $total_price = 0;
        foreach ($request->menu as $menuItem) {
            $menuData = Menu::findOrFail($menuItem['menu_id']);
            $subtotal = $menuData->price * $menuItem['quantity'];
            $total_price += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menuItem['menu_id'],
                'quantity' => $menuItem['quantity'],
                'subtotal' => $subtotal,
            ]);
        }

        // Memperbarui total harga
        $order->update(['total_price' => $total_price]);

        return redirect()->route('orders.index')->with('success', 'Order successfully updated!');
    }

    // Menghapus order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete();  // Menghapus item-item order
        $order->delete();  // Menghapus order

        return redirect()->route('orders.index')->with('success', 'Order successfully deleted!');
    }
}
