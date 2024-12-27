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
                    <a href="{{ route('shop') }}" class="text text-caption-1">{{ $product->category->name }}</a>
                    <i class="icon icon-arrRight"></i>
                    <span class="text text-caption-1">{{ $product->title }}</span>
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
