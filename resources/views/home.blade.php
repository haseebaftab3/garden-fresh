@extends('layouts.master')
@section('title', 'Garden Fresh | Fresh Organic Produce Delivered to Your Doorstep')
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
                        @include('partials.product-list', ['products' => $products])
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
                                <img class="lazyload" data-src="{{ asset('assets/images/collections/cls-organic-1.jpg') }}"
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
                                <img class="lazyload" data-src="{{ asset('assets/images/collections/cls-organic-2.jpg') }}"
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

@endsection
