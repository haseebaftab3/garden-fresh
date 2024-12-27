@extends('layouts.master')

@section('title', $product->metaData->meta_title ?? ($product->title ?? null))
@section('meta_description', $product->metaData->meta_description ?? null)
@section('meta_keywords', $product->metaData->meta_keywords ?? null)
@section('og_title', $product->metaData->meta_title ?? ($product->title ?? null))
@section('og_description', $product->metaData->meta_description ?? null)
@section('og_image', Storage::url($product->cover_image) ?? null)
@section('canonical_url', url()->current() ?? null)
@section('twitter_card', 'summary_large_image')
@section('twitter_title', $product->metaData->meta_title ?? ($product->title ?? null))
@section('twitter_description', $product->metaData->meta_description ?? null)
@section('twitter_image', Storage::url($product->cover_image) ?? asset('images/default-twitter-image.jpg'))
@section('twitter_site', '@gardenfreshpk')



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
