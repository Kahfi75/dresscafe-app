<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Pengeluaran;
use App\Models\Menu;
use App\Models\Supplier;
use App\Models\Activity;

class ReportController extends Controller
{
    // Halaman utama laporan
    public function index(Request $request)
    {
        // Mengambil data untuk halaman utama laporan
        $orders = Order::all();
        $totalOrder = $orders->count();
        $totalOmzet = Order::where('status', 'selesai')->sum('total_price');
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $labaKotor = $totalOmzet - $totalPengeluaran;

        $jumlahMenu = Menu::count();
        $jumlahSupplier = Supplier::count();

        $recentActivities = Activity::latest()->take(5)->get();

        return view('reports.index', compact(
            'totalOrder',
            'totalOmzet',
            'totalPengeluaran',
            'labaKotor',
            'jumlahMenu',
            'jumlahSupplier',
            'recentActivities'
        ));
    }

    // Laporan order berdasarkan filter tanggal
    public function order(Request $request)
    {
        // Mengambil data order dengan filter tanggal jika ada
        $orders = Order::with('orderItems.menu')
            ->when($request->start_date, fn($q) =>
                $q->whereDate('created_at', '>=', $request->start_date)
            )
            ->when($request->end_date, fn($q) =>
                $q->whereDate('created_at', '<=', $request->end_date)
            )
            ->latest()
            ->get();

        return view('reports.order', compact('orders'));
    }

    // Laporan omzet berdasarkan filter tanggal
    public function omset(Request $request)
    {
        // Mengambil data omzet dengan filter tanggal jika ada
        $orders = Order::where('status', 'selesai')
            ->when($request->start_date, fn($q) =>
                $q->whereDate('completed_at', '>=', $request->start_date)
            )
            ->when($request->end_date, fn($q) =>
                $q->whereDate('completed_at', '<=', $request->end_date)
            )
            ->get();

        $totalOmzet = $orders->sum('total_price');

        return view('reports.omset', compact('orders', 'totalOmzet'));
    }

    // Laporan pengeluaran berdasarkan filter tanggal
    public function pengeluaran(Request $request)
    {
        // Mengambil data pengeluaran dengan filter tanggal jika ada
        $pengeluaran = Pengeluaran::query()
            ->when($request->start_date, fn($q) =>
                $q->whereDate('created_at', '>=', $request->start_date)
            )
            ->when($request->end_date, fn($q) =>
                $q->whereDate('created_at', '<=', $request->end_date)
            )
            ->get();

        $total = $pengeluaran->sum('jumlah');

        return view('reports.pengeluaran', compact('pengeluaran', 'total'));
    }

    // Laporan Bisnis - Top 5 menu, omzet, laba kotor
    public function showBusinessReport()
    {
        // Mengambil top 5 menu berdasarkan jumlah penjualan terbanyak
        $topMenus = Menu::withCount('orderItems')  // Menghitung jumlah orderItems per menu
                         ->orderByDesc('order_items_count')  // Mengurutkan berdasarkan jumlah orderItems
                         ->take(5)  // Ambil 5 menu terlaris
                         ->get();

        // Mengambil data omzet, total order, laba kotor dan pengeluaran
        $totalOmzet = Order::where('status', 'selesai')->sum('total_price');  // Omzet dari order yang selesai
        $totalOrder = Order::count();  // Jumlah total order
        $labaKotor = $totalOmzet - Pengeluaran::sum('jumlah');  // Laba Kotor = omzet - pengeluaran
        $totalPengeluaran = Pengeluaran::sum('jumlah');  // Total pengeluaran

        // Mengirim data ke view
        return view('reports.business-report', compact('topMenus', 'totalOmzet', 'totalOrder', 'labaKotor', 'totalPengeluaran'));
    }
}
