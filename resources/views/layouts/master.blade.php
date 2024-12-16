<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pets Medic</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.head')
    @stack('css')
</head>

<body class="sticky-header overflow-md-visible">

    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>

    @include('layouts.header-shop')

    <main class="main-wrapper">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Include Modals -->
    @include('modals.quick-view')
    @include('modals.header-search')
    @include('modals.cart-dropdown')
    @include('layouts.script')
    @stack('js')
</body>

</html>
