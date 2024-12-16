<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'The Pets Medic')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    @include('layout.head')
    @stack('css')
</head>

<body>


    @include('layout.pre-loader')



    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->


    <!-- header-area -->
    {{-- @if (Route::is('home')) --}}
    @include('layout.header-shop')
    {{-- @else
        @include('layout.header')
    @endif --}}
    <!-- header-area-end -->


    <!-- main-area -->
    <main class="fix">
        @yield('content')
    </main>
    <!-- main-area-end -->

    <!-- footer-area -->
    @include('layout.footer')
    <!-- footer-area-end -->


    @include('layout.script')
    @stack('js')
</body>



</html>
