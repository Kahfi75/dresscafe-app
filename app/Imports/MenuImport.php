<?php

namespace App\Imports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Menu([
            'name' => $row['nama_menu'],
            'price' => $row['harga'],
            'category_id' => $row['id_kategori'],
        ]);
    }
}
