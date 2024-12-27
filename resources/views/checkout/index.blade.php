@extends('layouts.master')
@section('title', 'Garden Fresh | Home')
@section('content')

    <!-- page-title -->
    <x-breadcrumb home-url="{{ route('home') }}" home-label="Home" current-page="Checkout" title="Secure Your Purchase"
        image="{{ asset('assets/images/bg/1.jpg') }}" image-alt="Checkout Thumbnail" />

    <!-- /page-title -->

    <!-- Section checkout -->
    <section>
        <div class="container">
            <form action="{{ route('checkout.store') }}" class="row" method="POST">
                @csrf
                <div class="col-xl-6">
                    <div class="flat-spacing tf-page-checkout">
                        @guest
                            {{-- <div class="wrap">
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

                                </div> --}}
                        @endguest

                        <div class="wrap">
                            <h5 class="title">Information</h5>
                            <div class="info-box">

                                <!-- Validation Errors -->
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

                                <div class="container">
                                    <!-- First and Last Name -->
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <input type="text" id="first-name" name="first_name" class="form-control"
                                                placeholder="First Name*" value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" id="last-name" name="last_name" class="form-control"
                                                placeholder="Last Name*" value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email and Phone -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-12 col-md-6">
                                            <input type="email" id="email_1" name="email" class="form-control"
                                                placeholder="Email Address*" value="{{ old('email') }}" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <input type="tel" id="phone" name="phone" class="form-control"
                                                placeholder="Phone Number*" value="{{ old('phone') }}" required>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City and Address Line 1 -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-12 col-md-6">
                                            <select id="Location" name="city" class="form-select" required>
                                                @include('checkout.includes.city', [
                                                    'selectedCity' => old('city'),
                                                ])
                                            </select>
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" id="address1" name="address_line1" class="form-control"
                                                placeholder="Street Address*" value="{{ old('address_line1') }}" required>
                                            @error('address_line1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address Line 2 and Postal Code -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-12 col-md-6">
                                            <input type="text" id="address2" name="address_line2" class="form-control"
                                                placeholder="Apartment, suite, etc. (optional)"
                                                value="{{ old('address_line2') }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" id="postal_code" name="postal_code" class="form-control"
                                                placeholder="Postal Code*" value="{{ old('postal_code') }}" required>
                                            @error('postal_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <textarea id="notes" name="notes" class="form-control" placeholder="Write note...">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Account Creation -->
                                    @guest
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input type="checkbox" id="checkbox1" name="account_create"
                                                        class="form-check-input" value="1"
                                                        {{ old('account_create') ? 'checked' : '' }}
                                                        onclick="togglePasswordFields()">
                                                    <label for="checkbox1" class="form-check-label">Create an account</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="password-fields"
                                            style="display: {{ old('account_create') ? 'block' : 'none' }};">
                                            <div class="row g-3 mt-2">
                                                <div class="col-12 col-md-6">
                                                    <input type="password" id="password_1" name="password"
                                                        class="form-control" placeholder="Password*">
                                                    @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="password" id="password_confirmation"
                                                        name="password_confirmation" class="form-control"
                                                        placeholder="Confirm Password*">
                                                    @error('password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>

                        <!-- InputMask for Phone Number -->
                        @push('css')
                            <link href="https://cdn.jsdelivr.net/npm/jquery.inputmask@3.3.4/extra/css/inputmask.min.css"
                                rel="stylesheet">
                        @endpush
                        @push('js')
                            <script src="https://cdn.jsdelivr.net/npm/jquery.inputmask@3.3.4/dist/jquery.inputmask.bundle.min.js"></script>
                            <script>
                                // Apply Inputmask for Pakistani phone numbers
                                document.addEventListener('DOMContentLoaded', function() {
                                    Inputmask({
                                        mask: "03##-#######",
                                        placeholder: "03XX-XXXXXXX",
                                        showMaskOnHover: false,
                                        showMaskOnFocus: true
                                    }).mask(document.getElementById("phone"));
                                });
                            </script>
                        @endpush


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



                        <div class="wrap">
                            <h5 class="title">Choose payment Option:</h5>
                            <div class="form-payment">
                                <div class="payment-box" id="payment-box">

                                    <div class="payment-item">
                                        <label for="delivery-method" class="payment-header collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#delivery-payment"
                                            aria-controls="delivery-payment">
                                            <input type="radio" value="cod" name="payment" checked
                                                class="tf-check-rounded" id="delivery-method">
                                            <span class="text-title">Cash on delivery</span>
                                        </label>
                                        <div id="delivery-payment" class="collapse" data-bs-parent="#payment-box">
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="tf-btn btn-reset">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1">
                    <div class="line-separation"></div>
                </div>
                <div class="col-xl-5">
                    <div class="flat-spacing flat-sidebar-checkout">
                        <div id="loader" class="loader m-auto">
                            <div class="spinner">
                                <i class="fas fa-spinner text-primary  fa-spin"></i>
                            </div>
                        </div>
                        <div class="sidebar-checkout-content" id="summery-table">
                            <h5 class="title">Shopping Cart</h5>

                            <!-- Placeholder for cart items -->
                            <div class="list-product">
                                <!-- Items will be dynamically rendered here -->
                            </div>

                            <div class="sec-total-price">
                                <div class="top border-top-0">
                                    <div class="item d-flex align-items-center justify-content-between text-button">
                                        <span>Shipping</span>
                                        <span id="cart-shipping">Free</span>
                                    </div>
                                    {{-- <div class="item d-flex align-items-center justify-content-between text-button">
                                        <span>Discounts</span>
                                        <span id="cart-discounts">-Rs 0.00</span>
                                    </div> --}}
                                </div>
                                <div class="bottom">
                                    <h5 class="d-flex justify-content-between">
                                        <span>Total</span>
                                        <span class="total-price-checkout">Rs 0.00</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <!-- /Section checkout -->


@endsection
