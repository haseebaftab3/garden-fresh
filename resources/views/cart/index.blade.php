@extends('layouts.master')
@section('title', 'Garden Fresh | Home')
@section('content')

    <!-- page-title -->
    <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
        <div class="container">
            <h3 class="heading text-center">Shopping Cart</h3>
            <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                <li><a class="link" href="index.html">Homepage</a></li>
                <li><i class="icon-arrRight"></i></li>
                <li><a class="link" href="shop-default-grid.html">Shop</a></li>
                <li><i class="icon-arrRight"></i></li>
                <li>Shopping Cart</li>
            </ul>
        </div>
    </div>

    <section class="flat-spacing">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="cart-body"></div>
                    <div id="cartPageContentLoader">
                        <div colspan="6" style="text-align: center;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                    <form id="cartPageContent" style="display: none">
                        <table class="tf-table-page-cart table axil-cart-table">
                            <thead>
                                <tr>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </form>
                </div>
                <div class="col-xl-4">
                    <div class="fl-sidebar-cart">
                        <div class="box-order bg-surface">
                            <h5 class="title">Order Summary</h5>
                            <div class="subtotal text-button d-flex justify-content-between align-items-center">
                                <span>Subtotal</span>
                                <span class="total" id="cart-page-cart-subtotal">-Rs 0</span>
                            </div>


                            <h5 class="total-order d-flex justify-content-between align-items-center">
                                <span>Total</span>
                                <span class="total" id="cart-page-cart-subtotal1">Rs 0</span>
                            </h5>
                            <div class="box-progress-checkout">

                                <a href="{{ route('checkout.index') }}" class="tf-btn btn-reset">Process To Checkout</a>
                                <p class="text-button text-center">
                                    <a href="{{ route('shop') }}" class="link">Or continue shopping</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Section cart -->





@endsection
