<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductMetaData;
use App\Models\ProductTag;
use App\Models\ProductVariation;
use App\Models\Stock;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProducts = Product::all();
        $scheduledCount  = Product::where('status', 'published')->count();
        $publishedCount  = Product::where('status', 'published')->count();
        $draftCount  = Product::where('status', 'published')->count();
        return view('admin.products.index', compact('allProducts', 'publishedCount', 'scheduledCount', 'draftCount'));
    }

    public function filterByStatus($status)
    {
        $products = Product::where('status', $status)->get();
        return view('admin.products.partials.products-table', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view("admin.products.create", compact('categories'));
    }

    public function LoadSubCategories($parentId)
    {
        $categories = Category::where('parent_id', $parentId)->get();
        return response()->json($categories);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string|max:5000',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // General Info Validation
            'manufacturer_name' => 'required|string|max:255',
            'manufacturer_brand' => 'nullable|string|max:255',
            'stocks' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'orders' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'weight' => 'nullable|numeric|min:0',
            'return_policy' => 'required|boolean',
            'return_period' => 'nullable|integer|min:0|required_if:return_policy,1',

            // Meta Data Validation
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'variations' => 'nullable|array|min:1',
            'variations.*.variation_type' => 'nullable|string|max:255',
            'variations.*.variation_value' => 'nullable|string|max:255',
            'variations.*.extra_price' => 'nullable|numeric|min:0',
            'variations.*.stock' => 'nullable|numeric|min:0',

            'publish_status' => 'required|string|in:Published,Scheduled,Draft',
            'visibility' => 'required|string|in:Public,Hidden',
            'publish_date' => 'nullable|date|after_or_equal:today|required_if:publish_status,Scheduled',

            'parent_category' => 'nullable|exists:categories,id',
            'child_category' => 'nullable|exists:categories,id|required_if:parent_category,*',
            'tags' => 'nullable|string',

        ],);



        if ($request->hasFile('product_image')) {
            $coverImage = $request->file('product_image')->store('products', 'public');
        }

        $product = Product::create([
            'title' => $validatedData['product_title'],
            'slug' => Str::slug($validatedData['product_title']),
            'description' => $validatedData['product_description'],
            'manufacturer_name' => $validatedData['manufacturer_name'],
            'manufacturer_brand' => $validatedData['manufacturer_brand'],
            'cover_image' => $coverImage,
            'price' => $validatedData['price'],
            'discount' => $validatedData['discount'] ?? 0.00,
            $validatedData['sku'] = $validatedData['sku'] ?? 'GRDF-' . strtoupper(bin2hex(random_bytes(4))),
            'weight' => $validatedData['weight'] ?? null,
            'return_policy' => $validatedData['return_policy'],
            'return_period' => $validatedData['return_period'] ?? null,
            'status' => $validatedData['publish_status'],
            'visibility' => $validatedData['visibility'],
            'publish_date' => $validatedData['publish_date'] ?? null,
            'category_id' => $validatedData['child_category'] ?? $validatedData['parent_category'] ?? null,
        ]);

        Stock::create([
            'product_id' => $product->id,
            'quantity' => $validatedData['stocks'],
        ]);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $imageUrl = $image->store('product_gallery', 'public');
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image_url' => $imageUrl,
                ]);
            }
        }

        // Save product meta data
        if (!empty($validatedData['meta_title']) || !empty($validatedData['meta_keywords']) || !empty($validatedData['meta_description'])) {
            ProductMetaData::create([
                'product_id' => $product->id,
                'meta_title' => $validatedData['meta_title'] ?? null,
                'meta_keywords' => $validatedData['meta_keywords'] ?? null,
                'meta_description' => $validatedData['meta_description'] ?? null,
            ]);
        }

        if (!empty($validatedData['variations'])) {
            foreach ($validatedData['variations'] as $variation) {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'variation_type' => $variation['variation_type'],
                    'variation_value' => $variation['variation_value'],
                    'variation_price' => $variation['extra_price'] ?? 0.00,
                    'variation_stock' => $variation['stock'],
                ]);
            }
        }

        if (!empty($validatedData['tags'])) {
            // Decode the JSON string to an array
            $tagsArray = json_decode($validatedData['tags'], true);

            if (is_array($tagsArray)) {
                foreach ($tagsArray as $tagData) {
                    // Assuming each tagData contains a 'value' key for the tag name
                    $tagName = isset($tagData['value']) ? trim($tagData['value']) : '';

                    if (!empty($tagName)) {
                        ProductTag::create([
                            'product_id' => $product->id,
                            'tag' => $tagName,
                        ]);
                    }
                }
            }
        }

        if ($request->input("submit-btn")) {
            return redirect()->route("admin.products.index")->with('success', 'Product created successfully.');
        } else if ($request->input("submit-add-more-btn")) {
            return redirect()->back()->with('success', 'Product created successfully.');
        } else {
            return redirect()->back()->with('success', 'Product created successfully.');
        }
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with(['gallery', 'metaData', 'variations', 'tags', 'stock'])
                ->findOrFail($id);

            return view('admin.products.show', compact('product'));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')->with('error', 'Failed to load product data.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the product by ID
        $product = Product::with('gallery', 'variations', 'tags')->findOrFail($id);
        $tags = $product->tags->map(function ($tag) {
            return ['value' => $tag->tag];
        });

        // Optionally, retrieve any related data, like categories, if you need them for a dropdown
        $categories = Category::all();

        // Return the edit view, passing the product and other necessary data
        return view('admin.products.edit', compact('product', 'categories', 'tags'));
    }

    public function deleteImage($id)
    {
        // Find the image by ID
        $image = ProductGallery::findOrFail($id);

        // Delete the image file from storage
        Storage::delete('public/' . $image->image_url);

        // Delete the image record from the database
        $image->delete();

        // Return a JSON response
        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string|max:5000',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Max 2MB
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Max 2MB per image
            // General Info Validation
            'manufacturer_name' => 'required|string|max:255',
            'manufacturer_brand' => 'nullable|string|max:255',
            'stocks' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'orders' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $product->id,
            'weight' => 'nullable|numeric|min:0',
            'return_policy' => 'required|boolean',
            'return_period' => 'nullable|integer|min:0|required_if:return_policy,1',

            // Meta Data Validation
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'variations' => 'nullable|array|min:1',
            'variations.*.variation_type' => 'nullable|string|max:255',
            'variations.*.variation_value' => 'nullable|string|max:255',
            'variations.*.extra_price' => 'nullable|numeric|min:0',
            'variations.*.stock' => 'nullable|numeric|min:0',

            'publish_status' => 'required|string|in:Published,Scheduled,Draft',
            'visibility' => 'required|string|in:Public,Hidden',
            'publish_date' => 'nullable|date|after_or_equal:today|required_if:publish_status,Scheduled',

            'parent_category' => 'nullable|exists:categories,id',
            'child_category' => 'nullable|exists:categories,id|required_if:parent_category,*',
            'tags' => 'nullable|string',
        ]);

        if ($request->hasFile('product_image')) {
            // Delete the old image if exists
            if ($product->cover_image) {
                Storage::disk('public')->delete($product->cover_image);
            }
            $coverImage = $request->file('product_image')->store('products', 'public');
        } else {
            $coverImage = $product->cover_image;
        }
        if (empty($validatedData['sku'])) {
            if (empty($product->sku)) {
                $sku = $validatedData['sku'] = 'GRDF-' . strtoupper(bin2hex(random_bytes(4)));
            } else {
                $sku = $product->sku;
            }
        } else {
            $sku = $validatedData['sku'];
        }
        $product->update([
            'title' => $validatedData['product_title'],
            'slug' => Str::slug($validatedData['product_title']),
            'description' => $validatedData['product_description'],
            'cover_image' => $coverImage,
            'manufacturer_name' => $validatedData['manufacturer_name'],
            'manufacturer_brand' => $validatedData['manufacturer_brand'],
            'price' => $validatedData['price'],
            'discount' => $validatedData['discount'] ?? 0.00,
            'sku' => $sku,
            'weight' => $validatedData['weight'] ?? $product->weight,
            'return_policy' => $validatedData['return_policy'],
            'return_period' => $validatedData['return_period'] ?? $product->return_period,
            'status' => $validatedData['publish_status'],
            'visibility' => $validatedData['visibility'],
            'publish_date' => $validatedData['publish_date'] ?? $product->publish_date,
            'category_id' => $validatedData['child_category'] ?? $validatedData['parent_category'] ?? $product->category_id,
        ]);

        $product->stock->update([
            'quantity' => $validatedData['stocks'],
        ]);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $imageUrl = $image->store('product_gallery', 'public');
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image_url' => $imageUrl,
                ]);
            }
        }

        // Save product meta data
        $metaData = $product->metaData;
        if ($metaData) {
            $metaData->update([
                'meta_title' => $validatedData['meta_title'] ?? $metaData->meta_title,
                'meta_keywords' => $validatedData['meta_keywords'] ?? $metaData->meta_keywords,
                'meta_description' => $validatedData['meta_description'] ?? $metaData->meta_description,
            ]);
        } else if (!empty($validatedData['meta_title']) || !empty($validatedData['meta_keywords']) || !empty($validatedData['meta_description'])) {
            ProductMetaData::create([
                'product_id' => $product->id,
                'meta_title' => $validatedData['meta_title'] ?? null,
                'meta_keywords' => $validatedData['meta_keywords'] ?? null,
                'meta_description' => $validatedData['meta_description'] ?? null,
            ]);
        }

        // Update or create variations
        if (!empty($validatedData['variations'])) {
            $product->variations()->delete(); // Deleting existing variations to update them
            foreach ($validatedData['variations'] as $variation) {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'variation_type' => $variation['variation_type'],
                    'variation_value' => $variation['variation_value'],
                    'variation_price' => $variation['extra_price'] ?? 0.00,
                    'variation_stock' => $variation['stock'],
                ]);
            }
        }

        if (!empty($validatedData['tags'])) {
            // Remove existing tags
            $product->tags()->delete();

            // Decode the JSON string to an array
            $tagsArray = json_decode($validatedData['tags'], true);

            if (is_array($tagsArray)) {
                foreach ($tagsArray as $tagData) {
                    $tagName = isset($tagData['value']) ? trim($tagData['value']) : '';

                    if (!empty($tagName)) {
                        ProductTag::create([
                            'product_id' => $product->id,
                            'tag' => $tagName,
                        ]);
                    }
                }
            }
        }

        return redirect()->route("admin.products.index")->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the product by ID
            $product = Product::findOrFail($id);

            // Delete the associated cover image from storage
            if ($product->cover_image) {
                Storage::disk('public')->delete($product->cover_image);
            }

            // Delete associated gallery images
            foreach ($product->gallery as $galleryImage) {
                Storage::disk('public')->delete($galleryImage->image_url);
                $galleryImage->delete(); // Delete gallery record
            }

            // Delete associated metadata
            if ($product->metaData) {
                $product->metaData->delete();
            }

            // Delete associated variations
            $product->variations()->delete();

            // Delete associated tags
            $product->tags()->delete();

            // Delete the stock record
            if ($product->stock) {
                $product->stock->delete();
            }

            // Finally, delete the product record
            $product->delete();

            // Return JSON response indicating success
            return response()->json(['success' => true, 'message' => 'Product deleted successfully.'], 200);
        } catch (\Exception $e) {
            // Return JSON response indicating failure
            return response()->json(['success' => false, 'message' => 'Failed to delete product.'], 500);
        }
    }
}
