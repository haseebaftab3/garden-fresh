<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AdInput;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function getChildCategories($parentId)
    {
        try {
            // Fetch child categories where parent_id matches
            $childCategories = Category::where('parent_id', $parentId)->get();

            // Return child categories as a JSON response
            return response()->json($childCategories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch child categories'], 500);
        }
    }

    public function getEditChildCategories($parentId)
    {
        try {
            // Fetch child categories where parent_id matches
            $childCategories = Category::where('parent_id', $parentId)->get();

            // Return child categories as a JSON response
            return response()->json($childCategories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch child categories'], 500);
        }
    }

    public function getParentCategories()
    {
        try {
            // Fetch categories where the parent_id is null (these are the top-level categories)
            $parentCategories = Category::whereNull('parent_id')->get();

            // Return the parent categories as a JSON response
            return response()->json($parentCategories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch parent categories'], 500);
        }
    }



    public function inputs()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.inputs', compact('categories'));
    }




    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',  // The parent category
            'child_id' => 'nullable|exists:categories,id',   // The child category
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
            'description' => 'nullable|string|max:500',
            'status' => ['required', 'in:Active,Inactive'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error_type', 'validation')
                ->with('error_message', 'There were validation errors. Please correct them and try again.');
        }

        try {
            // Handle image upload (if needed)
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->storeAs(
                    'categories',
                    time() . '_' . $request->file('image')->getClientOriginalName(),
                    'public'
                );
            }

            // Generate SEO-friendly slug
            $slug = $this->generateSeoFriendlySlug($request->name, $request->parent_id);

            // Determine which category ID to store (parent or child)
            $categoryParentId = $request->child_id ?? $request->parent_id;

            // Create and save the category
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $slug;
            $category->parent_id = $categoryParentId;  // Use the child category if selected, otherwise the parent
            $category->image = isset($imagePath) ? $imagePath : null;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->save();

            return redirect()->back()->with('success', 'Category added successfully.');
        } catch (\Exception $e) {
            // Log error details
            Log::error('Failed to add category', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return redirect()->back()
                ->with('insertion_error', 'An error occurred while trying to add the category. Please try again later.')
                ->with('error_type', 'insertion');
        }
    }



    public function show(Category $category)
    {
        $category->load('parent', 'children');
        return response()->json($category);
    }



    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.update', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        // Validate the request data for category update
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($category) {
                    if ($value && $value == $category->id) {
                        $fail('The parent category cannot be the same as the current category.');
                    }
                }
            ],
            'child_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($category) {
                    if ($value && $value == $category->id) {
                        $fail('The child category cannot be the same as the current category.');
                    }
                }
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
            'description' => 'nullable|string|max:500',
            'status' => ['required', 'in:Active,Inactive'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error_type', 'validation-edit')
                ->with('error_message', 'There were validation errors. Please correct them and try again.');
        }

        try {
            // Handle the image update if a new image is uploaded
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }

                // Store the new image
                $imagePath = $request->file('image')->store('categories', 'public');
                $category->image = $imagePath;
            }

            // Generate a unique slug only if the name has changed
            if ($category->name !== $request->name) {
                $slug = $this->generateSeoFriendlySlug($request->name, $request->parent_id, $category->id); // Passing $category->id to avoid slug conflict with itself
                $category->slug = $slug; // Update the slug
            }

            $categoryParentId = $request->child_id ?? $request->parent_id;
            // Update other category fields
            $category->name = $request->name;
            $category->parent_id = $categoryParentId;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->save();

            return redirect()->back()->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to update category', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'category_id' => $category->id,
                'request_data' => $request->all(),
            ]);

            // Return a user-friendly error message
            return redirect()->back()
                ->with('insertion_error', 'Failed to update the category. Please try again later.')
                ->with('error_type', 'insertion-edit');
        }
    }



    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the category.']);
        }
    }

    public function multiDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            try {
                // Delete the categories
                Category::whereIn('id', $ids)->delete();

                return response()->json(['success' => true, 'message' => 'Categories deleted successfully.']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'An error occurred while deleting the categories.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'No categories selected for deletion.']);
        }
    }


    /**
     * Generate an SEO-friendly unique slug for the category
     */
    private function generateSeoFriendlySlug($name, $parentId = null)
    {
        // Generate initial slug
        $slug = Str::slug($name);
        $originalSlug = $slug;

        // If there's a parent category, append the parent name to the slug for uniqueness
        if ($parentId) {
            $parentCategory = Category::find($parentId);
            if ($parentCategory) {
                $slug .= '-' . Str::slug($parentCategory->name);
            }
        }

        // Check if slug exists in the database
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            // If it exists, append a meaningful and unique suffix, e.g., current year, month, etc.
            $slug = $originalSlug . '-' . now()->format('Y-m-d') . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
