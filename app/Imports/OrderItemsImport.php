<?php

namespace App\Imports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderItemsImport implements ToModel
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new OrderItem([
            'order_id'  => $row[0],
            'menu_id'   => $row[1],
            'quantity'  => $row[2],
            'subtotal'  => $row[3],
        ]);
    }
}
