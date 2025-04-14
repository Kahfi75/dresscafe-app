<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data kategori untuk diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua kategori
        return Category::all()->map(function ($category) {
            return [
                'name' => $category->name, // Ambil nama kategori
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
            'Category Name', // Heading untuk kolom nama kategori
        ];
    }
}
