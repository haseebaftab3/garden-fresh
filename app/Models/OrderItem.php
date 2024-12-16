<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'cart_item_id',
        'product_id',
        'product_name',
        'quantity',
        'price_per_item',
        'total_price',
        'variants',
    ];

    protected $casts = [
        'variants' => 'array',
    ];

    // Relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    // Relationship with CartItem (optional)
    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }
}
