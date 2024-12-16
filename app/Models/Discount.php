<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'discount_type', 'value', 'maximum_discount', 'minimum_purchase', 'discount_code', 'usage_limit', 'used_count', 'status', 'start_date', 'end_date'];

    // Relationships
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_discount');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_discount');
    }
}
