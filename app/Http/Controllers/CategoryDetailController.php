<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryDetailController extends Controller
{


    public function show(Request $request, $slug)
    {
        // Fetch parent categories for the filter
        $parentCategories = Category::getParentCategories();

        // Determine the price range
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        $query = Product::where('status', 'published');

        // Filter by category (including its children)
        if ($slug && !empty($slug)) {
            if ($request->get('category') && !empty($request->get('category'))) {
                $categorySlug = $request->get('category');
            } else {
                $categorySlug = $slug;
            }


            // Find the selected category by slug
            $selectedCategory = Category::where('slug', $categorySlug)->first();


            $childCategories = [];
            if ($selectedCategory) {
                $childCategories = Category::where('parent_id', $selectedCategory->id)->get();
            }

            if ($selectedCategory && $selectedCategory->id) {
                // Fetch child categories and include parent
                $categoryIds = Category::where('parent_id', $selectedCategory->id)->pluck('id')->toArray();
                $categoryIds[] = $selectedCategory->id;

                // Apply filter
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Filter by price range
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }



        $selectedSort = $request->get('sort_by', 'latest');
        switch ($selectedSort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;

            case 'latest': // Sort by latest (newest first)
                $query->orderBy('created_at', 'desc');
                break;

            case 'new_to_old': // Same as latest
                $query->orderBy('created_at', 'desc');
                break;

            case 'old_to_new': // Sort by oldest first
                $query->orderBy('created_at', 'asc');
                break;

            default:
                $query->orderBy('created_at', 'desc');
                break;
        }


        // Paginate results
        $products = $query->paginate(16);

        // Handle AJAX requests for load more
        if ($request->ajax()) {
            // dd($query->toSql(), $query->getBindings());
            $productHtml = view('partials.product-list', compact('products'))->render();

            return response()->json([
                'productHtml' => $productHtml,
                'currentPage' => $products->currentPage(),
                'lastPage' => $products->lastPage(),
                'hasMorePages' => $products->hasMorePages(),
            ]);
        }

        // Render main view
        return view('categories.index', compact('products', 'parentCategories', 'minPrice', 'maxPrice', 'childCategories'));
    }
}
