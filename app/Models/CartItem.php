<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'product_id', 'variant_id', 'quantity'];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with ProductVariation
    public function variants()
    {
        return $this->hasMany(CartItemVariant::class, 'cart_item_id');
    }
}
