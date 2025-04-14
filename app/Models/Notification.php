<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Add order_id to the fillable property
    protected $fillable = [
        'order_id',
        'message',
        'is_read',
    ];

    // Optional: Define the relationship to the Order model if necessary
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
