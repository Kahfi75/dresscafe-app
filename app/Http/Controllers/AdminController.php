<?php

// App\Http\Controllers\AdminController.php
namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method untuk menampilkan halaman dashboard
    public function index()
    {
        // Ambil data aktivitas terbaru atau informasi lain yang dibutuhkan
        $recentActivities = Sale::latest()->take(5)->get();  // Ambil aktivitas terbaru (misal 5 aktivitas terakhir)

        // Kembalikan view dengan data
        return view('admin.dashboard', compact('recentActivities'));
    }

    // Method untuk mengembalikan data grafik penjualan
    public function chartData()
    {
        // Ambil data penjualan per hari
        $salesData = Sale::selectRaw('DATE(created_at) as date, sum(total_price) as total_sales, count(id) as total_orders')
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->get();

        // Format data untuk chart
        $labels = $salesData->pluck('date');
        $sales = $salesData->pluck('total_sales');
        $orders = $salesData->pluck('total_orders');

        return response()->json([
            'labels' => $labels,
            'sales' => $sales,
            'orders' => $orders,
        ]);
    }
}
