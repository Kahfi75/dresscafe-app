<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'customer_id',
        'tanggal',
        'total_price',
        'paid_amount',
        'change_amount',
        'payment_method',
        'payment_status',
    ];

    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke tabel customers
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi ke detail penjualan (sale_details)
     */
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
