<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $table = "product_gallery";

    protected $fillable = ['product_id', 'image_url'];

    /**
     * A gallery image belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
