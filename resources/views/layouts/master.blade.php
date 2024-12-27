<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Buy Premium Quality Farm-Fresh Kinnow Oranges Online – Garden Fresh Pakistan')</title>

    <!-- Basic SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Buy premium-quality, farm-fresh Kinnow oranges from Garden Fresh Pakistan. Enjoy free shipping on every order and farm-to-doorstep delivery of the juiciest oranges.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Kinnow oranges, Farm-fresh oranges, Buy Kinnow online, Free shipping fruits, Garden Fresh Pakistan, Premium Kinnow delivery')">
    <meta name="author" content="@yield('meta_author', 'Garden Fresh')">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="@yield('og_title', 'Buy Premium Quality Farm-Fresh Kinnow Oranges Online – Garden Fresh Pakistan')">
    <meta property="og:description" content="@yield('og_description', 'Order farm-fresh Kinnow oranges with free shipping anywhere in Pakistan. Garden Fresh delivers the juiciest and healthiest oranges to your doorstep.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/og/1.jpeg'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="@yield('og_site_name', 'Garden Fresh')">

    <!-- Twitter -->
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:title" content="@yield('twitter_title', 'Buy Premium Quality Farm-Fresh Kinnow Oranges Online – Garden Fresh Pakistan')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Get farm-fresh Kinnow oranges delivered to your doorstep in Pakistan. Free shipping on every order.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/images/og/1.jpeg'))">
    <meta name="twitter:site" content="@yield('twitter_site', '@gardenfreshpk')">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Favicon -->
    <!-- Favicon Links -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('icons/site.webmanifest') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icons/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('icons/android-chrome-512x512.png') }}">



    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Product",
            "name": "@yield('schema_name', 'Farm-Fresh Kinnow Oranges')",
            "image": "@yield('schema_image', asset('images/kinnow-product-image.jpg'))",
            "description": "@yield('schema_description', 'Buy premium-quality Kinnow oranges sourced fresh from farms in Pakistan. Perfect for gifting or personal use.')",
            "brand": {
                "@type": "Brand",
                "name": "@yield('schema_brand', 'Garden Fresh')"
            },
            "offers": {
                "@type": "Offer",
                "priceCurrency": "@yield('schema_currency', 'PKR')",
                "price": "@yield('schema_price', '3000')",
                "itemCondition": "https://schema.org/NewCondition",
                "availability": "https://schema.org/InStock",
                "url": "@yield('schema_url', url()->current())"
            }
        }
    </script>

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
    @include('modals.cart-dropdown')
    {{-- @include('modals.cart') --}}
    @include('modals.quick-add')

    <!-- Javascript -->
    @include('layouts.script')
    @stack('js')
</body>

</html>
