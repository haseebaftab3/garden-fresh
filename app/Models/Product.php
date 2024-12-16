<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use CyrildeWit\EloquentViewable\InteractsWithViews;

class Product extends Model implements ViewableContract
{
    use HasFactory, InteractsWithViews;
    protected $fillable = ['slug', 'title', 'category_id', 'description', 'cover_image', 'status', 'publish_date', 'visibility', 'price', 'discount', 'return_policy', 'return_period', 'orders', 'sku', 'weight', 'manufacturer_name', 'manufacturer_brand'];

    // A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    // A product has one stock entry
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    // A product can have many tags
    public function tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    // A product can have many gallery images
    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }

    // A product can have one meta data entry
    public function metaData()
    {
        return $this->hasOne(ProductMetaData::class);
    }

    // A product can have many variations
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
