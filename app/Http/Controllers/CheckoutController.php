<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\{Product, CartItem, User, Order, OrderItem, Address, Payment};
use Exception;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Step 1: Validate the request
            try {
                $data = $this->validateRequest($request);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return back()->withErrors($e->validator)->withInput();
            }

            // Step 2: Fetch cart items
            $sessionId = session()->getId();
            $cartItems = $this->fetchCartItems($sessionId);
            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            // Step 3: Calculate subtotal and total
            $cartItemsWithPrices = $this->calculateSubtotal($cartItems);
            $subtotal = $cartItemsWithPrices[0]["total_price"];

            // Step 4: Create order
            $cartItemsJson = $cartItems->map(function ($cartItem) {
                return [
                    'cart_item_id' => $cartItem->id,
                    'product_id' => $cartItem->product->id,
                    'product_name' => $cartItem->product->title,
                    'quantity' => $cartItem->quantity,
                    'price_per_item' => $cartItem->product->price,
                    'total_price' => $cartItem->quantity * $cartItem->product->price,
                    'variants' => $cartItem->variants->map(function ($variant) {
                        return [
                            'id' => $variant->variant->id,
                            'type' => ucfirst($variant->variant->variation_type),
                            'value' => $variant->variant->variation_value,
                            'price' => $variant->variant->variation_price,
                        ];
                    })->toArray(),
                ];
            })->toArray();

            $order = $this->createOrder($request->notes, $cartItemsJson, $sessionId, $subtotal);

            // Step 5: Save order items
            $this->saveOrderItems($data, $cartItemsWithPrices, $order->id);

            // Step 6: Save billing address
            $this->saveAddress($data, $order->id, 'billing');

            // Step 7: Save payment details
            $this->savePaymentDetails($data, $order->id, $subtotal);

            // Step 8: Clear cart
            $this->clearCart($sessionId);

            DB::commit();

            return redirect()->route('order.success', ['orderId' => $order->id])
                ->with('message', 'Your order has been placed successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            // Log::error('Order Processing Failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while processing your order. Please try again.' . $e->getMessage())->withInput();
        }
    }

    private function validateRequest(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address_line1' => 'required|string|max:255',
                'address_line2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'phone' => ['required', 'regex:/^((\+92)|(0092)|0)?3[0-9]{9}$/'],
                'email' => 'required|email|max:255',
                'account_create' => 'nullable|boolean',
                'password' => 'nullable|required_if:account_create,1|min:8|confirmed',
                'notes' => 'nullable|string|max:1000',
                'payment' => 'required|in:cod',
                'postal_code' => 'required|string|max:10',
            ];

            $messages = [
                'phone.regex' => 'The phone number must be a valid Pakistani number.',
                'password.required_if' => 'Password is required when creating an account.',
                'password.confirmed' => 'Password confirmation does not match.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }

            return $validator->validated();
        } catch (Exception $e) {
            // Log::error('Validation Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function fetchCartItems($sessionId)
    {
        try {
            return CartItem::with(['product', 'variants.variant'])
                ->where('session_id', $sessionId)
                ->get();
        } catch (Exception $e) {
            // Log::error('Fetching Cart Items Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function calculateSubtotal($cartItems)
    {
        try {
            return $cartItems->map(function ($item) {
                $basePrice = $item->variants->isEmpty() ? $item->product->price : 0;
                $discountPercentage = $item->product->discount ?? 0;
                $variantPrice = $item->variants->sum(function ($variant) {
                    return $variant->variant->variation_price ?? 0;
                });
                $finalPrice = $variantPrice > 0 ? $variantPrice : $basePrice;

                if ($discountPercentage > 0) {
                    $finalPrice *= (1 - $discountPercentage / 100);
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
        } catch (Exception $e) {
            // Log::error('Calculating Subtotal Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function createOrder($notes, $cartItemsJson, $sessionId, $subtotal)
    {
        try {
            return Order::create([
                'user_id' => optional(auth()->user())->id,
                'session_id' => $sessionId,
                'order_number' => uniqid('PMD_ORD_'),
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'status' => 'pending',
                'items' => json_encode($cartItemsJson),
                'notes' => $notes,
            ]);
        } catch (Exception $e) {
            // Log::error('Order Creation Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function saveOrderItems($data, $cartItems, $orderId)
    {
        try {
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $orderId,
                    'cart_item_id' => $cartItem['id'],
                    'product_id' => $cartItem['product_id'],
                    'product_name' => $cartItem['product_name'],
                    'quantity' => $cartItem['quantity'],
                    'price_per_item' => $cartItem['price_per_item'],
                    'total_price' => $cartItem['total_price'],
                    'variants' => json_encode($cartItem['variants']->toArray()),
                ]);
            }
        } catch (Exception $e) {
            // Log::error('Saving Order Items Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function saveAddress($data, $orderId, $type)
    {
        try {
            Address::create([
                'order_id' => $orderId,
                'type' => $type,
                'address_line1' => $data['address_line1'],
                'address_line2' => $data['address_line2'] ?? null,
                'city' => $data['city'],
                'country' => 'Pakistan',
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'postal_code' => $data['postal_code'],
            ]);
        } catch (Exception $e) {
            // Log::error('Saving Address Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function savePaymentDetails($data, $orderId, $subtotal)
    {
        try {
            Payment::create([
                'order_id' => $orderId,
                'payment_method' => $data['payment'],
                'amount' => $subtotal,
                'status' => 'pending',
            ]);
        } catch (Exception $e) {
            // Log::error('Saving Payment Details Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function clearCart($sessionId)
    {
        try {
            CartItem::where('session_id', $sessionId)->delete();
        } catch (Exception $e) {
            // Log::error('Clearing Cart Failed: ' . $e->getMessage());
            throw $e;
        }
    }
    public function orderSuccess($orderId)
    {
        $order = Order::with('orderItems.product')
            ->where('id', $orderId)
            ->firstOrFail();

        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Order not found.');
        }
        return view('checkout.success', compact('order'));
    }
}
