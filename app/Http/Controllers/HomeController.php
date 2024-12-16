<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories_section = Category::getParentCategories(6);
        return view("home", compact('categories_section'));
    }
}
