<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'customer_name', 'total_price', 'status'];

    protected $casts = [
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
