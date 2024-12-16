<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // Correctly define the table name
    protected $table = "stock"; // Assuming your table name is `stock`

    protected $fillable = ['product_id', 'quantity'];

    // A stock entry belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
