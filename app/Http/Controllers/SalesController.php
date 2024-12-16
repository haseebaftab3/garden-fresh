<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all sales from the database
        $sales = Sale::all();
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();

        // Show the form to create a new sale
        return view('admin.sales.create', compact('categories', 'products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'applicable_to' => 'required|string|in:sitewide,category,product',
            'usage_limit' => 'nullable|integer|min:1',
            'is_visible' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        // Create a new sale in the database
        Sale::create($request->all());

        // Redirect to the sales index page with a success message
        return redirect()->route('admin.sales.index')->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the sale by ID and show its details
        $sale = Sale::findOrFail($id);
        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the sale by ID and show the form to edit it
        $sale = Sale::findOrFail($id);
        return view('admin.sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'applicable_to' => 'required|string|in:sitewide,category,product',
            'usage_limit' => 'nullable|integer|min:1',
            'is_visible' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        // Find the sale by ID and update its details
        $sale = Sale::findOrFail($id);
        $sale->update($request->all());

        // Redirect to the sales index page with a success message
        return redirect()->route('admin.sales.index')->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the sale by ID and delete it
        $sale = Sale::findOrFail($id);
        $sale->delete();

        // Redirect to the sales index page with a success message
        return redirect()->route('admin.sales.index')->with('success', 'Sale deleted successfully.');
    }
}
