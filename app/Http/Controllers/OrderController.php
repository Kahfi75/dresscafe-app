<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();
        return view('orders.index', compact('orders'));
    }

    // Tampilkan form tambah pesanan
    public function create()
    {
        return view('orders.create');
    }

    // Simpan pesanan baru
    public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'total_price' => 'required|numeric|min:0',
        'status' => 'required|in:Pending,Completed,Canceled',
    ]);

    Order::create([
        'user_id' => auth()->id(), // Pastikan ini ada
        'customer_name' => $request->customer_name,
        'total_price' => $request->total_price,
        'status' => $request->status,
    ]);

    return redirect()->route('orders.index')->with('success', 'Order successfully created!');
}


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
