<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Sign In | Shopsphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Shopsphere Admin For Ecommerce" name="description" />
    <meta content="Shopsphere" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/assets/images/favicon.ico') }}" />

    <!-- Layout config Js -->
    <script src="{{ asset('admin-assets/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin-assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin-assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin-assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('admin-assets/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="{{ route('home') }}" class="d-inline-block auth-logo">
                                    <img src="{{ asset('admin-assets/assets/images/logo-light.png') }}" alt=""
                                        height="20" />
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">
                                Premium E-commerce Dashboard
                            </p>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Shopsphere.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    @if (session('error_message'))
                                        @component('admin.components.alert', [
                                            'type' => 'danger',
                                            'icon' => 'error-warning-line',
                                            'message' => session('error_message'),
                                        ])
                                        @endcomponent
                                    @endif



                                    <form action="{{ route('admin.login.submit') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="Enter username" value="{{ session('username') }}" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password"
                                                    class="form-control pe-5 password-input"
                                                    placeholder="Enter password" id="password-input" />
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>


                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">
                                                Sign In
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">
                            <p style="margin-bottom: 0; color: #6c757d;">
                                &copy; <span id="current-year"></span> Developed by Shopsphere
                            </p>
                        </div>
                        <script>
                            document.getElementById('current-year').textContent = new Date().getFullYear();
                        </script>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin-assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('admin-assets/assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('admin-assets/assets/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('admin-assets/assets/js/pages/password-addon.init.js') }}"></script>

</body>

</html>
