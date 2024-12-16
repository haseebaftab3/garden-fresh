<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use CyrildeWit\EloquentViewable\Support\Period;


class MainProductController extends Controller
{
    public function show($slug)
    {
        // Fetch product by slug
        $product = Product::where('slug', $slug)->with([
            'category',
            'tags',
            'gallery',
            'metaData',
            'variations'
        ])->firstOrFail();
        views($product)->record();

        return view('product.detail', compact('product'));
    }
}
