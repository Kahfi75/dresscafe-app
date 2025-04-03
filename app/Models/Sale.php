<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        'user_id',
        'tanggal',
        'total_price',
        'paid_amount',
        'change_amount',
    ];

    // Relasi ke tabel 'users'
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
