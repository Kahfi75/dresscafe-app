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
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::with('orderItems.menu')
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $customers = \App\Models\Customer::all();
        $menus = Menu::all();

        return view('orders.index', compact('orders', 'customers', 'menus'));
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
            $menuData = Menu::findOrFail($menuItem['menu_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menuItem['menu_id'],
                'quantity' => $menuItem['quantity'],
                'subtotal' => $menuData->price * $menuItem['quantity'],
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
        $order->update([
            'customer_name' => $validated['customer_name'],
            'status' => $validated['status']
        ]);

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

    public function markComplete($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'Completed') {
            $order->status = 'Completed';
            $order->completed_at = now();
            $order->save();

            return redirect()->back()->with('success', 'Order marked as completed successfully!');
        }

        return redirect()->back()->with('info', 'Order is already completed');
    }

    public function markCancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'Pending') {
            $order->status = 'Cancelled';
            $order->cancelled_at = now();
            $order->save();

            return redirect()->back()->with('success', 'Order has been cancelled successfully!');
        }

        return redirect()->back()->with('error', 'Only pending orders can be cancelled');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Completed,Cancelled'
        ]);

        $order = Order::findOrFail($id);
        $newStatus = $request->status;

        if ($order->status === 'Completed' && $newStatus !== 'Completed') {
            return redirect()->back()->with('error', 'Completed orders cannot be changed');
        }

        if ($order->status === 'Cancelled' && $newStatus !== 'Cancelled') {
            return redirect()->back()->with('error', 'Cancelled orders cannot be changed');
        }

        $order->status = $newStatus;

        if ($newStatus === 'Completed') {
            $order->completed_at = now();
        } elseif ($newStatus === 'Cancelled') {
            $order->cancelled_at = now();
        }

        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    public function clearAll()
    {
        Order::whereIn('status', ['completed', 'cancelled'])->delete();
        return redirect()->route('orders.index')->with('success', 'All applicable orders have been soft deleted.');
    }

    public function receipt($id)
    {
        $order = Order::with(['orderItems.menu', 'user'])->findOrFail($id);
        return view('orders.receipt', compact('order'));
    }
}
