<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'customer_id',
        'customer_name',
        'customer_phone',
        'special_notes',
        'is_priority',
        'total_price',
        'status',
        'completed_at',
        'cancelled_at'
    ];

    protected $casts = [
        'is_priority' => 'boolean',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'table_number' => 'integer'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}