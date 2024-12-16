<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign In</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    @include('layouts.head')


</head>


<body>
    <div class="axil-signin-area">
        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-xl-4 col-sm-6">
                    <a href="/" class="site-logo">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" style=" height: 60px;" />
                    </a>
                </div>
                <div class="col-md-2 d-lg-block d-none">
                    <a href="{{ url()->previous() }}" class="back-btn"><i class="far fa-angle-left"></i></a>
                </div>
                <div class="col-xl-6 col-lg-4 col-sm-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="{{ route('login') }}" class="sign-up-btn axil-btn btn-bg-secondary">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    <h3 class="title">We Offer the Best Products</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Forgot Password?</h3>
                        <p class="b2 mb--55">
                            Enter the email address you used when you joined and we’ll send you instructions to reset
                            your password.
                        </p>
                        <form method="POST" action="{{ route('password.email') }}" class="singin-form">
                            @csrf
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autofocus />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Submit Button -->
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Send Reset
                                    Instructions</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.script')

</body>

</html>
