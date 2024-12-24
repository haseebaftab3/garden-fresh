@extends('layouts.master')
@section('title', 'The Pets Medic | Home')
@section('content')
    <!-- /Header -->
    <!-- Slider -->
    <div class="slider-padding">
        <div class="tf-slideshow slider-default slider-position slider-effect-fade slider-radius-2">
            <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1"
                data-centered="false" data-space="0" data-space-mb="0" data-loop="true" data-auto-play="false">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ asset('assets/images/slider/slider-organic.jpeg') }}" alt="fashion-slideshow" />
                            <div class="box-content">
                                <div class="content-slider">
                                    <div class="box-title-slider">
                                        <div class="fade-item fade-item-1 heading title-display text-white">
                                            Export Quality <br />
                                            Oranges
                                        </div>
                                        <p class="fade-item fade-item-2 body-text-1 text-white">
                                            From Our Garden to Your Doorstep
                                        </p>
                                    </div>
                                    <div class="fade-item fade-item-3 box-btn-slider">
                                        <a href="{{ route('shop') }}" class="tf-btn btn-fill btn-white"><span
                                                class="text">Shop Now</span><i class="icon icon-arrowUpRight"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ asset('assets/images/slider/slider-organic2.jpeg') }}" alt="fashion-slideshow" />
                            <div class="box-content">
                                <div class="content-slider">
                                    <div class="box-title-slider">
                                        <div class="fade-item fade-item-1 heading title-display text-white">
                                            Vibrant, Juicy and <br />
                                            Always Fresh
                                        </div>
                                        <p class="fade-item fade-item-2 body-text-1 text-white">
                                            Experience the taste of Garden Fresh Oranges.
                                        </p>
                                    </div>
                                    <div class="fade-item fade-item-3 box-btn-slider">
                                        <a href="{{ route('shop') }}" class="tf-btn btn-fill btn-white"><span
                                                class="text">Shop Now</span><i class="icon icon-arrowUpRight"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-pagination">
                <div class="container">
                    <div class="sw-dots sw-pagination-slider type-circle white-circle-line justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Slider -->
    <!-- Deal of the day -->
    <section class="flat-spacing">
        <div class="container">
            <div class="heading-section text-center wow fadeInUp">
                <h3 class="heading">Deal of the day</h3>
                <p class="subheading text-secondary">
                    Fresh styles just in! Elevate your look.
                </p>
            </div>
            <div dir="ltr" class="swiper tf-sw-recent" data-preview="4" data-tablet="3" data-mobile="2"
                data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <!-- 1 -->
                    <div class="swiper-slide">
                        <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-1.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-1.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-2.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-2.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="variant-wrap size-list">
                                    <ul class="variant-box">
                                        <li class="size-item">S</li>
                                        <li class="size-item">M</li>
                                        <li class="size-item">L</li>
                                        <li class="size-item">XL</li>
                                    </ul>
                                </div>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal" class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Zesty Yellow Lemons</a>
                                <span class="price">$39.99</span>
                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class="swiper-slide">
                        <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-3.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-3.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-4.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-4.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="on-sale-wrap">
                                    <span class="on-sale-item">-25%</span>
                                </div>
                                <div class="variant-wrap size-list">
                                    <ul class="variant-box">
                                        <li class="size-item">S</li>
                                        <li class="size-item">M</li>
                                        <li class="size-item">L</li>
                                        <li class="size-item">XL</li>
                                    </ul>
                                </div>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Organic White Cauliflower</a>
                                <span class="price"><span class="old-price">$98.00</span>$129.99</span>
                            </div>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="swiper-slide">
                        <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0.2s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-5.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-5.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-6.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-6.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="on-sale-wrap">
                                    <span class="on-sale-item">-25%</span>
                                </div>
                                <div class="variant-wrap size-list">
                                    <ul class="variant-box">
                                        <li class="size-item">S</li>
                                        <li class="size-item">M</li>
                                        <li class="size-item">L</li>
                                        <li class="size-item">XL</li>
                                    </ul>
                                </div>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Juicy Cherry Burst</a>
                                <span class="price"><span class="old-price">$98.00</span>$219.99</span>
                            </div>
                        </div>
                    </div>
                    <!-- 4 -->
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.3s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-7.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-7.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-8.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-8.jpg') }}"
                                        alt="image-product" />
                                </a>

                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Sweet Strawberry Delight</a>
                                <span class="price">$79.99</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Deal of the day -->
    <!-- Collection -->
    <section class="flat-spacing pt-0">
        <div class="container">
            <div dir="ltr" class="swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile-sm="1.7"
                data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                data-pagination-md="1" data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="collection-position-2 style-5 style-7 hover-img wow fadeInUp" data-wow-delay="0s">
                            <a class="img-style">
                                <img class="lazyload"
                                    data-src="{{ asset('assets/images/collections/cls-organic-1.jpg') }}"
                                    src="{{ asset('assets/images/collections/cls-organic-1.jpg') }}" alt="banner-cls" />
                            </a>
                            <div class="content">
                                <span class="text-title text-white">Pure Organic-Vegan</span>
                                <h4 class="title">
                                    <a href="shop-collection.html" class="link text-white">Fresh Veggie Combos Start from
                                        $22</a>
                                </h4>
                                <div>
                                    <a href="shop-collection.html" class="btn-line style-white">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="collection-position-2 style-5 style-7 hover-img wow fadeInUp" data-wow-delay="0.1s">
                            <a class="img-style">
                                <img class="lazyload"
                                    data-src="{{ asset('assets/images/collections/cls-organic-2.jpg') }}"
                                    src="{{ asset('assets/images/collections/cls-organic-2.jpg') }}" alt="banner-cls" />
                            </a>
                            <div class="content">
                                <span class="text-title text-white">Top-quality nuts and grains.</span>
                                <h4 class="title">
                                    <a href="shop-collection.html" class="link text-white">Nut & Grain Combos Start from
                                        $22</a>
                                </h4>
                                <div>
                                    <a href="shop-collection.html" class="btn-line style-white">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="collection-position-2 style-5 style-7 hover-img wow fadeInUp" data-wow-delay="0.2s">
                            <a class="img-style">
                                <img class="lazyload"
                                    data-src="{{ asset('assets/images/collections/cls-organic-3.jpg') }}"
                                    src="{{ asset('assets/images/collections/cls-organic-3.jpg') }}" alt="banner-cls" />
                            </a>
                            <div class="content">
                                <span class="text-title text-white">Delicious and nutritious blends.</span>
                                <h4 class="title">
                                    <a href="shop-collection.html" class="link text-white">Smoothie Essentials Bundle
                                        Start from $22</a>
                                </h4>
                                <div>
                                    <a href="shop-collection.html" class="btn-line style-white">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sw-pagination-collection sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Collection -->
    <!-- Delivery -->
    <section class="">
        <div class="container">
            <div class="wg-free-delivery align-items-center tf-grid-layout md-col-2 gap-0">
                <div class="free-delivery-info text-center">
                    <h3 class="free-delivery-heading text-white">
                        Get Free Delivery 60 Days
                    </h3>
                    <p class="text text-white">
                        Shop now and take advantage of this special offer to get your
                        favorite items delivered to your doorstep at no extra cost.
                    </p>
                    <div class="tf-countdown style-2">
                        <div class="js-countdown" data-timer="1007500" data-labels="Days,Hours,Mins,Secs"></div>
                    </div>
                    <a href="shop-default-grid.html" class="tf-btn btn-fill btn-white"><span class="text">Buy at a
                            discount</span><i class="icon icon-arrowUpRight"></i></a>
                </div>
                <div class="free-delivery-img">
                    <img class="lazyload" data-src="{{ asset('assets/images/section/delivery-1.jpg') }}"
                        src="{{ asset('assets/images/section/delivery-1.jpg') }}" alt="delivery-img" />
                </div>
            </div>
        </div>
    </section>
    <!-- /Delivery -->
    <!-- Top picks -->
    <section class="flat-spacing">
        <div class="container">
            <div class="heading-section text-center wow fadeInUp">
                <h3 class="heading">Today's Top Picks</h3>
                <p class="subheading text-secondary">
                    Fresh styles just in! Elevate your look.
                </p>
            </div>
            <div dir="ltr" class="swiper tf-sw-latest" data-preview="5" data-tablet="3" data-mobile="2"
                data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-9.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-9.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-10.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-10.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="on-sale-wrap">
                                    <span class="on-sale-item">-25%</span>
                                </div>
                                <div class="marquee-product bg-main">
                                    <div class="marquee-wrapper">
                                        <div class="initial-child-container">
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="marquee-wrapper">
                                        <div class="initial-child-container">
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">
                                                    Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
                                        cart</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Tender Beef Cuts</a>
                                <span class="price"><span class="old-price">$98.00</span> $79.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-11.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-11.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-12.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-12.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="variant-wrap size-list">
                                    <ul class="variant-box">
                                        <li class="size-item">2 lb</li>
                                        <li class="size-item">5 lb</li>
                                        <li class="size-item">25 lb</li>
                                        <li class="size-item">50 lb</li>
                                    </ul>
                                </div>
                                <div class="variant-wrap countdown-wrap">
                                    <div class="variant-box">
                                        <div class="js-countdown" data-timer="1007500" data-labels="D :,H :,M :,S"></div>
                                    </div>
                                </div>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Fresh Blueberry Bliss
                                </a>
                                <span class="price"><span class="old-price">$98.00</span> $89.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.2s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-13.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-13.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-14.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-14.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
                                        cart</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Savory Beef Jerky</a>
                                <span class="price">$69.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.3s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-15.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-15.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-16.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-16.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
                                        cart</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Aromatic Fresh Ginger</a>
                                <span class="price">$69.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.4s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                        data-src="{{ asset('assets/images/products/organic/organic-17.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-17.jpg') }}"
                                        alt="image-product" />
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('assets/images/products/organic/organic-18.jpg') }}"
                                        src="{{ asset('assets/images/products/organic/organic-18.jpg') }}"
                                        alt="image-product" />
                                </a>
                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                        class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
                                        cart</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Crisp Green Lettuce</a>
                                <span class="price">$69.99</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Top picks -->
    <!-- Testimonial -->
    <section class="flat-spacing pt-0">
        <div class="container">
            <div class="heading-section text-center wow fadeInUp">
                <h3 class="heading">Customer Say!</h3>
                <p class="subheading">
                    Our customers adore our products, and we constantly aim to delight
                    them.
                </p>
            </div>
            <div dir="ltr" class="swiper tf-sw-testimonial" data-preview="3" data-tablet="2" data-mobile="1"
                data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-item hover-img style-row wow fadeInUp" data-wow-delay="0s">
                            <div class="img-style">
                                <img data-src="{{ asset('assets/images/testimonial/tes-14.jpg') }}"
                                    src="{{ asset('assets/images/testimonial/tes-14.jpg') }}" alt="img-testimonial" />
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip center">
                                    <span class="icon icon-eye"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                            <div class="content">
                                <div class="content-top">
                                    <div class="list-star-default">
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                    </div>
                                    <p class="text-secondary">
                                        "Fantastic shop! Great selection, fair prices, and
                                        friendly staff. Highly recommended. The quality of the
                                        products is exceptional, and the prices are very
                                        reasonable!"
                                    </p>
                                    <div class="box-author">
                                        <div class="text-title author">Sybil Sharp</div>
                                        <svg class="icon" width="20" height="21" viewBox="0 0 20 21"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_15758_14563)">
                                                <path d="M6.875 11.6255L8.75 13.5005L13.125 9.12549" stroke="#3DAB25"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M10 18.5005C14.1421 18.5005 17.5 15.1426 17.5 11.0005C17.5 6.85835 14.1421 3.50049 10 3.50049C5.85786 3.50049 2.5 6.85835 2.5 11.0005C2.5 15.1426 5.85786 18.5005 10 18.5005Z"
                                                    stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_15758_14563">
                                                    <rect width="20" height="20" fill="white"
                                                        transform="translate(0 0.684082)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="box-avt">
                                    <div class="avatar avt-60 round">
                                        <img src="{{ asset('assets/images/avatar/user-10.jpg') }}" alt="avt" />
                                    </div>
                                    <div class="box-price">
                                        <p class="text-title text-line-clamp-1">
                                            Sweet Strawberry Delight
                                        </p>
                                        <div class="text-button price">$60.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item hover-img style-row wow fadeInUp" data-wow-delay="0.1s">
                            <div class="img-style">
                                <img data-src="{{ asset('assets/images/testimonial/tes-15.jpg') }}"
                                    src="{{ asset('assets/images/testimonial/tes-15.jpg') }}" alt="img-testimonial" />
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip center">
                                    <span class="icon icon-eye"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                            <div class="content">
                                <div class="content-top">
                                    <div class="list-star-default">
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                    </div>
                                    <p class="text-secondary">
                                        "I absolutely love this shop! The products are
                                        high-quality and the customer service is excellent. I
                                        always leave with exactly what I need and a smile on my
                                        face."
                                    </p>
                                    <div class="box-author">
                                        <div class="text-title author">Mark G.</div>
                                        <svg class="icon" width="20" height="21" viewBox="0 0 20 21"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_15758_14563)">
                                                <path d="M6.875 11.6255L8.75 13.5005L13.125 9.12549" stroke="#3DAB25"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M10 18.5005C14.1421 18.5005 17.5 15.1426 17.5 11.0005C17.5 6.85835 14.1421 3.50049 10 3.50049C5.85786 3.50049 2.5 6.85835 2.5 11.0005C2.5 15.1426 5.85786 18.5005 10 18.5005Z"
                                                    stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_15758_14563">
                                                    <rect width="20" height="20" fill="white"
                                                        transform="translate(0 0.684082)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="box-avt">
                                    <div class="avatar avt-60 round">
                                        <img src="{{ asset('assets/images/avatar/user-11.jpg') }}" alt="avt" />
                                    </div>
                                    <div class="box-price">
                                        <p class="text-title text-line-clamp-1">
                                            Tender Beef Cuts
                                        </p>
                                        <div class="text-button price">$60.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item hover-img style-row wow fadeInUp" data-wow-delay="0.2s">
                            <div class="img-style">
                                <img data-src="{{ asset('assets/images/testimonial/tes-16.jpg') }}"
                                    src="{{ asset('assets/images/testimonial/tes-16.jpg') }}" alt="img-testimonial" />
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip center">
                                    <span class="icon icon-eye"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                            <div class="content">
                                <div class="content-top">
                                    <div class="list-star-default">
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                    </div>
                                    <p class="text-secondary">
                                        "Fantastic shop! Great selection, fair prices, and
                                        friendly staff. Highly recommended. The quality of the
                                        products is exceptional, and the prices are very
                                        reasonable!"
                                    </p>
                                    <div class="box-author">
                                        <div class="text-title author">Sybil Sharp</div>
                                        <svg class="icon" width="20" height="21" viewBox="0 0 20 21"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_15758_14563)">
                                                <path d="M6.875 11.6255L8.75 13.5005L13.125 9.12549" stroke="#3DAB25"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M10 18.5005C14.1421 18.5005 17.5 15.1426 17.5 11.0005C17.5 6.85835 14.1421 3.50049 10 3.50049C5.85786 3.50049 2.5 6.85835 2.5 11.0005C2.5 15.1426 5.85786 18.5005 10 18.5005Z"
                                                    stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_15758_14563">
                                                    <rect width="20" height="20" fill="white"
                                                        transform="translate(0 0.684082)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="box-avt">
                                    <div class="avatar avt-60 round">
                                        <img src="{{ asset('assets/images/avatar/user-12.jpg') }}" alt="avt" />
                                    </div>
                                    <div class="box-price">
                                        <p class="text-title text-line-clamp-1">
                                            Crisp Green Lettuce
                                        </p>
                                        <div class="text-button price">$60.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Testimonial -->
    <!-- Iconbox -->
    <section class="flat-spacing pt-0">
        <div class="container">
            <div dir="ltr" class="swiper tf-sw-iconbox" data-preview="4" data-tablet="3" data-mobile-sm="2"
                data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <div class="icon-box">
                                <span class="icon icon-return"></span>
                            </div>
                            <div class="content text-center">
                                <h6>14-Day Returns</h6>
                                <p class="text-secondary">
                                    Risk-free shopping with easy returns.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <div class="icon-box">
                                <span class="icon icon-shipping"></span>
                            </div>
                            <div class="content text-center">
                                <h6>Free Shipping</h6>
                                <p class="text-secondary">
                                    No extra costs, just the price you see.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <div class="icon-box">
                                <span class="icon icon-headset"></span>
                            </div>
                            <div class="content text-center">
                                <h6>24/7 Support</h6>
                                <p class="text-secondary">
                                    24/7 support, always here just for you
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tf-icon-box">
                            <div class="icon-box">
                                <span class="icon icon-sealCheck"></span>
                            </div>
                            <div class="content text-center">
                                <h6>Member Discounts</h6>
                                <p class="text-secondary">
                                    Special prices for our loyal customers.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sw-pagination-iconbox sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Iconbox -->
    <!-- Gallery shop gram -->
    <section>
        <div class="container-full2">
            <div dir="ltr" class="swiper tf-sw-shop-gallery" data-preview="6" data-tablet="3" data-mobile="2"
                data-space-lg="10" data-space-md="10" data-space="8" data-pagination="2" data-pagination-md="3"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay=".1s">
                            <div class="img-style">
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/gallery/gallery-13.jpg') }}"
                                    src="{{ asset('assets/images/gallery/gallery-13.jpg') }}" alt="image-gallery" />
                            </div>
                            <a href="product-detail.html" class="box-icon hover-tooltip"><span
                                    class="icon icon-eye"></span>
                                <span class="tooltip">View Product</span></a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay=".2s">
                            <div class="img-style">
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/gallery/gallery-14.jpg') }}"
                                    src="{{ asset('assets/images/gallery/gallery-14.jpg') }}" alt="image-gallery" />
                            </div>
                            <a href="product-detail.html" class="box-icon hover-tooltip"><span
                                    class="icon icon-eye"></span>
                                <span class="tooltip">View Product</span></a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay=".3s">
                            <div class="img-style">
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/gallery/gallery-15.jpg') }}"
                                    src="{{ asset('assets/images/gallery/gallery-15.jpg') }}" alt="image-gallery" />
                            </div>
                            <a href="product-detail.html" class="box-icon hover-tooltip"><span
                                    class="icon icon-eye"></span>
                                <span class="tooltip">View Product</span></a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay=".4s">
                            <div class="img-style">
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/gallery/gallery-16.jpg') }}"
                                    src="{{ asset('assets/images/gallery/gallery-16.jpg') }}" alt="image-gallery" />
                            </div>
                            <a href="product-detail.html" class="box-icon hover-tooltip"><span
                                    class="icon icon-eye"></span>
                                <span class="tooltip">View Product</span></a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay=".5s">
                            <div class="img-style">
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/gallery/gallery-17.jpg') }}"
                                    src="{{ asset('assets/images/gallery/gallery-17.jpg') }}" alt="image-gallery" />
                            </div>
                            <a href="product-detail.html" class="box-icon hover-tooltip"><span
                                    class="icon icon-eye"></span>
                                <span class="tooltip">View Product</span></a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay=".6s">
                            <div class="img-style">
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/gallery/gallery-18.jpg') }}"
                                    src="{{ asset('assets/images/gallery/gallery-18.jpg') }}" alt="image-gallery" />
                            </div>
                            <a href="product-detail.html" class="box-icon hover-tooltip"><span
                                    class="icon icon-eye"></span>
                                <span class="tooltip">View Product</span></a>
                        </div>
                    </div>
                </div>
                <div class="sw-pagination-gallery sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Gallery shop gram -->
@endsection
