<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Menampilkan daftar penjualan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan semua data penjualan
        $sales = Sale::all();

        // Mengirim data penjualan ke view
        return view('sales.index', compact('sales'));
    }

    /**
     * Menampilkan form untuk membuat transaksi penjualan baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Ambil semua pelanggan dari database
        $customers = Customer::all(); 

        // Ambil semua produk untuk form transaksi
        $products = Product::all(); 

        // Kirimkan data produk dan pelanggan ke view
        return view('sales.create', compact('customers', 'products'));
    }

    /**
     * Menyimpan transaksi penjualan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'menu_id' => 'required|array',
            'menu_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card,digital',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        // Mulai transaksi untuk memastikan konsistensi data
        DB::beginTransaction();
        try {
            // Hitung total harga
            $total_price = 0;
            foreach ($request->menu_id as $index => $menuId) {
                $product = Product::findOrFail($menuId);
                $total_price += $product->price * $request->quantity[$index];
            }

            // Simpan transaksi penjualan
            $sale = Sale::create([
                'user_id' => $request->user_id,
                'customer_id' => $request->customer_id,
                'tanggal' => now(),
                'total_price' => $total_price,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->paid_amount - $total_price,
                'payment_method' => $request->payment_method,
            ]);

            // Simpan detail produk yang dijual
            foreach ($request->menu_id as $index => $menuId) {
                $product = Product::findOrFail($menuId);
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $menuId,
                    'quantity' => $request->quantity[$index],
                    'price' => $product->price,
                ]);
            }

            // Commit transaksi jika tidak ada error
            DB::commit();

            // Redirect ke halaman receipt dengan pesan sukses
            return redirect()->route('sales.receipt', $sale->id)
                ->with('success', 'Penjualan berhasil disimpan.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman receipt/struk penjualan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function receipt($id)
    {
        // Mengambil data transaksi penjualan beserta detailnya
        $sale = Sale::with('saleDetails.product')->findOrFail($id);

        // Mengirim data penjualan ke view
        return view('sales.receipt', compact('sale'));
    }
}
