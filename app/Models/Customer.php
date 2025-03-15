<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    public $timestamps = true; // Menggunakan timestamps

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    // Relasi dengan Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
