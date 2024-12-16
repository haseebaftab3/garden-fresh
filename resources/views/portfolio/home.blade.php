@extends('layout.master')
@section('title', 'The Pets Medic | Home')
@section('content')

    <!-- banner-area -->
    <section class="banner__area-four">
        <div class="container">
            <div class="row gutter-20">
                <div class="col-lg-8">
                    <div class="swiper slider__active">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slider__single">
                                <div class="slider__bg" data-background="assets/img/banner/h3_banner_slide01.jpg"></div>
                                <div class="slider__content">
                                    <h1 class="title">Pet Healthy Food <br> & Accessories</h1>
                                    <h4 class="sub-title">Delicious Food Make With Love</h4>
                                    <a href="product.html" class="btn">Shop Now <img
                                            src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                    <div class="discount__shape">
                                        <img src="assets/img/banner/sale.svg" alt="" class="injectable">
                                        <h2 class="title">30% <span>Flat Sale!</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide slider__single">
                                <div class="slider__bg" data-background="assets/img/banner/h3_banner_slide01.jpg"></div>
                                <div class="slider__content">
                                    <h1 class="title">Pet Healthy Food <br> & Accessories</h1>
                                    <h4 class="sub-title">Delicious Food Make With Love</h4>
                                    <a href="product.html" class="btn">Shop Now <img
                                            src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                    <div class="discount__shape">
                                        <img src="assets/img/banner/sale.svg" alt="" class="injectable">
                                        <h2 class="title">50% <span>Flat Sale!</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="banner__post-item-wrap">
                        <div class="banner__post-item shine-animate-item">
                            <div class="banner__post-thumb shine-animate">
                                <img src="assets/img/banner/h3_banner_img01.jpg" alt="img">
                            </div>
                            <div class="banner__post-content">
                                <h2 class="title">The Best Quality House <span>
                                        <strong>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 66 42" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M15.0952 2.41842C18.5987 1.09323 22.1904 0.607768 25.8799 0.378947C29.7051 0.141712 49.0312 0.123062 52.6628 1.05552C57.0727 2.1878 62.9146 2.42124 64.8207 6.374C66.7564 10.3881 62.3819 15.0531 61.5901 19.5685C60.9204 23.3881 62.1249 27.2823 60.5219 30.8902C58.8022 34.7608 56.2758 38.8903 52.2619 40.5639C48.2685 42.2289 28.5024 39.5356 24.2541 39.5109C20.1671 39.4871 16.0887 41.3434 12.1742 40.4213C7.68366 39.3634 2.26479 38.0084 0.524582 33.9207C-1.24656 29.7604 3.05097 25.1169 3.70387 20.525C4.27715 16.493 1.88863 12.1607 4.12361 8.60819C6.35856 5.05573 11.107 3.92693 15.0952 2.41842Z"
                                                    fill="#FFAD0E" />
                                            </svg>
                                            15%
                                        </strong>
                                        Off For Your Pet</span>
                                </h2>
                            </div>
                        </div>
                        <div class="banner__post-item-two shine-animate-item">
                            <div class="banner__post-thumb shine-animate">
                                <img src="assets/img/banner/h3_banner_img02.jpg" alt="img">
                            </div>
                            <div class="banner__post-content-two">
                                <h2 class="title">For Your <br> Pet Busket</h2>
                                <a href="product.html" class="btn">Shop Now <img src="assets/img/icon/right_arrow.svg"
                                        alt="" class="injectable"></a>
                            </div>
                            <div class="discount__shape-two">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 74" fill="none"
                                    preserveAspectRatio="none">
                                    <path
                                        d="M150 0H0C7.59494 63.3462 56.3291 75.6203 79.7468 73.8391C135.57 69.9528 149.842 22.9938 150 0Z"
                                        fill="#FF3489" />
                                </svg>
                                <h2 class="title">12% <span>Off</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-area-end -->

    <!-- features-area -->
    <section class="features__area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icon/features_icon01.svg" alt="" class="injectable">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Free Shipping</h4>
                            <p>for orders over $200</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icon/features_icon02.svg" alt="" class="injectable">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Money Guarantee</h4>
                            <p>30 days for an exchange</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icon/features_icon03.svg" alt="" class="injectable">
                        </div>
                        <div class="features__content">
                            <h4 class="title">100% Return Policy</h4>
                            <p>Any Time Return Product</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icon/features_icon04.svg" alt="" class="injectable">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Best Deal Offer</h4>
                            <p>Grab Your Gear and Go</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features-area-end -->

    <!-- divider-area -->
    <div class="divider-area">
        <div class="container">
            <div class="divider-wrap"></div>
        </div>
    </div>
    <!-- divider-area-end -->

    <!-- product-area -->
    <section class="product__area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="section__title-two mb-25">
                        <h2 class="title">Featured Products <img src="assets/img/images/title_shape.svg" alt=""
                                class="injectable"></h2>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product__tab-wrap mb-25">
                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                    data-bs-target="#all-tab-pane" type="button" role="tab"
                                    aria-controls="all-tab-pane" aria-selected="true">All</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="best-tab" data-bs-toggle="tab"
                                    data-bs-target="#best-tab-pane" type="button" role="tab"
                                    aria-controls="best-tab-pane" aria-selected="false">Best Seller</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sale-tab" data-bs-toggle="tab"
                                    data-bs-target="#sale-tab-pane" type="button" role="tab"
                                    aria-controls="sale-tab-pane" aria-selected="false">Sale</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content product__item-wrap" id="productTabContent">
                        <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel"
                            aria-labelledby="all-tab" tabindex="0">
                            <div class="swiper product-active">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img01.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap">
                                                    <span>New</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Dog Harness-Neoprene
                                                        Comfort Liner-Orange and ...</a></h4>
                                                <h3 class="price">$12.00 <del>$25.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img02.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Arm & Hammer Super
                                                        Deodori zing Dog Shampoo, Pet Wash</a></h4>
                                                <h3 class="price">$20.00 <del>$30.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img03.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Milk-Bone Brushing Chews
                                                        Daily Dental Dog Treats ...</a></h4>
                                                <h3 class="price">$36.00 <del>$56.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img04.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Two Door Top Load
                                                        Plastic Kennel & Pet Carrier, Blue 19”</a></h4>
                                                <h3 class="price">$18.00 <del>$33.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img05.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap">
                                                    <span>New</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">The Kitten House with
                                                        Mat Sleeping Bed House</a></h4>
                                                <h3 class="price">$19.00 <del>$28.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img04.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Two Door Top Load
                                                        Plastic Kennel & Pet Carrier, Blue 19”</a></h4>
                                                <h3 class="price">$18.00 <del>$33.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__nav-wrap">
                                <button class="product-button-prev"><i class="flaticon-left-chevron"></i></button>
                                <button class="product-button-next"><i class="flaticon-right-arrow-angle"></i></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="best-tab-pane" role="tabpanel" aria-labelledby="best-tab"
                            tabindex="0">
                            <div class="swiper product-active">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img01.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap">
                                                    <span>New</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Dog Harness-Neoprene
                                                        Comfort Liner-Orange and ...</a></h4>
                                                <h3 class="price">$12.00 <del>$25.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img02.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Arm & Hammer Super
                                                        Deodori zing Dog Shampoo, Pet Wash</a></h4>
                                                <h3 class="price">$20.00 <del>$30.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img03.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Milk-Bone Brushing Chews
                                                        Daily Dental Dog Treats ...</a></h4>
                                                <h3 class="price">$36.00 <del>$56.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img04.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Two Door Top Load
                                                        Plastic Kennel & Pet Carrier, Blue 19”</a></h4>
                                                <h3 class="price">$18.00 <del>$33.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img05.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap">
                                                    <span>New</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">The Kitten House with
                                                        Mat Sleeping Bed House</a></h4>
                                                <h3 class="price">$19.00 <del>$28.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img04.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Two Door Top Load
                                                        Plastic Kennel & Pet Carrier, Blue 19”</a></h4>
                                                <h3 class="price">$18.00 <del>$33.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__nav-wrap">
                                <button class="product-button-prev"><i class="flaticon-left-chevron"></i></button>
                                <button class="product-button-next"><i class="flaticon-right-arrow-angle"></i></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sale-tab-pane" role="tabpanel" aria-labelledby="sale-tab"
                            tabindex="0">
                            <div class="swiper product-active">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img01.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap">
                                                    <span>New</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Dog Harness-Neoprene
                                                        Comfort Liner-Orange and ...</a></h4>
                                                <h3 class="price">$12.00 <del>$25.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img02.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Arm & Hammer Super
                                                        Deodori zing Dog Shampoo, Pet Wash</a></h4>
                                                <h3 class="price">$20.00 <del>$30.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img03.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Milk-Bone Brushing Chews
                                                        Daily Dental Dog Treats ...</a></h4>
                                                <h3 class="price">$36.00 <del>$56.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img04.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Two Door Top Load
                                                        Plastic Kennel & Pet Carrier, Blue 19”</a></h4>
                                                <h3 class="price">$18.00 <del>$33.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img05.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap">
                                                    <span>New</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">The Kitten House with
                                                        Mat Sleeping Bed House</a></h4>
                                                <h3 class="price">$19.00 <del>$28.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product__item">
                                            <div class="product__thumb">
                                                <a href="product-details.html"><img
                                                        src="assets/img/products/products_img04.jpg" alt="img"></a>
                                                <div class="product__action">
                                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                                </div>
                                                <div class="sale-wrap sale-wrap-two">
                                                    <span>Sale!</span>
                                                </div>
                                                <div class="product__add-cart">
                                                    <a href="product-details.html" class="btn"><i
                                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <div class="product__reviews">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span>(2 Reviews)</span>
                                                </div>
                                                <h4 class="title"><a href="product-details.html">Two Door Top Load
                                                        Plastic Kennel & Pet Carrier, Blue 19”</a></h4>
                                                <h3 class="price">$18.00 <del>$33.00</del></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__nav-wrap">
                                <button class="product-button-prev"><i class="flaticon-left-chevron"></i></button>
                                <button class="product-button-next"><i class="flaticon-right-arrow-angle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-area-end -->

    <!-- category-area -->
    <section class="category__area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="section__title-two mb-30">
                        <h2 class="title">Shop by Category
                            <img src="assets/img/images/title_shape.svg" alt="" class="injectable">
                        </h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="view-all-btn">
                        <a href="{{ route('categories.index') }}">See All Categories
                            <i class="flaticon-right-arrow-angle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-lg-6 row-cols-md-4 row-cols-sm-3 justify-content-center">
                @foreach ($categories_section as $category)
                    <div class="col">
                        <div class="category__item">
                            <a href="{{ route('category.show', $category->slug) }}">
                                <img src="{{ isset($category->image) ? asset('storage/' . $category->image) : 'https://www.ecommerce-nation.com/wp-content/uploads/2017/08/How-to-Give-Your-E-Commerce-No-Results-Page-the-Power-to-Sell.png' }}"
                                    alt="{{ $category->name }}">

                                <span class="name">{{ $category->name }}</span>
                                <strong>{{ count($category->children) }} Items</strong>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- category-area-end -->


    <!-- ad-banner-area -->
    <div class="ad-banner-area pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="ad-banner-img">
                        <a href="#">
                            <img src="assets/img/images/advertisement.jpg" alt="img">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ad-banner-area-end -->

    <!-- product-area-two -->
    <section class="product__area-two">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="section__title-two mb-20">
                        <h2 class="title">Hot Sale Products <img src="assets/img/images/title_shape.svg" alt=""
                                class="injectable"></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="coming-time-wrap">
                        <div class="coming-time" data-countdown="2024/4/30"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container custom-container-two">
            <div class="product__item-wrap-two">
                <div
                    class="row gutter-20 row-cols-1 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 justify-content-center">
                    <div class="col">
                        <div class="product__item">
                            <div class="product__thumb">
                                <a href="product-details.html"><img src="assets/img/products/products_img06.jpg"
                                        alt="img"></a>
                                <div class="product__action">
                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                </div>
                                <div class="sale-wrap sale-wrap-two">
                                    <span>Sale!</span>
                                </div>
                                <div class="product__add-cart">
                                    <a href="product-details.html" class="btn"><i
                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                </div>
                            </div>
                            <div class="product__content">
                                <div class="product__reviews">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>(2 Reviews)</span>
                                </div>
                                <h4 class="title"><a href="product-details.html">Dog Puzzle Toys, Squeaky Treat
                                        Dispensing Dog</a></h4>
                                <h3 class="price">$18.00 <del>$33.00</del></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product__item">
                            <div class="product__thumb">
                                <a href="product-details.html"><img src="assets/img/products/products_img07.jpg"
                                        alt="img"></a>
                                <div class="product__action">
                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                </div>
                                <div class="sale-wrap sale-wrap-two">
                                    <span>Sale!</span>
                                </div>
                                <div class="product__add-cart">
                                    <a href="product-details.html" class="btn"><i
                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                </div>
                            </div>
                            <div class="product__content">
                                <div class="product__reviews">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>(2 Reviews)</span>
                                </div>
                                <h4 class="title"><a href="product-details.html">Zesty Paws Calming Puppy Bites Stress
                                        Relief for Dogs, 60 Count</a></h4>
                                <h3 class="price">$16.00 <del>$50.00</del></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product__item">
                            <div class="product__thumb">
                                <a href="product-details.html"><img src="assets/img/products/products_img08.jpg"
                                        alt="img"></a>
                                <div class="product__action">
                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                </div>
                                <div class="sale-wrap sale-wrap-two">
                                    <span>Sale!</span>
                                </div>
                                <div class="product__add-cart">
                                    <a href="product-details.html" class="btn"><i
                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                </div>
                            </div>
                            <div class="product__content">
                                <div class="product__reviews">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>(2 Reviews)</span>
                                </div>
                                <h4 class="title"><a href="product-details.html">Hartz Groomer's Best Extra Gentle Puppy
                                        Shampoo, 18oz.</a></h4>
                                <h3 class="price">$30.00 <del>$88.00</del></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product__item">
                            <div class="product__thumb">
                                <a href="product-details.html"><img src="assets/img/products/products_img09.jpg"
                                        alt="img"></a>
                                <div class="product__action">
                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                </div>
                                <div class="sale-wrap sale-wrap-two">
                                    <span>Sale!</span>
                                </div>
                                <div class="product__add-cart">
                                    <a href="product-details.html" class="btn"><i
                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                </div>
                            </div>
                            <div class="product__content">
                                <div class="product__reviews">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>(2 Reviews)</span>
                                </div>
                                <h4 class="title"><a href="product-details.html">The Kitten House with Mat Sleeping Bed
                                        House</a></h4>
                                <h3 class="price">$22.00 <del>$59.00</del></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product__item">
                            <div class="product__thumb">
                                <a href="product-details.html"><img src="assets/img/products/products_img10.jpg"
                                        alt="img"></a>
                                <div class="product__action">
                                    <a href="product-details.html"><i class="flaticon-love"></i></a>
                                    <a href="product-details.html"><i class="flaticon-loupe"></i></a>
                                    <a href="product-details.html"><i class="flaticon-exchange"></i></a>
                                </div>
                                <div class="sale-wrap sale-wrap-two">
                                    <span>Sale!</span>
                                </div>
                                <div class="product__add-cart">
                                    <a href="product-details.html" class="btn"><i
                                            class="flaticon-shopping-bag"></i>Add To Cart</a>
                                </div>
                            </div>
                            <div class="product__content">
                                <div class="product__reviews">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>(2 Reviews)</span>
                                </div>
                                <h4 class="title"><a href="product-details.html">Dog Harness-Neoprene
                                        Comfort Liner-Orange and Comfort</a></h4>
                                <h3 class="price">$11.00 <del>$48.00</del></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__shape-wrap">
            <img src="assets/img/products/products_shape01.png" alt="shape" class="ribbonRotate">
            <img src="assets/img/products/products_shape02.png" alt="shape" data-aos="fade-up-right"
                data-aos-delay="400">
        </div>
    </section>
    <!-- product-area-two-end -->

    <!-- features-area -->
    <section class="features__area-two">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="features__item-two">
                        <div class="features__thumb">
                            <img src="assets/img/images/features_img01.jpg" alt="img">
                        </div>
                        <div class="features__content-two">
                            <h2 class="title">30% <span>Sale!</span></h2>
                            <strong>Free Shipping</strong>
                            <a href="product.html" class="btn shop-btn">Shop Now <img
                                    src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="features__item-two">
                        <div class="features__thumb">
                            <img src="assets/img/images/features_img02.jpg" alt="img">
                        </div>
                        <div class="features__content-two features__content-three">
                            <h2 class="title">Best Premium</h2>
                            <strong>Cat Food</strong>
                            <a href="product.html" class="btn shop-btn">Shop Now <img
                                    src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features-area-end -->

    <!-- product-area -->
    <section class="product__area-three">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__inner-wrap">
                        <div class="row align-items-center">
                            <div class="col-sm-8">
                                <div class="section__title-two mb-20">
                                    <h2 class="title">Hot Sale Products <img src="assets/img/images/title_shape.svg"
                                            alt="" class="injectable"></h2>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="view-all-btn">
                                    <a href="product.html">See All <i class="flaticon-right-arrow-angle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="product__item product__item-two">
                                    <div class="product__thumb product__thumb-two">
                                        <a href="product-details.html"><img src="assets/img/products/h_products_img01.jpg"
                                                alt="img"></a>
                                        <div class="sale-wrap">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <div class="product__content">
                                        <div class="product__reviews">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span>(2 Reviews)</span>
                                        </div>
                                        <h4 class="title"><a href="product-details.html">IAMS Minichunks Chicken & Whole
                                                Grains Dry Dog Food fo</a></h4>
                                        <h3 class="price">$11.00 <del>$48.00</del></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="product__item-three">
                                    <div class="product__thumb-three">
                                        <a href="product-details.html"><img
                                                src="assets/img/products/latest_products_img01.jpg" alt="img"></a>
                                    </div>
                                    <div class="product__content product__content-three">
                                        <h2 class="title"><a href="product-details.html">TrustyPup Dragon Squeaky Plush
                                                Chew ..</a></h2>
                                        <h3 class="price">$47.00 <del>$82.00</del></h3>
                                    </div>
                                </div>
                                <div class="product__item-three">
                                    <div class="product__thumb-three">
                                        <a href="product-details.html"><img
                                                src="assets/img/products/latest_products_img02.jpg" alt="img"></a>
                                    </div>
                                    <div class="product__content product__content-three">
                                        <h2 class="title"><a href="product-details.html">Vital Pet Life Salmon Oil for
                                                Dogs and Cat</a></h2>
                                        <h3 class="price">$12.00</h3>
                                    </div>
                                </div>
                                <div class="product__item-three">
                                    <div class="product__thumb-three">
                                        <a href="product-details.html"><img
                                                src="assets/img/products/latest_products_img03.jpg" alt="img"></a>
                                    </div>
                                    <div class="product__content product__content-three">
                                        <h2 class="title"><a href="product-details.html">Dog HarnesNeoprene
                                                Comfort Liner...</a></h2>
                                        <h3 class="price">$30.00 <del>$48.00</del></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__inner-wrap">
                        <div class="row align-items-center">
                            <div class="col-sm-8">
                                <div class="section__title-two mb-20">
                                    <h2 class="title">Latest Products <img src="assets/img/images/title_shape.svg"
                                            alt="" class="injectable"></h2>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="view-all-btn">
                                    <a href="product.html">See All <i class="flaticon-right-arrow-angle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="product__item product__item-two">
                                    <div class="product__thumb product__thumb-two">
                                        <a href="product-details.html"><img
                                                src="assets/img/products/h_products_img02.jpg" alt="img"></a>
                                        <div class="sale-wrap sale-wrap-two">
                                            <span>Sale!</span>
                                        </div>
                                    </div>
                                    <div class="product__content">
                                        <div class="product__reviews">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span>(2 Reviews)</span>
                                        </div>
                                        <h4 class="title"><a href="product-details.html">Pro-Sense Multivitamin, 90ct
                                                For your Lovely Dog</a></h4>
                                        <h3 class="price">$15.00 <del>$28.00</del></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="product__item-three">
                                    <div class="product__thumb-three">
                                        <a href="product-details.html"><img
                                                src="assets/img/products/latest_products_img04.jpg" alt="img"></a>
                                    </div>
                                    <div class="product__content product__content-three">
                                        <h2 class="title"><a href="product-details.html">Pet Grooming Glove for Dogs &
                                                Cats ...</a></h2>
                                        <h3 class="price">$12.00 <del>$20.00</del></h3>
                                    </div>
                                </div>
                                <div class="product__item-three">
                                    <div class="product__thumb-three">
                                        <a href="product-details.html"><img
                                                src="assets/img/products/latest_products_img05.jpg" alt="img"></a>
                                    </div>
                                    <div class="product__content product__content-three">
                                        <h2 class="title"><a href="product-details.html">Beloved Pets For Playing
                                                Toy</a></h2>
                                        <h3 class="price">$25.00</h3>
                                    </div>
                                </div>
                                <div class="product__item-three">
                                    <div class="product__thumb-three">
                                        <a href="product-details.html"><img
                                                src="assets/img/products/latest_products_img06.jpg" alt="img"></a>
                                    </div>
                                    <div class="product__content product__content-three">
                                        <h2 class="title"><a href="product-details.html">Zesty Paws Calming Puppy Bites
                                                ...</a></h2>
                                        <h3 class="price">$45.00 <del>$80.00</del></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-area-end -->

    <!-- testimonial-area -->
    <section class="testimonial__area-four">
        <div class="container">
            <div class="testimonial__item-wrap-four">
                <div class="swiper testimonial-active-two">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial__item-four">
                                <div class="testimonial__icon-four">
                                    <img src="assets/img/icon/quote02.svg" alt="" class="injectable">
                                </div>
                                <div class="testimonial__content-four">
                                    <h2 class="title">Pet Health Important</h2>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>“ Duis aute irure dolor in repreerit in voluptate velitesse We understand that your
                                        furry aute irure dolor in repreerit in voluptate just about the best thing you can
                                        do. dolor in repreerit in voluptate understand that you ”</p>
                                </div>
                                <div class="testimonial__author-two testimonial__author-four">
                                    <div class="testimonial__author-thumb">
                                        <img src="assets/img/images/testi_author01.png" alt="">
                                    </div>
                                    <div class="testimonial__author-content">
                                        <h4 class="title">Uraney Jacke</h4>
                                        <span>Business Study</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial__item-four">
                                <div class="testimonial__icon-four">
                                    <img src="assets/img/icon/quote02.svg" alt="" class="injectable">
                                </div>
                                <div class="testimonial__content-four">
                                    <h2 class="title">Pet Health Important</h2>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>“ Duis aute irure dolor in repreerit in voluptate velitesse We understand that your
                                        furry aute irure dolor in repreerit in voluptate just about the best thing you can
                                        do. dolor in repreerit in voluptate understand that you ”</p>
                                </div>
                                <div class="testimonial__author-two testimonial__author-four">
                                    <div class="testimonial__author-thumb">
                                        <img src="assets/img/images/testi_author01.png" alt="">
                                    </div>
                                    <div class="testimonial__author-content">
                                        <h4 class="title">Uraney Jacke</h4>
                                        <span>Business Study</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial__nav-wrap">
                    <button class="testimonial-button-prev"><img src="assets/img/icon/right_arrow03.svg"
                            alt="" class="injectable"></button>
                    <button class="testimonial-button-next"><img src="assets/img/icon/right_arrow03.svg"
                            alt="" class="injectable"></button>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-area-end -->

    <!-- brand-area -->
    <div class="brand__area-four">
        <div class="container">
            <div class="brand__title">
                <h5 class="title">Trusted By The World’s Best</h5>
            </div>
            <div class="swiper brand-active">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img01.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img02.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img03.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img04.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img05.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img06.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img07.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item brand__item-two">
                            <img src="assets/img/brand/h2_brand_img03.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand-area-end -->

    <!-- blog-post-area -->
    <section class="blog__post-area-four">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="section__title-two mb-20">
                        <h2 class="title">Latest News & Updates <img src="assets/img/images/title_shape.svg"
                                alt="" class="injectable">
                        </h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="view-all-btn">
                        <a href="blog.html">See All <i class="flaticon-right-arrow-angle"></i></a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="blog__post-item-four shine-animate-item">
                        <div class="blog__post-thumb-four shine-animate">
                            <a href="blog-details.html"><img src="assets/img/blog/h4_blog_post01.jpg"
                                    alt="img"></a>
                            <ul class="list-wrap blog__post-tag blog__post-tag-three">
                                <li><a href="blog.html">Pet</a></li>
                            </ul>
                        </div>
                        <div class="blog__post-content-four">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>25th Aug</li>
                                    <li><i class="flaticon-user"></i>by <a href="blog-details.html">admin</a></li>
                                </ul>
                            </div>
                            <h2 class="title"><a href="blog-details.html">10 Things You Didn’t Know about The
                                    Shinese</a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="blog__post-item-four shine-animate-item">
                        <div class="blog__post-thumb-four shine-animate">
                            <a href="blog-details.html"><img src="assets/img/blog/h4_blog_post02.jpg"
                                    alt="img"></a>
                            <ul class="list-wrap blog__post-tag blog__post-tag-three">
                                <li><a href="blog.html">Care</a></li>
                            </ul>
                        </div>
                        <div class="blog__post-content-four">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>25th Aug</li>
                                    <li><i class="flaticon-user"></i>by <a href="blog-details.html">admin</a></li>
                                </ul>
                            </div>
                            <h2 class="title"><a href="blog-details.html">A Complete Price Guide for the Shar Pei
                                    Breed</a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="blog__post-item-four shine-animate-item">
                        <div class="blog__post-thumb-four shine-animate">
                            <a href="blog-details.html"><img src="assets/img/blog/h4_blog_post03.jpg"
                                    alt="img"></a>
                            <ul class="list-wrap blog__post-tag blog__post-tag-three">
                                <li><a href="blog.html">Pet Health</a></li>
                            </ul>
                        </div>
                        <div class="blog__post-content-four">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>25th Aug</li>
                                    <li><i class="flaticon-user"></i>by <a href="blog-details.html">admin</a></li>
                                </ul>
                            </div>
                            <h2 class="title"><a href="blog-details.html">Comparing the Blue vs. Lilac French
                                    Bulldog</a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="blog__post-item-four shine-animate-item">
                        <div class="blog__post-thumb-four shine-animate">
                            <a href="blog-details.html"><img src="assets/img/blog/h4_blog_post04.jpg"
                                    alt="img"></a>
                            <ul class="list-wrap blog__post-tag blog__post-tag-three">
                                <li><a href="blog.html">Cat</a></li>
                            </ul>
                        </div>
                        <div class="blog__post-content-four">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>25th Aug</li>
                                    <li><i class="flaticon-user"></i>by <a href="blog-details.html">admin</a></li>
                                </ul>
                            </div>
                            <h2 class="title"><a href="blog-details.html">Five Things You Didn’t Know about the Red</a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog__shape-wrap-four">
            <img src="assets/img/blog/h4_blog_shape01.png" alt="img" data-aos="fade-down-left"
                data-aos-delay="400">
            <img src="assets/img/blog/h4_blog_shape02.png" alt="img" data-aos="fade-up-right"
                data-aos-delay="400">
        </div>
    </section>
    <!-- blog-post-area-end -->
@endsection
