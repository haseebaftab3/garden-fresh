<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class ShopController extends Controller
{

    public function index(Request $request)
    {
        // Fetch parent categories for the filter
        $parentCategories = Category::getParentCategories();

        // Determine the price range
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        $query = Product::where('status', 'published');

        // Filter by category (including its children)
        if ($request->has('category') && $request->category) {
            $categorySlug = $request->category;

            // Find the selected category by slug
            $selectedCategory = Category::where('slug', $categorySlug)->first();

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
        return view('shop', compact('products', 'parentCategories', 'minPrice', 'maxPrice'));
    }



    public function quickView($id)
    {
        $product = Product::with(['gallery', 'variations', 'stock'])->findOrFail($id);

        $colorVariants = $product->variations
            ->where('variation_type', 'color')
            ->pluck('variation_value');
        $sizeVariants = $product->variations
            ->where('variation_type', 'size')
            ->pluck('variation_value');


        return response()->json([
            'title' => $product->title,
            'price' => $product->price,
            'oldPrice' => $product->discount ? $product->price + $product->discount : null,
            'description' => $product->description,
            'cover_image' => Storage::url($product->cover_image),
            'images' => $product->gallery->pluck('image_url')->map(function ($image) {
                return Storage::url($image);
            }),
            'stock' => $product->stock ? 'In stock' : 'Out of stock',
            'badge' => $product->status,
            'colorVariants' => $colorVariants,
            'sizeVariants' => $sizeVariants,
        ]);
    }
}
