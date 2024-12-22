<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Garden Fresh</title>
    <meta name="robots" content="noindex, follow">
    <meta name="author" content="themesflat.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Themesflat Modave, Multipurpose eCommerce Template" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.head')
    @stack('css')
</head>

<body class="preload-wrapper">

    <!-- Scroll Top -->
    @include('partials.back-to-top')

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>


    <!-- Include Modals -->
    <!-- search -->
    @include('modals.search')
    @include('modals.mobile-menu')
    @include('modals.categories')
    {{-- @include('modals.cart-dropdown') --}}
    @include('modals.cart')
    @include('modals.quick-add')

    <!-- Javascript -->
    @include('layouts.script')
    @stack('js')
</body>

</html>
