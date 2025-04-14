<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sale;
use App\Models\Pembelian;
use App\Models\Menu;
use App\Models\Supplier;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $totalOrder = Order::count();
        $totalOmzet = Sale::sum('total_price');
        $totalPengeluaran = Pembelian::sum('total_harga');
        $labaKotor = $totalOmzet - $totalPengeluaran;
        $jumlahMenu = Menu::count();
        $jumlahSupplier = Supplier::count();
        $jumlahUser = User::count();

        return view('laporan.index', compact(
            'totalOrder', 'totalOmzet', 'totalPengeluaran',
            'labaKotor', 'jumlahMenu', 'jumlahSupplier', 'jumlahUser'
        ));
    }

    public function exportPdf()
    {
        $data = [
            'totalOrder' => Order::count(),
            'totalOmzet' => Sale::sum('total_price'),
            'totalPengeluaran' => Pembelian::sum('total_harga'),
            'labaKotor' => Sale::sum('total_price') - Pembelian::sum('total_harga'),
            'jumlahMenu' => Menu::count(),
            'jumlahSupplier' => Supplier::count(),
            'jumlahUser' => User::count(),
        ];

        $pdf = Pdf::loadView('laporan.pdf', $data);
        return $pdf->download('laporan-dresscafe.pdf');
    }
}
