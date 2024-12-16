<div class="cart-dropdown" id="cart-dropdown">
    <div class="cart-content-wrap">
        <div class="cart-header">
            <h2 class="header-title">Cart Review</h2>
            <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-body">
            <div id="cart-loader" class="cart-loader text-center py-4">
                <div class="fas fa-spinner fa-spin text-primary"></div>
                <p>Loading cart items...</p>
            </div>
            <ul class="cart-item-list" id="cart-item-list" style="display: none;"></ul>
        </div>
        <div class="cart-footer">
            <h3 class="cart-subtotal">
                <span class="subtotal-title">Subtotal:</span>
                <span class="subtotal-amount" id="cart-subtotal">Rs.0.00</span>
            </h3>
            <div class="group-btn">
                <a href="{{ route('cart.index') }}" class="axil-btn btn-bg-primary viewcart-btn">View Cart</a>
                <a href="{{ route('checkout.index') }}" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
            </div>
        </div>
    </div>
</div>
