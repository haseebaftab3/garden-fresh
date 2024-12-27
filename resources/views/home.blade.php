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
                    <img class="lazyload" data-src="{{ asset('assets/images/home/3.jpeg') }}"
                        src="{{ asset('assets/images/home/3.jpeg') }}" alt="delivery-img" />
                </div>
            </div>
        </div>
    </section>
    <!-- /Delivery -->
    <!-- Iconbox -->
    <section class="flat-spacing">
        <div class="container">
            <div dir="ltr" class="swiper tf-sw-iconbox" data-preview="4" data-tablet="3" data-mobile-sm="2"
                data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
                <div class="swiper-wrapper">
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

                            <img src="{{ asset('assets/images/icons/2.png') }}"
                                style="
                                height: 42px;
                                margin: 0;
                                padding: 0;
                            "
                                alt="">
                            <div class="content text-center">
                                <h6>Export Quality</h6>
                                <p class="text-secondary">
                                    Premium products with global standards.
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
                                    Always here, ready to assist you.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tf-icon-box">

                            <img src="{{ asset('assets/images/icons/1.png') }}"
                                style="
                                height: 42px;
                                margin: 0;
                                padding: 0;
                            "
                                alt="">

                            <div class="content text-center">
                                <h6>Organic</h6>
                                <p class="text-secondary">
                                    Sustainable and eco-friendly products.
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
    <section class="mb-5">
        <div class="container-full2">
            <div dir="ltr" class="swiper tf-sw-shop-gallery" data-preview="6" data-tablet="3" data-mobile="2"
                data-space-lg="10" data-space-md="10" data-space="8" data-pagination="2" data-pagination-md="3"
                data-pagination-lg="1">
                <div class="swiper-wrapper" id="instagram-gallery">

                </div>
                <div class="sw-pagination-gallery sw-dots type-circle justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Gallery shop gram -->
    <script>
        async function fetchInstagramImages() {
            const accessToken =
                'IGAAh58XVDuZClBZAE1LRF9XWFdhUjdVYVRSWmVQX05oYVRURFc5YXlEWWhmVldXT3RjdndFOHVqdDM3VDYwRDdNTzlFclA3bWlVV3RZAWVZAfekM3SC1jczZAtNWxMcnd3Q3hCMDdMQXBRRmtVaG11dTdOcU0wWVRFOWVFSlBNQ2dsQQZDZD'; // Replace with your Instagram Access Token
            const endpoint =
                `https://graph.instagram.com/me/media?fields=id,caption,media_url,permalink&access_token=${accessToken}&limit=20`;

            try {
                const response = await fetch(endpoint);
                const data = await response.json();

                if (data.data) {
                    const gallery = document.getElementById('instagram-gallery');
                    data.data.forEach((item, index) => {
                        const delay = (index + 1) * 0.1; // Incremental delay for animation
                        const slide = document.createElement('div');
                        slide.className = 'swiper-slide';
                        slide.innerHTML = `
                            <div class="gallery-item hover-overlay hover-img wow fadeInUp" data-wow-delay="${delay}s">
                                <div class="img-style">
                                    <img class="lazyload img-hover" data-src="${item.media_url}" src="${item.media_url}" alt="Instagram Image" />
                                </div>
                                <a href="${item.permalink}" target="_blank" class="box-icon hover-tooltip">
                                    <span class="icon icon-eye"></span>
                                    <span class="tooltip">View Post</span>
                                </a>
                            </div>
                        `;
                        gallery.appendChild(slide);
                    });
                }
            } catch (error) {
                console.error('Error fetching Instagram images:', error);
            }
        }

        fetchInstagramImages();
    </script>


@endsection
