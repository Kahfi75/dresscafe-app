<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $orders = Order::with(['orderItems.menu', 'customer', 'user'])  // Pastikan memuat 'customer' dan 'user'
            ->when($status, fn($query) => $query->where('status', $status))
            ->when($search, function ($query) use ($search) {
                $query->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('id', $search);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 10));

        $pendingCount = Order::where('status', 'Pending')->count();
        $completedCount = Order::where('status', 'Completed')->count();
        $pendingKitchenOrders = $pendingCount;

        $kitchenNotifications = Notification::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        Log::info('User viewed orders index', ['user_id' => Auth::id()]);

        return view('orders.index', [
            'orders' => $orders,
            'pendingCount' => $pendingCount,
            'completedCount' => $completedCount,
            'pendingKitchenOrders' => $pendingKitchenOrders,
            'kitchenNotifications' => $kitchenNotifications,
            'customers' => Customer::all(),
            'menus' => Menu::all(),
        ]);
    }

    public function create()
    {
        $menus = Menu::all();
        $customers = Customer::all();

        Log::info('User accessed order creation form', ['user_id' => Auth::id()]);
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

        Log::info('New order created', ['order_id' => $order->id, 'user_id' => Auth::id()]);
        return redirect()->route('orders.index')->with('success', 'Order successfully created!');
    }

    public function show($id)
    {
        $order = Order::with('orderItems.menu')->findOrFail($id);
        Log::info('Viewing order detail', ['order_id' => $id, 'user_id' => Auth::id()]);
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $menu = Menu::all();
        Log::info('Editing order', ['order_id' => $id, 'user_id' => Auth::id()]);
        return view('orders.edit', compact('order', 'menu'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed,Cancelled',
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

        Log::info('Order updated', ['order_id' => $id, 'user_id' => Auth::id()]);
        return redirect()->route('orders.index')->with('success', 'Order successfully updated!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete();
        $order->delete();

        Log::warning('Order deleted', ['order_id' => $id, 'user_id' => Auth::id()]);
        return redirect()->route('orders.index')->with('success', 'Order successfully deleted!');
    }

    public function markComplete($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'Completed') {
            $order->update([
                'status' => 'Completed',
                'completed_at' => now()
            ]);

            Notification::create([
                'order_id' => $order->id,
                'message' => 'Order #' . $order->id . ' marked as completed',
            ]);

            Log::info('Order marked as completed', ['order_id' => $id, 'user_id' => Auth::id()]);
            return back()->with('success', 'Order marked as completed successfully!');
        }

        Log::info('Attempt to re-complete an already completed order', ['order_id' => $id]);
        return back()->with('info', 'Order is already completed');
    }

    public function markCancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'Pending') {
            $order->update([
                'status' => 'Cancelled',
                'cancelled_at' => now()
            ]);

            Notification::create([
                'order_id' => $order->id,
                'message' => 'Order #' . $order->id . ' was cancelled',
            ]);

            Log::info('Order cancelled', ['order_id' => $id, 'user_id' => Auth::id()]);
            return back()->with('success', 'Order has been cancelled successfully!');
        }

        Log::warning('Invalid cancel attempt', ['order_id' => $id]);
        return back()->with('error', 'Only pending orders can be cancelled');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Completed,Cancelled'
        ]);

        $order = Order::findOrFail($id);
        $newStatus = $request->status;

        if (($order->status === 'Completed' && $newStatus !== 'Completed') ||
            ($order->status === 'Cancelled' && $newStatus !== 'Cancelled')
        ) {
            Log::error('Attempt to change finalized order status', ['order_id' => $id]);
            return back()->with('error', 'Finalized orders cannot be changed');
        }

        $order->status = $newStatus;
        if ($newStatus === 'Completed') {
            $order->completed_at = now();
        } elseif ($newStatus === 'Cancelled') {
            $order->cancelled_at = now();
        }
        $order->save();

        Log::info('Order status updated', ['order_id' => $id, 'new_status' => $newStatus]);
        return back()->with('success', 'Order status updated successfully!');
    }

    public function clearAll()
    {
        $deleted = Order::whereIn('status', ['Completed', 'Cancelled'])->delete();
        Log::warning('Bulk delete orders', ['deleted_count' => $deleted]);
        return redirect()->route('orders.index')->with('success', 'All applicable orders have been deleted.');
    }

    // OrderController.php
    public function receipt($id)
    {
        $order = Order::with(['orderItems.menu', 'user', 'customer'])->findOrFail($id);  // Memuat 'user' dan 'customer'
        Log::info('Viewing receipt', ['order_id' => $id, 'user_id' => Auth::id()]);
        return view('orders.receipt', compact('order'));
    }


    public function printReceipt(Order $order)
    {
        return view('orders.receipt', compact('order'));
    }

    public function markNotificationsRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
