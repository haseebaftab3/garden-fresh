@extends('layouts.master')
@section('title', 'The Pets Medic | Home')
@section('content')

    <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap">
                <div class="product-table-heading">
                    <h4 class="title">Your Cart</h4>
                    <a href="#" class="cart-clear">Clear Shoping Cart</a>
                </div>
                <div class="cart-body"></div>
                <div id="cartPageContentLoader">
                    <div colspan="6" style="text-align: center;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="table-responsive " id="cartPageContent" style="display: none">
                    <table class="table axil-product-table axil-cart-table mb--40">
                        <thead>
                            <tr>
                                <th scope="col" class="product-remove"></th>
                                <th scope="col" class="product-thumbnail">Product</th>
                                <th scope="col" class="product-title"></th>
                                <th scope="col" class="product-price">Price</th>
                                <th scope="col" class="product-quantity">Quantity</th>
                                <th scope="col" class="product-subtotal">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>

                            {{-- Dynamic --}}


                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="pt-5">
                                    <h4>Subtotal</h4>
                                </td>
                                <td colspan="4" class="pt-5">
                                    <h4 id="cart-page-cart-subtotal"></h4></span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                <div class="d-flex justify-content-end"> <a href="{{ route('checkout.index') }}"
                        class="axil-btn btn-bg-primary checkout-btn">Process to Checkout</a>
                </div>

            </div>
        </div>
    </div>
@endsection
