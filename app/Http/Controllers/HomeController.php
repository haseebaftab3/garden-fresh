<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    { // Fetch parent categories for the filter
        $parentCategories = Category::getParentCategories();

        // Determine the price range
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        $query = Product::where('status', 'published');


        // Paginate results
        $products = $query->paginate(16);


        $categories_section = Category::getParentCategories(6);
        return view("home", compact('categories_section', 'products', 'parentCategories', 'minPrice', 'maxPrice'));
    }
}
