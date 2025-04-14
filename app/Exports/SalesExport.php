<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data penjualan untuk diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data penjualan dan map ke format yang diinginkan
        return Sale::all()->map(function ($sale) {
            return [
                'date' => $sale->tanggal,  // Tanggal penjualan
                'total_price' => $sale->total_price, // Total harga
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
            'Date',  // Heading untuk kolom tanggal
            'Total Price', // Heading untuk kolom total harga
            // Tambahkan headings lain sesuai kolom yang ada
        ];
    }
}
