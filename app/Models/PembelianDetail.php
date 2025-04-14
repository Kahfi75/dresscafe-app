<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    protected $table = 'pembelian_detail';

    protected $fillable = ['pembelian_id', 'menu_id', 'jumlah', 'harga_beli'];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
