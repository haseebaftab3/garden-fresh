<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\CartItemVariant;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{




    public function cart(Request $request)
    {
        return view("cart.index");
    }


    public function addToCart(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_ids' => 'nullable|array',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the product
        $product = Product::findOrFail($request->product_id);

        // Initialize variables for variants and error tracking
        $variants = collect();
        $detailedErrors = [];

        if (!empty($request->variant_ids) && is_array($request->variant_ids)) {
            // Fetch the variants matching the provided IDs and product ID
            $variants = ProductVariation::where('product_id', $product->id)
                ->whereIn('id', $request->variant_ids)
                ->get();

            if ($variants->count() !== count($request->variant_ids)) {
                $detailedErrors[] = "One or more selected variants are invalid for this product.";
            }

            foreach ($variants as $variant) {
                $cartQuantity = CartItem::where('session_id', session()->getId())
                    ->where('product_id', $product->id)
                    ->whereHas('variants', function ($query) use ($variant) {
                        $query->where('variant_id', $variant->id);
                    })
                    ->sum('quantity');

                $availableStock = $variant->variation_stock ?? $product->stock->quantity;
                $remainingStock = $availableStock - $cartQuantity;

                if ($remainingStock < $request->quantity) {
                    $unit = $variant->variation_type === 'weight' ? 'KG' : '';
                    $detailedErrors[] = "The selected variant '{$variant->variation_type}: {$variant->variation_value}{$unit}' is not available in the requested quantity. Only {$remainingStock} left in stock.";
                }
            }
        } else {
            // For base product (no variants)
            $cartQuantity = CartItem::where('session_id', session()->getId())
                ->where('product_id', $product->id)
                ->sum('quantity');

            $remainingStock = $product->stock->quantity - $cartQuantity;

            if ($remainingStock < $request->quantity) {
                $detailedErrors[] = "The product '{$product->title}' is out of stock. Remaining stock: {$remainingStock}.";
            }
        }

        if ($detailedErrors) {

            $formattedErrors = "<ul>";
            foreach ($detailedErrors as $error) {
                $formattedErrors .= "<li>{$error}</li>";
            }
            $formattedErrors .= "</ul>";

            return response()->json([
                'success' => false,
                'message' => "We encountered the following issues while adding the item to your cart:",
                'details' => $formattedErrors,
            ], 422);
        }


        // Check if the combination of product and variants already exists in the cart
        $existingCartItem = CartItem::where('session_id', session()->getId())
            ->where('product_id', $product->id)
            ->whereDoesntHave('variants', function ($query) use ($request) {
                $query->whereNotIn('variant_id', $request->variant_ids ?? []);
            })
            ->first();

        if ($existingCartItem) {
            // Update the quantity of the existing cart item
            $existingCartItem->increment('quantity', $request->quantity);
        } else {
            // Create a new cart item
            $cartItem = CartItem::create([
                'session_id' => session()->getId(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);

            // Add variants to the new cart item
            if (!empty($request->variant_ids)) {
                foreach ($request->variant_ids as $variantId) {
                    CartItemVariant::create([
                        'cart_item_id' => $cartItem->id,
                        'variant_id' => $variantId,
                    ]);
                }
            }
        }

        // Calculate updated cart count and subtotal
        $cartCount = CartItem::where('session_id', session()->getId())->count();
        $subtotal = CartItem::where('session_id', session()->getId())
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

        // Prepare variant details for the response
        $variantDetails = $variants->map(function ($variant) {
            $unit = $variant->variation_type === 'weight' ? 'KG' : '';
            return [
                'id' => $variant->id,
                'type' => ucfirst($variant->variation_type),
                'value' => "{$variant->variation_value}{$unit}",
                'stock' => $variant->variation_stock,
                'price' => $variant->variation_price,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => "The product '{$product->title}' (quantity: {$request->quantity}) has been successfully added to your cart.",
            'product' => [
                'id' => $product->id,
                'name' => $product->title,
                'stock' => $product->stock->quantity,
                'price' => $product->price,
            ],
            'variants' => $variantDetails,
            'cartCount' => $cartCount,
            'subtotal' => $subtotal,
        ]);
    }












    public function getCartItems()
    {
        $sessionId = session()->getId();

        $cartItems = CartItem::with(['product', 'variants.variant'])
            ->where('session_id', $sessionId)
            ->get();

        // Calculate subtotal and prepare items with calculated price
        $cartItemsWithPrices = $cartItems->map(function ($item) {
            $basePrice = 0;

            // If no variants are selected, use the product's base price
            $basePrice = $item->product->price;

            $productPrice = $item->product->price;
            $discountPercentage = $item->product->discount ?? 0;

            // Calculate total variant price
            $variantPrice = $item->variants->sum(function ($variant) {
                return $variant->variant->variation_price ?? 0;
            });


            $finalPrice = $variantPrice > 0 ? $variantPrice + $productPrice : $basePrice;

            // Apply discount if applicable
            if ($discountPercentage > 0) {
                $finalPrice = $finalPrice * (1 - $discountPercentage / 100);
            }

            return [
                'id' => $item->id,
                'product_id' => $item->product->id,
                'product_name' => $item->product->title,
                'slug' => $item->product->slug,
                'product_image' => $item->product->cover_image,
                'quantity' => $item->quantity,
                'price_per_item' => $finalPrice,
                'total_price' => $finalPrice * $item->quantity,
                'variants' => $item->variants->map(function ($variant) {
                    return [
                        'id' => $variant->variant->id,
                        'type' => ucfirst($variant->variant->variation_type),
                        'value' => $variant->variant->variation_value,
                        'price' => $variant->variant->variation_price,
                    ];
                }),
            ];
        });

        // Calculate subtotal
        $subtotal = $cartItemsWithPrices->sum('total_price');

        // Return cart data
        return response()->json([
            'success' => true,
            'cartItems' => $cartItemsWithPrices,
            'subtotal' => $subtotal,
        ]);
    }



    // Remove from cart
    public function removeFromCart($id)
    {
        CartItem::where('id', $id)->delete();

        return response()->json(['success' => true, 'message' => 'Item removed from cart!']);
    }

    public function updateQuantity(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::with(['product', 'variants.variant'])->find($validated['cart_id']);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $product = $cartItem->product;
        $requestedQuantity = $validated['quantity'];
        $detailedErrors = [];

        if ($cartItem->variants->isNotEmpty()) {
            // Handle variants
            foreach ($cartItem->variants as $cartVariant) {
                $variant = $cartVariant->variant;

                $cartQuantity = CartItem::where('session_id', session()->getId())
                    ->where('product_id', $product->id)
                    ->whereHas('variants', function ($query) use ($variant) {
                        $query->where('variant_id', $variant->id);
                    })
                    ->sum('quantity');

                $availableStock = $variant->variation_stock ?? $product->stock->quantity;
                $remainingStock = $availableStock - ($cartQuantity - $cartItem->quantity); // Exclude current cart item's quantity

                if ($remainingStock < $requestedQuantity) {
                    $unit = $variant->variation_type === 'weight' ? 'KG' : '';
                    $detailedErrors[] = "The variant '{$variant->variation_type} - {$variant->variation_value}{$unit}' is out of stock. Remaining stock: {$remainingStock}{$unit}.";
                }
            }
        } else {
            // Handle base product (no variants)
            $cartQuantity = CartItem::where('session_id', session()->getId())
                ->where('product_id', $product->id)
                ->sum('quantity');

            $remainingStock = $product->stock->quantity - ($cartQuantity - $cartItem->quantity); // Exclude current cart item's quantity

            if ($remainingStock < $requestedQuantity) {
                $detailedErrors[] = "The product '{$product->title}' is out of stock. Remaining stock: {$remainingStock}.";
            }
        }

        if ($detailedErrors) {
            return response()->json([
                'success' => false,
                'message' => "We encountered the following issues while updating the quantity:",
                'details' => $detailedErrors,
            ], 200);
        }

        // Update the cart item's quantity
        $cartItem->quantity = $requestedQuantity;
        $cartItem->save();

        // Recalculate subtotal
        $subtotal = CartItem::where('session_id', session()->getId())
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully',
            'subtotal' => $subtotal,
        ]);
    }



    public function deleteItem(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'required|exists:cart_items,id',
        ]);

        $cartItem = CartItem::find($validated['cart_id']);

        if ($cartItem) {
            $cartItem->delete();
            $cartCount = CartItem::where('session_id', session()->getId())->count();
            $subtotal = CartItem::where('session_id', session()->getId())
                ->with('product')
                ->get()
                ->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });

            return response()->json([
                'success' => true,
                'message' => 'Item removed successfully.',
                'cartCount' => $cartCount,
                'subtotal' => $subtotal,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to remove item.',
        ]);
    }
}
