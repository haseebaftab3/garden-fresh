@extends('layouts.master')
@section('title', 'The Pets Medic | Home')
@section('content')

    <!-- page-title -->
    <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
        <div class="container">
            <h3 class="heading text-center">Check Out</h3>
            <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                <li><a class="link" href="index.html">Homepage</a></li>
                <li><i class="icon-arrRight"></i></li>
                <li><a class="link" href="shop-default-grid.html">Shop</a></li>
                <li><i class="icon-arrRight"></i></li>
                <li>View Cart</li>
            </ul>
        </div>
    </div>
    <!-- /page-title -->

    <!-- Section checkout -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="flat-spacing tf-page-checkout">
                        @guest
                            <div class="wrap">
                                <div class="title-login">
                                    <p>Already have an account?</p>
                                    <a href="{{ route('logout') }}" class="text-button">Login here</a>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <form class="login-box" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="grid-2">
                                        <input type="email" name="email" required placeholder="Your name/Email"
                                            value="{{ old('email') }}">
                                        <input type="password" name="password" required placeholder="Password">
                                    </div>
                                    <button class="tf-btn" type="submit"><span class="text">Login</span></button>
                                </form>

                            </div>
                        @endguest

                        <div class="wrap">
                            <h5 class="title">Information</h5>
                            <form class="info-box" action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                @if ($errors->any() || session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error:</strong>
                                        <ul>
                                            <!-- Display Validation Errors -->
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach

                                            <!-- Display Session-Based Errors -->
                                            @if (session('error'))
                                                <li>{{ session('error') }}</li>
                                            @endif
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="grid-2">
                                    <input type="text" id="first-name" name="first_name" placeholder="First Name*"
                                        value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" id="last-name" name="last_name" placeholder="Last Name*"
                                        value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid-2">
                                    <input type="email" id="email_1" name="email" placeholder="Email Address*"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="tel" id="phone" name="phone" placeholder="Phone Number*"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid-2">
                                    <div class="tf-select">
                                        <select id="Location" name="city" data-default="" required>
                                            @include('checkout.includes.city', [
                                                'selectedCity' => old('city'),
                                            ])
                                        </select>
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="text" id="address1" name="address_line1" placeholder="Street Address*"
                                        value="{{ old('address_line1') }}" required>
                                    @error('address_line1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid-2">
                                    <input type="text" id="address2" name="address_line2"
                                        placeholder="Apartment, suite, etc. (optional)" value="{{ old('address_line2') }}">
                                    <input type="text" id="postal_code" name="postal_code" placeholder="Postal Code*"
                                        value="{{ old('postal_code') }}" required>
                                    @error('postal_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <textarea id="notes" name="notes" placeholder="Write note...">{{ old('notes') }}</textarea>

                                @guest
                                    <div class="form-group input-group">
                                        <input type="checkbox" id="checkbox1" name="account_create" class="tf-check"
                                            value="1" {{ old('account_create') ? 'checked' : '' }}
                                            onclick="togglePasswordFields()">
                                        <label for="checkbox1" class="pl-3">Create an account</label>
                                    </div>
                                    <div id="password-fields"
                                        style="display: {{ old('account_create') ? 'block' : 'none' }};">
                                        <div class="grid-2">
                                            <input type="password" id="password_1" name="password" placeholder="Password*"
                                                class="form-control">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                placeholder="Confirm Password*" class="form-control">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @push('js')
                                        <script>
                                            function togglePasswordFields() {
                                                const checkbox = document.getElementById('checkbox1');
                                                const passwordFields = document.getElementById('password-fields');

                                                if (checkbox.checked) {
                                                    passwordFields.style.display = 'block';
                                                } else {
                                                    passwordFields.style.display = 'none';
                                                }
                                            }
                                        </script>
                                    @endpush
                                @endguest
                            </form>
                        </div>


                        <div class="wrap">
                            <h5 class="title">Choose payment Option:</h5>
                            <form class="form-payment">
                                <div class="payment-box" id="payment-box">

                                    <div class="payment-item">
                                        <label for="delivery-method" class="payment-header collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#delivery-payment"
                                            aria-controls="delivery-payment">
                                            <input type="radio" name="payment-method" checked class="tf-check-rounded"
                                                id="delivery-method">
                                            <span class="text-title">Cash on delivery</span>
                                        </label>
                                        <div id="delivery-payment" class="collapse" data-bs-parent="#payment-box"></div>
                                    </div>

                                </div>
                                <button class="tf-btn btn-reset">Payment</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1">
                    <div class="line-separation"></div>
                </div>
                {{-- <div class="col-xl-5">
                    <div class="flat-spacing flat-sidebar-checkout">
                        <div class="sidebar-checkout-content">
                            <h5 class="title">Shopping Cart</h5>
                            <div class="list-product">
                                <div class="item-product">
                                    <a href="product-detail.html" class="img-product">
                                        <img src="images/products/womens/women-19.jpg" alt="img-product">
                                    </a>
                                    <div class="content-box">
                                        <div class="info">
                                            <a href="product-detail.html" class="name-product link text-title">V-neck
                                                cotton T-shirt</a>
                                            <div class="variant text-caption-1 text-secondary"><span
                                                    class="size">XL</span>/<span class="color">Blue</span></div>
                                        </div>
                                        <div class="total-price text-button"><span class="count">1</span>X<span
                                                class="price">$60.00</span></div>
                                    </div>
                                </div>
                                <div class="item-product">
                                    <a href="product-detail.html" class="img-product">
                                        <img src="images/products/womens/women-1.jpg" alt="img-product">
                                    </a>
                                    <div class="content-box">
                                        <div class="info">
                                            <a href="product-detail.html" class="name-product link text-title">Polarized
                                                sunglasses</a>
                                            <div class="variant text-caption-1 text-secondary"><span
                                                    class="size">XL</span>/<span class="color">Blue</span></div>
                                        </div>
                                        <div class="total-price text-button"><span class="count">1</span>X<span
                                                class="price">$60.00</span></div>
                                    </div>
                                </div>
                                <div class="item-product">
                                    <a href="product-detail.html" class="img-product">
                                        <img src="images/products/womens/women-29.jpg" alt="img-product">
                                    </a>
                                    <div class="content-box">
                                        <div class="info">
                                            <a href="product-detail.html" class="name-product link text-title">Ramie shirt
                                                with pockets </a>
                                            <div class="variant text-caption-1 text-secondary"><span
                                                    class="size">XL</span>/<span class="color">Blue</span></div>
                                        </div>
                                        <div class="total-price text-button"><span class="count">1</span>X<span
                                                class="price">$60.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="sec-discount">
                                <div dir="ltr" class="swiper tf-sw-categories" data-preview="2.25" data-tablet="3"
                                    data-mobile-sm="2.5" data-mobile="1.2" data-space-lg="20" data-space-md="20"
                                    data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="box-discount">
                                                <div class="discount-top">
                                                    <div class="discount-off">
                                                        <div class="text-caption-1">Discount</div>
                                                        <span class="sale-off text-btn-uppercase">10% OFF</span>
                                                    </div>
                                                    <div class="discount-from">
                                                        <p class="text-caption-1">For all orders <br> from 200$</p>
                                                    </div>
                                                </div>
                                                <div class="discount-bot">
                                                    <span class="text-btn-uppercase">Mo234231</span>
                                                    <button class="tf-btn"><span class="text">Apply Code</span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="box-discount active">
                                                <div class="discount-top">
                                                    <div class="discount-off">
                                                        <div class="text-caption-1">Discount</div>
                                                        <span class="sale-off text-btn-uppercase">10% OFF</span>
                                                    </div>
                                                    <div class="discount-from">
                                                        <p class="text-caption-1">For all orders <br> from 200$</p>
                                                    </div>
                                                </div>
                                                <div class="discount-bot">
                                                    <span class="text-btn-uppercase">Mo234231</span>
                                                    <button class="tf-btn"><span class="text">Apply Code</span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="box-discount">
                                                <div class="discount-top">
                                                    <div class="discount-off">
                                                        <div class="text-caption-1">Discount</div>
                                                        <span class="sale-off text-btn-uppercase">10% OFF</span>
                                                    </div>
                                                    <div class="discount-from">
                                                        <p class="text-caption-1">For all orders <br> from 200$</p>
                                                    </div>
                                                </div>
                                                <div class="discount-bot">
                                                    <span class="text-btn-uppercase">Mo234231</span>
                                                    <button class="tf-btn"><span class="text">Apply Code</span></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="ip-discount-code">
                                    <input type="text" placeholder="Add voucher discount">
                                    <button class="tf-btn"><span class="text">Apply Code</span></button>
                                </div>
                                <p>Discount code is only used for orders with a total value of products over $500.00</p>
                            </div>
                            <div class="sec-total-price">
                                <div class="top">
                                    <div class="item d-flex align-items-center justify-content-between text-button">
                                        <span>Shipping</span>
                                        <span>Free</span>
                                    </div>
                                    <div class="item d-flex align-items-center justify-content-between text-button">
                                        <span>Discounts</span>
                                        <span>-$80.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <h5 class="d-flex justify-content-between">
                                        <span>Total</span>
                                        <span class="total-price-checkout">$186,99</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- /Section checkout -->


@endsection
