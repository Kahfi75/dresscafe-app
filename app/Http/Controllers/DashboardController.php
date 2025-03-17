<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Hitung total order hari ini
        $totalOrder = Order::whereDate('created_at', $today)->count();

        // Hitung total pendapatan hari ini dari tabel payments
        $totalRevenue = Payment::whereDate('created_at', $today)->sum('total');

        // Ambil menu terlaris dari order_items
        $topMenu = Menu::join('order_items', 'menu.id', '=', 'order_items.menu_id')
            ->select('menu.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('menu.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('totalOrder', 'totalRevenue', 'topMenu'));
    }
}
