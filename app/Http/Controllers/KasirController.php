<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasirController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Data statistik
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $completedOrders = Order::where('status', 'Completed')->count();
        $cancelledOrders = Order::where('status', 'Cancelled')->count();
        $totalRevenue = Order::where('status', 'Completed')->sum('total_price');

        // Data hari ini
        $totalTransaksi = Order::whereDate('created_at', $today)->count();
        $totalPenjualan = Order::whereDate('created_at', $today)->sum('total_price');
        $jumlahPesanan = $totalTransaksi;

        // Menu terlaris hari ini
        $menuTerlaris = OrderItem::select('menu_id', DB::raw('SUM(quantity) as jumlah_terjual'))
            ->whereHas('order', function ($q) use ($today) {
                $q->whereDate('created_at', $today);
            })
            ->groupBy('menu_id')
            ->with('menu')
            ->orderByDesc('jumlah_terjual')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'nama_menu' => $item->menu->name ?? '-',
                    'jumlah_terjual' => $item->jumlah_terjual,
                ];
            });

        // Pesanan terbaru
        $pesananTerbaru = Order::latest()->take(10)->get();

        return view('kasir.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalRevenue',
            'totalTransaksi',
            'totalPenjualan',
            'jumlahPesanan',
            'menuTerlaris',
            'pesananTerbaru'
        ));
    }
}
