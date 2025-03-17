<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'total_price',
        'status',
        'menu_id', // Pastikan ada kolom menu_id dalam tabel orders
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
