<div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="d-flex flex-column flex-grow-1 h-100">
                <div class="header">
                    <h5 class="title">Shopping Cart</h5>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">

                    <div class="tf-mini-cart-wrap">
                        <div class="tf-mini-cart-main">
                            <div class="tf-mini-cart-sroll cart-body">
                                <div id="cart-loader" class="cart-loader text-center py-4">
                                    <div class="fas fa-spinner fa-spin text-primary"></div>
                                    <p>Loading cart items...</p>
                                </div>
                                <div class="tf-mini-cart-items" id="cart-item-list" style="display: none;">
                                    {{-- <ul class="cart-item-list" ></ul> --}}
                                </div>
                            </div>
                        </div>
                        <div class="tf-mini-cart-bottom">

                            <div class="tf-mini-cart-bottom-wrap">
                                <div class="tf-cart-totals-discounts">
                                    <h5>Subtotal</h5>
                                    <h5 class="tf-totals-total-value" id="cart-subtotal">Rs 0</h5>
                                </div>

                                <div class="tf-mini-cart-view-checkout">
                                    <a href="{{ route('cart.index') }}"
                                        class="tf-btn w-100 btn-white radius-4 has-border"><span class="text">View
                                            cart</span></a>
                                    <a href="{{ route('checkout.index') }}" class="tf-btn w-100 btn-fill radius-4"><span
                                            class="text">Check Out</span></a>
                                </div>
                                <div class="text-center">
                                    <a data-bs-dismiss="modal" class="link text-btn-uppercase" href="#">Or
                                        continue
                                        shopping</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
