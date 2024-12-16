@extends('layout.master')
@section('title', 'The Pets Medic | Home')
@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area fix">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="breadcrumb__content">
                        <h3 class="title">All Products</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="index.html">Home</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="flaticon-right-arrow-angle"></i></span>
                            <span property="itemListElement" typeof="ListItem">All Products</span>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="breadcrumb__img">
                        <img src="assets/img/images/breadcrumb_img.png" alt="img" data-aos="fade-left"
                            data-aos-delay="800">
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="assets/img/images/breadcrumb_shape01.png" alt="img" data-aos="fade-down-right"
                data-aos-delay="400">
            <img src="assets/img/images/breadcrumb_shape02.png" alt="img" data-aos="fade-up-left" data-aos-delay="400">
        </div>
    </section>
    <!-- breadcrumb-area-end -->


    <!-- product-area -->
    <section class="product__area-four">
        <div class="container">
            <div
                class="row gutter-20 row-cols-1 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 justify-content-center">
                @foreach ($products as $product)
                    @php
                        // Initialize the label variable
                        $product_discount_label = '';

                        // Check conditions and assign the label accordingly
                        if (!empty($product->discount) && $product->discount > 0) {
                            // If the product has a discount greater than 0, set the label to 'Sale'
                            $product_discount_label = 'Sale';
                        } elseif (
                            !empty($product->updated_at) &&
                            \Carbon\Carbon::parse($product->updated_at)->diffInDays(now()) <= 5
                        ) {
                            $product_discount_label = 'New';
                        } elseif (
                            empty($product->updated_at) &&
                            !empty($product->created_at) &&
                            \Carbon\Carbon::parse($product->created_at)->diffInDays(now()) <= 5
                        ) {
                            // If 'updated_at' does not exist but 'created_at' exists and is within the last 5 days, set the label to 'New'
                            $product_discount_label = 'New';
                        } else {
                            // If none of the above conditions are met, set the label to an empty string
                            $product_discount_label = '';
                        }
                    @endphp


                    <x-product-item image="{{ Storage::url($product->cover_image) }}"
                        detailsUrl="{{ route('product.details', $product->slug) }}"
                        wishlistUrl="{{ route('wishlist.add', $product->id) }}"
                        cartUrl="{{ route('cart.add', $product->id) }}" badge="{{ $product_discount_label }}" rating="0"
                        reviewsCount="0" title="{{ $product->title }}" price="{{ (float) $product->price }}"
                        oldPrice="{{ $product->discount > 0 ? (float) $product->discount : '' }}" />
                @endforeach
            </div>
            {{ $products->links('vendor.pagination') }}
        </div>
    </section>
    <!-- product-area-end -->
@endsection
