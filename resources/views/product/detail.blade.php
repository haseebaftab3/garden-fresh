@extends('layouts.master')
@section('title', 'Product Details')
@section('content')


    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap">
                <div class="tf-breadcrumb-list">
                    <a href="{{ route('home') }}" class="text text-caption-1">Homepage</a>
                    <i class="icon icon-arrRight"></i>
                    <a href="#" class="text text-caption-1">Women</a>
                    <i class="icon icon-arrRight"></i>
                    <span class="text text-caption-1">Leather boots with tall leg</span>
                </div>
                <div class="tf-breadcrumb-prev-next">
                    <a href="product-bottom-thumbnails.html" class="tf-breadcrumb-prev">
                        <i class="icon icon-arrLeft"></i>
                    </a>
                    <a href="product-bottom-thumbnails.html" class="tf-breadcrumb-back">
                        <i class="icon icon-squares-four"></i>
                    </a>
                    <a href="product-bottom-thumbnails.html" class="tf-breadcrumb-next">
                        <i class="icon icon-arrRight"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->





    <x-product-details :product="$product" />



    </div>
    <!-- End Shop Area  -->




    @push('js')
        <script type="module" src="{{ asset('assets/js/model-viewer.min.js') }}"></script>
        <script type="module" src="{{ asset('assets/js/zoom.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Check if the loader overlay exists inside the product-variations-wrapper
                const $loaderOverlay = $(".product-variations-wrapper .loader-overlay");

                if ($loaderOverlay.length > 0) {
                    // Show the loader
                    $loaderOverlay.show();
                    $(window).on("load", function() {
                        $loaderOverlay.hide();
                    });
                } else {
                    console.log("Loader overlay not found. Skipping loader handling.");
                }
            });
        </script>
    @endpush
@endsection
