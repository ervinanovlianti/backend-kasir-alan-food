<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    // Definisikan relasi dengan model Menu

    protected $table = 'order_items';

    protected $fillable = ['order_id', 'menu_id', 'quantity'];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Definisikan relasi dengan model Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
