<?php

namespace App\Exports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MenuExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil data menu dengan kategori
        return Menu::with('category')->get(['id', 'name', 'price', 'category_id']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Menu Name',
            'Price',
            'Category Name',
        ];
    }
}
