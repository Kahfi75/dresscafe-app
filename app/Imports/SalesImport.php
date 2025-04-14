<?php

namespace App\Imports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesImport implements ToModel
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Sale([
            'product_id' => $row[0],
            'quantity'   => $row[1],
            'total_price'=> $row[2],
            'sale_date'  => $row[3],
        ]);
    }
}
