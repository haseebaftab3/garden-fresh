@extends('layouts.master')
@section('title', 'The Pets Medic | Home')
@section('content')
    <!-- Start Checkout Area  -->
    <div class="axil-checkout-area axil-section-gap">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="axil-checkout-notice">
                        @guest
                            <div class="axil-toggle-box">

                                <div class="toggle-bar {{ $errors->has('email') || $errors->has('password') ? 'active' : '' }}">

                                    <i class="fas fa-user"></i> Returning customer? <a href="javascript:void(0)"
                                        class="toggle-btn">Click here to login <i class="fas fa-angle-down"></i></a>
                                </div>
                                <div class="axil-checkout-login toggle-open"
                                    style="display: {{ $errors->has('email') || $errors->has('password') ? 'block' : 'none' }}">
                                    <p>If you didn't Logged in, Please Log in first.</p>
                                    <form method="POST" action="{{ route('login') }}" class="signin-form">
                                        @csrf
                                        <div class="signin-box">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}" required autofocus>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input id="password" type="password" class="form-control" name="password"
                                                    required>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb--0">
                                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Sign
                                                    In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endguest



                        <div class="axil-toggle-box">
                            <div class="toggle-bar"><i class="fas fa-pencil"></i> Have a coupon? <a
                                    href="javascript:void(0)" class="toggle-btn">Click here to enter your code <i
                                        class="fas fa-angle-down"></i></a>
                            </div>

                            <div class="axil-checkout-coupon toggle-open">
                                <p>If you have a coupon code, please apply it below.</p>
                                <div class="input-group">
                                    <input placeholder="Enter coupon code" type="text">
                                    <div class="apply-btn">
                                        <button type="submit" class="axil-btn btn-bg-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('checkout.store') }}" method="POST">
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

                        <div class="axil-checkout-billing">
                            <h4 class="title mb--40">Billing details</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first-name">First Name <span>*</span></label>
                                        <input type="text" id="first-name" name="first_name" class="form-control"
                                            placeholder="Adam" value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last-name">Last Name <span>*</span></label>
                                        <input type="text" id="last-name" name="last_name" class="form-control"
                                            placeholder="John" value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="address1">Street Address <span>*</span></label>
                                <input type="text" id="address1" name="address_line1" class="form-control mb--15"
                                    placeholder="House number and street name" value="{{ old('address_line1') }}" required>
                                @error('address_line1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="text" id="address2" name="address_line2" class="form-control"
                                    placeholder="Apartment, suite, unit, etc. (optional)"
                                    value="{{ old('address_line2') }}">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Location">City <span>*</span></label>
                                        <select name="city" id="Location" required>
                                            @include('checkout.includes.city', [
                                                'selectedCity' => old('city'),
                                            ])
                                        </select> @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code <span>*</span></label>
                                        <input type="text" id="postal_code" name="postal_code" class="form-control"
                                            placeholder="e.g. 12345" value="{{ old('postal_code') }}" required>
                                        @error('postal_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="phone">Phone <span>*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="e.g. 0300 1234567" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address <span>*</span></label>
                                <input type="email" id="email_1" name="email" class="form-control"
                                    placeholder="e.g. example@mail.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            @guest
                                <div class="form-group input-group">
                                    <input type="checkbox" id="checkbox1" name="account_create" value="1"
                                        {{ old('account_create') ? 'checked' : '' }} onclick="togglePasswordFields()">
                                    <label for="checkbox1">Create an account</label>
                                </div>

                                <!-- Password Fields -->
                                <div id="password-fields" style="display: {{ old('account_create') ? 'block' : 'none' }};">
                                    <div class="form-group">
                                        <label for="password_1">Password <span>*</span></label>
                                        <input type="password" id="password_1" name="password" class="form-control"
                                            placeholder="Enter your password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password <span>*</span></label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" placeholder="Confirm your password">
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



                            <div class="form-group">
                                <label for="notes">Other Notes (optional)</label>
                                <textarea id="notes" name="notes" rows="2" class="form-control" placeholder="Notes about your order">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                </div>

                <div class="col-lg-6">
                    <div class="axil-order-summery order-checkout-summery">
                        <h5 class="title mb--20">Your Order</h5>
                        <div id="summery-table-wrap" class="summery-table-wrap">
                            <div id="loader" class="loader m-auto">
                                <div class="spinner">
                                    <i class="fas fa-spinner fa-spin"></i> Loading...
                                </div>
                            </div>
                            <table id="summery-table" class="table summery-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="summery-table-body">
                                </tbody>
                            </table>
                        </div>


                        <div class="order-payment-method">
                            {{-- <div class="single-payment">
                                <div class="input-group">
                                    <input type="radio" id="radio4" name="payment">
                                    <label for="radio4">Direct bank transfer</label>
                                </div>
                                <p>Make your payment directly into our bank account. Please use your Order ID as the
                                    payment reference. Your order will not be shipped until the funds have cleared in
                                    our account.</p>
                            </div> --}}
                            <div class="single-payment">
                                <div class="input-group">
                                    <input type="radio" checked id="radio5" value="cod" name="payment">
                                    <label for="radio5">Cash on delivery</label>
                                </div>
                                <p>Pay with cash upon delivery.</p>
                            </div>
                            {{-- <div class="single-payment">
                                <div class="input-group justify-content-between align-items-center">
                                    <input type="radio" id="radio6" name="payment" checked>
                                    <label for="radio6">Paypal</label>
                                    <img src="assets/images/others/payment.png" alt="Paypal payment">
                                </div>
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                                </p>
                            </div> --}}
                        </div>
                        <button type="submit" class="axil-btn btn-bg-primary checkout-btn">Process to
                            Checkout</button>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    <!-- End Checkout Area  -->
@endsection
