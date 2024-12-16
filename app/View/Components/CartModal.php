<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\CartItem;

class CartModal extends Component
{
    public $cartItems;
    public $subtotal;

    public function __construct()
    {
        $this->cartItems = CartItem::with('product')->where('session_id', session()->getId())->get();
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function render()
    {
        return view('components.cart-modal');
    }
}
