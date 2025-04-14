<?php

namespace App\Imports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\ToModel;

class MenusImport implements ToModel
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Menu([
            'name'        => $row[0],
            'description' => $row[1],
            'price'       => $row[2],
            'category_id' => $row[3], // assuming category_id is in the 4th column
        ]);
    }
}
