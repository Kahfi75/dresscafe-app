<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan Dashboard Admin
    public function index()
    {
        // Total penjualan bulan ini
        $totalSales = Sale::whereMonth('tanggal', now()->month)
                          ->whereYear('tanggal', now()->year) // Ensure the year is also considered
                          ->sum('total_price');

        // Total order hari ini
        $totalOrder = Sale::whereDate('tanggal', now()->toDateString())->count();

        // Total pelanggan (berbeda user_id)
        $totalCustomers = Sale::distinct('user_id')->count('user_id');
        
        // Return the data to the view
        return view('admin.dashboard', compact('totalSales', 'totalOrder', 'totalCustomers'));
    }

    // Mendapatkan data grafik penjualan
    public function chartData()
    {
        // Ambil data grafik per hari
        $salesData = Sale::selectRaw('DATE(tanggal) as date, count(*) as transactions, sum(total_price) as revenue')
                         ->groupBy('date')
                         ->orderBy('date')
                         ->get();

        // Menyiapkan data untuk grafik
        $labels = $salesData->pluck('date');
        $transactions = $salesData->pluck('transactions');
        $revenue = $salesData->pluck('revenue');

        // Mengembalikan data sebagai JSON
        return response()->json([
            'labels' => $labels,
            'transactions' => $transactions,
            'revenue' => $revenue,
        ]);
    }
}
