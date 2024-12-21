@extends('layouts.master')
@section('title', 'The Pets Medic | Home')
@section('content')

    <div class="axil-main-slider-area main-slider-style-7 bg_image--8"
        style="background-image: url({{ asset('assets/images/banners/home2-slider.jpg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <div class="main-slider-content">
                        <span class="subtitle  text-light"><i class="fas fa-fire"></i>Hot Deal In Diamond</span>
                        <h1 class="title text-light">Exclusive Design Collection</h1>
                        <p>Casual line with short design in 100% suede Diamond</p>
                        <div class="shop-btn">
                            <a href="shop.html" class="axil-btn btn-bg-secondary right-icon  text-light">Browse Item <i
                                    class="fal fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Area -->
    <div class="axil-categorie-area bg-color-white axil-section-gap pb--0">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-secondary"><i class="far fa-shopping-basket"></i>The
                        Categories</span>
                    <h2 class="title">Browse by Category</h2>
                </div>
                <div class="categrie-product-activation-3 slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">
                    @foreach ($categories_section as $category)
                        <div class="slick-single-layout slick-slide">
                            <div class="categrie-product categrie-product-3" data-sal="zoom-out" data-sal-delay="100"
                                data-sal-duration="500">
                                <a href="{{ route('category.show', $category->slug) }}">
                                    <img class="img-fluid"
                                        src="{{ isset($category->image) ? asset('storage/' . $category->image) : 'https://www.ecommerce-nation.com/wp-content/uploads/2017/08/How-to-Give-Your-E-Commerce-No-Results-Page-the-Power-to-Sell.png' }}"
                                        alt="{{ $category->name }}">
                                    <h6 class="cat-title">{{ $category->name }}</h6>
                                    {{-- <strong>{{ count($category->children) }} Items</strong> --}}
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <!-- End .slick-single-layout -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Categorie Area  -->
    <div class="product-collection-area bg-lighter axil-section-gapcommon">
        <div class="container">
            <div class="section-title-border">
                <h2 class="title">Today’s Best Deals 💥</h2>
                <div class="view-btn"><a href="shop.html">View All Deals</a></div>
            </div>
            <div class="row">
                <div class="col-xl-7">
                    <div class="product-collection product-collection-two">
                        <div class="collection-content">
                            <h3 class="title">Decorative Plant <br> For Home</h3>
                            <div class="price-warp">
                                <span class="price-text">Starting From</span>
                                <span class="price">$35.00</span>
                            </div>
                            <div class="shop-btn">
                                <a href="shop.html" class="axil-btn btn-bg-primary btn-size-md"><i
                                        class="far fa-shopping-cart"></i> View All Items</a>
                            </div>
                            <div class="plus-btn">
                                <a href="#" class="plus-icon"><i class="far fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="collection-thumbnail">
                            <img src="assets/images/product/collection_5.jpg" alt="Mega Collection">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.html">Ladies Short Sleeve Dress</a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$30.00</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_5.png" alt="Product">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.html">Oil Soap Wood Home Cleaner</a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$15.22</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_6.png" alt="Product">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.html">Large Pendant Light Ceiling </a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$11.70</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_7.png" alt="Product">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.html">Iphone New Model</a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$499.00</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_8.png" alt="Product">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Expolre Product Area  -->
    <div class="axil-product-area bg-color-white axil-section-gap">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i> Our
                    Products</span>
                <h2 class="title">Explore our Products</h2>
            </div>
            <div
                class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                <div class="slick-single-layout">
                    <div class="row row--15">
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800"
                                            loading="lazy" class="main-img"
                                            src="{{ asset('assets/images/banners/1.JPG') }}" alt="Product Images">
                                        <img class="hover-img" src="assets/images/product/electric/product-08.png"
                                            alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget">20% Off</div>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option">
                                                <a href="single-product.html">
                                                    Add to Cart
                                                </a>
                                            </li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <span class="icon">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span class="rating-number">(64)</span>
                                        </div>
                                        <h5 class="title"><a href="single-product.html">Yantiti Leather & Canvas Bags</a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$29.99</span>
                                            <span class="price old-price">$49.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product  -->
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="300" data-sal-duration="800"
                                            loading="lazy" src="assets/images/product/electric/product-02.png"
                                            alt="Product Images">
                                        <img class="hover-img" src="assets/images/product/electric/product-06.png"
                                            alt="Product Images">
                                    </a>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Select Option</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="single-product.html">Level 20 RGB Cherry</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$29.99</span>
                                            <span class="price old-price">$49.99</span>
                                        </div>
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product  -->
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="400" data-sal-duration="800"
                                            loading="lazy" src="assets/images/product/electric/product-03.png"
                                            alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget">20% Off</div>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Select Option</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="single-product.html">Logitech Streamcam</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$29.99</span>
                                            <span class="price old-price">$49.99</span>
                                        </div>
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product  -->
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="500" data-sal-duration="800"
                                            loading="lazy" src="assets/images/product/electric/product-04.png"
                                            alt="Product Images">
                                        <img class="hover-img" src="assets/images/product/electric/product-05.png"
                                            alt="Product Images">
                                    </a>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Select Option</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <span class="icon">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span class="rating-number">(44)</span>
                                        </div>
                                        <h5 class="title"><a href="single-product.html">3D™ wireless headset</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$29.99</span>
                                            <span class="price old-price">$49.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="row row--15">
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img src="assets/images/product/electric/product-01.png" alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget">20% Off</div>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Select Option</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="single-product.html">Yantiti Leather & Canvas Bags</a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$29.99</span>
                                            <span class="price old-price">$49.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product  -->
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img src="assets/images/product/electric/product-02.png" alt="Product Images">
                                    </a>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Select Option</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="single-product.html">3D™ wireless headset</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$29.99</span>
                                            <span class="price old-price">$49.99</span>
                                        </div>
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product  -->
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img src="assets/images/product/electric/product-03.png" alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget">20% Off</div>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Select Option</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="single-product.html">3D™ wireless headset</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$29.99</span>
                                            <span class="price old-price">$49.99</span>
                                        </div>
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- End .slick-single-layout -->
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt--20 mt_sm--0">
                    <a href="shop.html" class="axil-btn btn-bg-lighter btn-load-more">View All Products</a>
                </div>
            </div>

        </div>
    </div>
    <!-- End Expolre Product Area  -->


    <div class="sale-banner-area">
        <div class="container">
            <div class="sale-banner-thumb">
                <a href="shop.html"><img src="assets/images/banner/sale_banner.png" alt="Sale Banner"></a>
            </div>
        </div>
    </div>
    <!-- Start Best Sellers Product Area  -->
    <div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-secondary"><i class="far fa-shopping-basket"></i>This
                    Month</span>
                <h2 class="title">Best Sellers</h2>
            </div>
            <div
                class="new-arrivals-product-activation-2 product-transparent-layout slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile">

                <div class="slick-single-layout">
                    <div class="axil-product product-style-seven">
                        <div class="product-content">
                            <div class="cart-btn">
                                <a href="cart.html">
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">Comfort Unisex Hoddie</a></h5>
                                <div class="product-price-variant">
                                    <span class="price current-price">$29.99</span>
                                    <span class="price old-price">$49.99</span>
                                </div>
                                <div class="product-rating">
                                    <span class="icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="rating-number">(44)</span>
                                </div>
                            </div>
                        </div>
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img data-sal="zoom-out" data-sal-delay="100" data-sal-duration="800" loading="lazy"
                                    src="assets/images/product/fashion/product-17.png" alt="Product Images">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End  Best Sellers Product Area  -->
    <div class="axil-new-arrivals-product-area fullwidth-container flash-sale-area section-gap-80-35">
        <div class="container ml--xxl-0">
            <div class="section-title-border slider-section-title">
                <h2 class="title">Recently Viewed 💥</h2>
            </div>
            <div class="recently-viwed-activation slick-layout-wrapper--15 axil-slick-angle angle-top-slide">
                <div class="slick-single-layout">
                    <div class="axil-product product-style-eight">
                        <div class="thumbnail">
                            <a href="single-product-8.html">
                                <img data-sal="zoom-out" data-sal-delay="100" data-sal-duration="800" loading="lazy"
                                    class="main-img" src="assets/images/product/fashion/product-26.png"
                                    alt="Product Images">
                            </a>
                            <div class="label-block label-left">
                                <div class="product-badget sale">Sale</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="select-option">
                                        <a href="single-product-8.html">
                                            <i class="far fa-shopping-cart"></i> Add to Cart
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product-8.html">Kalrez® Spectrum™ 6375</a></h5>
                                <div class="product-rating">
                                    <span class="icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="rating-number">6,400</span>
                                </div>
                                <div class="product-price-variant">
                                    <span class="price old-price">$30.00</span>
                                    <span class="price current-price">$17.84</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Expolre Product Area  -->




    <div class="delivery-poster-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="delivery-poster pickup">
                        <div class="content">
                            <span class="badge">Always free</span>
                            <h4 class="title">Order Pickup</h4>
                            <p>Choose Order Pickup & we’ll have it waiting for you inside the store.</p>
                        </div>
                        <div class="thumbnail">
                            <img src="assets/images/banner/delivery_1.png" alt="Man">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="delivery-poster delivery">
                        <div class="content">
                            <span class="badge">Fast delivery</span>
                            <h4 class="title">Same Day Delivery</h4>
                            <p>We will delivery your goods on the same day on your doorstep.</p>
                        </div>
                        <div class="thumbnail">
                            <img src="assets/images/banner/delivery_2.png" alt="Man">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
