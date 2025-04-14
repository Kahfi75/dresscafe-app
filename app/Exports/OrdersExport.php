<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data pesanan untuk diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data pesanan dan map ke format yang diinginkan
        return Order::all()->map(function ($order) {
            return [
                'order_id' => $order->id, // ID pesanan
                'customer_name' => $order->customer->name, // Nama pelanggan
                'total_price' => $order->total_price, // Total harga
                // Tambahkan kolom lain sesuai kebutuhan
            ];
        });
    }

    /**
     * Menentukan headings untuk file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Order ID',  // Heading untuk kolom ID pesanan
            'Customer Name', // Heading untuk kolom nama pelanggan
            'Total Price', // Heading untuk kolom total harga
            // Tambahkan headings lain sesuai kolom yang ada
        ];
    }
}
