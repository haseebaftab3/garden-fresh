<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'variation_type', 'variation_value', 'variation_price', 'variation_stock'];

    // A variation belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
