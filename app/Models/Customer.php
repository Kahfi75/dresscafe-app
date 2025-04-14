<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'member_number',
        'is_member',
        'points'
    ];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi dengan Order (Pastikan ada model Order)
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id')->onDelete('cascade');
        return $this->hasMany(Order::class);
    }
}
