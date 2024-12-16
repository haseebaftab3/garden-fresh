<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItemVariant extends Model
{
    use HasFactory;
    protected $table = 'cart_item_variants';
    protected $fillable = [
        'cart_item_id',
        'variant_id',
    ];

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }

    /**
     * Define the relationship with the ProductVariation model.
     */
    public function variant()
    {
        return $this->belongsTo(ProductVariation::class, 'variant_id');
    }
}
