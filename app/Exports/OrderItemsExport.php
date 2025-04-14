<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderItemsExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data item pesanan untuk diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data item pesanan dan map ke format yang diinginkan
        return OrderItem::all()->map(function ($orderItem) {
            return [
                'order_id' => $orderItem->order->id, // ID pesanan
                'menu_name' => $orderItem->menu->name, // Nama menu
                'quantity' => $orderItem->quantity, // Jumlah item
                'subtotal' => $orderItem->subtotal, // Subtotal
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
            'Menu Name', // Heading untuk kolom nama menu
            'Quantity',  // Heading untuk kolom jumlah
            'Subtotal',  // Heading untuk kolom subtotal
            // Tambahkan headings lain sesuai kolom yang ada
        ];
    }
}
