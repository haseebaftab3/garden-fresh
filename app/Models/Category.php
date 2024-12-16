<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'image', 'slug', 'description', 'status'];
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function getParentCategories($limit = null)
    {
        $query = self::where('parent_id', null)
            ->where('status', 'Active');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public static function getCategoryTree()
    {
        $categories = self::all()->groupBy('parent_id');
        return self::buildTree($categories, null);
    }
    private static function buildTree($categories, $parentId)
    {
        $branch = [];

        if (isset($categories[$parentId])) {
            foreach ($categories[$parentId] as $category) {
                $children = self::buildTree($categories, $category->id);
                if ($children) {
                    $category->children = $children;
                }
                $branch[] = $category;
            }
        }

        return $branch;
    }
    public static function getCategoryTreeWithChildren()
    {
        $categories = self::all()->groupBy('parent_id');
        return self::buildTreeWithChildren($categories, null);
    }

    /**
     * This function fetches a limited number of main categories (4)
     * and groups the remaining categories under an 'Other' category.
     */
    public static function getLimitedCategories($limit = 4)
    {
        // Fetch only active categories
        $allCategories = self::where('status', 'Active')->get()->groupBy('parent_id');

        // Build the full category tree
        $fullTree = self::buildTreeWithChildren($allCategories, null);

        // Slice the first $limit categories and separate the remaining ones
        $mainCategories = array_slice($fullTree, 0, $limit);
        $otherCategories = array_slice($fullTree, $limit);

        // If there are more categories, group them under an 'Other' category
        if (count($otherCategories) > 0) {
            $other = (object)[
                'name' => 'Other',
                'slug' => 'other',
                'children' => $otherCategories,
            ];
            $mainCategories[] = $other; // Add 'Other' to main categories
        }

        return $mainCategories;
    }

    /**
     * Builds the category tree, ensuring empty child arrays if no children exist.
     */
    private static function buildTreeWithChildren($categories, $parentId)
    {
        $branch = [];

        if (isset($categories[$parentId])) {
            foreach ($categories[$parentId] as $category) {
                // Fetch children recursively
                $children = self::buildTreeWithChildren($categories, $category->id);

                // Set children or an empty array if no children exist
                $category->children = $children ?: [];

                // Add category to branch
                $branch[] = $category;
            }
        }

        return $branch;
    }
}
