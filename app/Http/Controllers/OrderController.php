<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Memastikan user login sebelum mengakses
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::with('orderItems.menu')
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menus = Menu::all();
        $customers = \App\Models\Customer::all();
        return view('orders.create', compact('menus', 'customers'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'menu' => 'required|array|min:1',
            'menu.*.menu_id' => 'required|exists:menu,id',
            'menu.*.quantity' => 'required|integer|min:1',
        ]);

        $total_price = 0;
        foreach ($validated['menu'] as $menuItem) {
            $menuData = Menu::findOrFail($menuItem['menu_id']);
            $total_price += $menuData->price * $menuItem['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $validated['customer_name'],
            'total_price' => $total_price,
            'status' => 'Pending',
        ]);

        foreach ($validated['menu'] as $menuItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menuItem['menu_id'],
                'quantity' => $menuItem['quantity'],
                'subtotal' => Menu::findOrFail($menuItem['menu_id'])->price * $menuItem['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order successfully created!');
    }

    public function show($id)
    {
        $order = Order::with('orderItems.menu')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $menu = Menu::all();
        return view('orders.edit', compact('order', 'menu'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed,Canceled',
            'menu' => 'required|array|min:1',
            'menu.*.menu_id' => 'required|exists:menu,id',
            'menu.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['customer_name' => $validated['customer_name'], 'status' => $validated['status']]);

        $order->orderItems()->delete();
        $total_price = 0;

        foreach ($validated['menu'] as $menuItem) {
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

        $order->update(['total_price' => $total_price]);

        return redirect()->route('orders.index')->with('success', 'Order successfully updated!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order successfully deleted!');
    }
}
