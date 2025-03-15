<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalOrder = Order::whereDate('created_at', $today)->count();
        $totalRevenue = Payment::whereDate('created_at', $today)->sum('total');
        $topMenu = Menu::join('order_item', 'menu.id', '=', 'order_item.menu_id')
            ->select('menu.name', DB::raw('SUM(order_item.quantity) as total_sold'))
            ->groupBy('menu.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();


        return view('dashboard.index', compact('totalOrder', 'totalRevenue', 'topMenu'));
    }
}
