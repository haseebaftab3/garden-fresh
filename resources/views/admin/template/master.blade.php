<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Shopsphere" name="author" />
    <title>@yield('title', 'Shopsphere | Dashboard')</title>
    @include('admin.template.head');
    @stack('css')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.template.header')
        @include('admin.template.aside')

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')
        </div>

    </div>




    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Theme Settings -->



    @include('admin.template.js')
    @stack('js')

</body>

</html>
