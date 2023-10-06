<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['total', 'uang_pembeli', 'kembalian'];
    // Definisikan relasi dengan model OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
        
    }
}
