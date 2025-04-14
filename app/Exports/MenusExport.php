<?php

namespace App\Exports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MenuExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data yang akan diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Menu::with('category')->get()->map(function ($menu) {
            return [
                'name' => $menu->name,
                'price' => $menu->price,
                'category' => $menu->category->name, // Mengambil nama kategori
            ];
        });
    }

    /**
     * Menentukan heading kolom untuk file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Menu Name',
            'Price',
            'Category',
        ];
    }
}
