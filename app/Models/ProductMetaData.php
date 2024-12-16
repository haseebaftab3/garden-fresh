<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMetaData extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'meta_title', 'meta_keywords', 'meta_description'];

    // Meta data belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
