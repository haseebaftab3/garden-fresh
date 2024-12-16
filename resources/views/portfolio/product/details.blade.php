@extends('layout.master')
@section('title', 'The Pets Medic | Home')
@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area fix">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="breadcrumb__content">
                        <h3 class="title">Products Details</h3>
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

    <!-- product-details-area -->
    <section class="product__details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details-images-wrap">
                        <!-- Main Image Display -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active" id="itemCover-tab-pane" role="tabpanel"
                                aria-labelledby="itemCover-tab" tabindex="0">
                                <a href="{{ Storage::url($product->cover_image) }}" class="popup-image">
                                    <img src="{{ Storage::url($product->cover_image) }}" alt="{{ $product->title }}">
                                </a>
                            </div>

                            @foreach ($product->gallery as $index => $image)
                                <div class="tab-pane" id="item{{ $index }}-tab-pane" role="tabpanel"
                                    aria-labelledby="item{{ $index }}-tab" tabindex="0">
                                    <a href="{{ Storage::url($image->image_path) }}" class="popup-image">
                                        <img src="{{ Storage::url($image->image_url) }}" alt="{{ $product->title }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Thumbnail Navigation -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <!-- Cover Image as First Thumbnail -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="itemCover-tab" data-bs-toggle="tab"
                                    data-bs-target="#itemCover-tab-pane" type="button" role="tab"
                                    aria-controls="itemCover-tab-pane" aria-selected="true">
                                    <img src="{{ Storage::url($product->cover_image) }}" alt="{{ $product->title }}">
                                </button>
                            </li>

                            <!-- Gallery Thumbnails -->

                            @foreach ($product->gallery as $index => $image)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="item{{ $index }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#item{{ $index }}-tab-pane" type="button" role="tab"
                                        aria-controls="item{{ $index }}-tab-pane" aria-selected="false">
                                        <img src="{{ Storage::url($image->image_url) }}" alt="{{ $product->title }}">
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product__details-content">

                        @if ($product->tags->count())
                            @foreach ($product->tags->take(3) as $tag)
                                <span class="tag">{{ $tag->tag }}</span>
                            @endforeach
                        @endif

                        <h2 class="title">{{ $product->title }}</h2>
                        <div class="product__reviews-wrap">
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
                            <div class="product__code">
                                <span>SKU: <strong class="text-uppercase">{{ $product->sku }}</strong></span>
                            </div>
                        </div>

                        @if ($product->discount && $product->discount > 0)
                            <h4 class="price">

                                <span id="main-price">Rs
                                    {{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                                &nbsp;
                                <span class="text-decoration-line-through text-danger" id="old-price">
                                    Rs{{ number_format($product->price, 2) }}
                                </span>
                            </h4>
                        @else
                            <h4 id="main-price" class="price">Rs{{ number_format($product->price, 2) }}</h4>
                        @endif

                        @if (!empty($product->description))
                            <p>
                                {!! \Illuminate\Support\Str::limit($product->description, 150) !!}
                            </p>
                        @else
                            <p>Description not available.</p>
                        @endif






                        @if ($product->variations->where('variation_type', 'size')->isNotEmpty())
                            @php
                                // Sort sizes from small to large
                                $sortedSizes = $product->variations
                                    ->where('variation_type', 'size')
                                    ->sortBy('variation_value');
                            @endphp

                            <div class="product__size-wrap mb-4">
                                <label for="size-select" class="custom-label">Select Size:</label>
                                <div class="custom-dropdown">
                                    <select id="size-select" class="custom-select" required>
                                        <option value="" disabled selected>Select a size</option>
                                        @foreach ($sortedSizes as $variation)
                                            @php
                                                $stock = $variation->variation_stock ?? $product->stock->quantity;
                                                $isAvailable = $stock > 0;
                                                $extraPrice = $variation->variation_price ?? 0; // Extra price for the variant
                                            @endphp
                                            <option value="{{ $variation->variation_value }}"
                                                data-stock="{{ $stock }}" data-extra-price="{{ $extraPrice }}"
                                                {{ $isAvailable ? '' : 'disabled' }}>
                                                {{ strtoupper($variation->variation_value) }}
                                                {{ $isAvailable ? '' : '(Out of Stock)' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="stock-info-size" class="stock-info mt-2">
                                    <p class="text-muted">Select a size to see stock availability.</p>
                                </div>
                            </div>
                        @endif

                        @if ($product->variations->where('variation_type', 'weight')->isNotEmpty())
                            @php
                                // Sort weight variants
                                $weightVariants = $product->variations
                                    ->where('variation_type', 'weight')
                                    ->sortBy('variation_value');
                            @endphp

                            <div class="product__weight-wrap">
                                <label for="weight-select" class="custom-label">Select Weight:</label>
                                <div class="custom-dropdown">
                                    <select id="weight-select" class="custom-select" required>
                                        <option value="" disabled selected>Select a weight</option>
                                        @foreach ($weightVariants as $variation)
                                            @php
                                                $stock = $variation->variation_stock ?? $product->stock->quantity;
                                                $isAvailable = $stock > 0;
                                                $extraPrice = $variation->variation_price ?? $product->price; // Extra price for the variant
                                            @endphp
                                            <option value="{{ $variation->variation_value }}"
                                                data-stock="{{ $stock }}" data-extra-price="{{ $extraPrice }}"
                                                {{ $isAvailable ? '' : 'disabled' }}>
                                                {{ ucfirst($variation->variation_value) }}
                                                {{ $isAvailable ? '' : '(Out of Stock)' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="stock-info-weight" class="stock-info mt-2">
                                    <p class="text-muted">Select a weight to see stock availability.</p>
                                </div>
                            </div>
                        @endif

                        <!-- Colors -->
                        @if ($product->variations->where('variation_type', 'color')->isNotEmpty())
                            <div class="col-xl-4">
                                <div class="mt-4">
                                    <h5 class="fs-14 mb-3">Select Color:</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($product->variations->where('variation_type', 'color') as $index => $variation)
                                            @php
                                                $stock = $variation->variation_stock ?? $product->stock->quantity;
                                                $stockStatus = $stock > 0 ? "$stock Items Available" : 'Out of Stock';
                                            @endphp
                                            <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                                title="{{ $stockStatus }}">
                                                <input type="radio" id="color-{{ $index }}"
                                                    name="product-color" value="{{ $variation->variation_value }}"
                                                    class="d-none variant-input" data-stock="{{ $stock }}"
                                                    data-type="color" {{ $stock > 0 ? '' : 'disabled' }}>
                                                <label for="color-{{ $index }}"
                                                    class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle color-select
                           {{ $stock > 0 ? '' : 'disabled' }}"
                                                    style="background-color: {{ strtolower($variation->variation_value) }};">
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Fragrances -->
                        @if ($product->variations->where('variation_type', 'fragrance')->isNotEmpty())
                            <div class="col-xl-4">
                                <div class="mt-4">
                                    <h5 class="fs-14 mb-3">Select Fragrance:</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($product->variations->where('variation_type', 'fragrance') as $index => $variation)
                                            @php
                                                $stock = $variation->variation_stock ?? $product->stock->quantity;
                                                $stockStatus = $stock > 0 ? "$stock Items Available" : 'Out of Stock';
                                            @endphp
                                            <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                                title="{{ $stockStatus }}">
                                                <input type="radio" id="fragrance-{{ $index }}"
                                                    name="product-fragrance" value="{{ $variation->variation_value }}"
                                                    class="d-none variant-input" data-stock="{{ $stock }}"
                                                    data-type="fragrance" {{ $stock > 0 ? '' : 'disabled' }}>
                                                <label for="fragrance-{{ $index }}"
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3 fragrance-option
                                                      {{ $stock > 0 ? '' : 'disabled' }}">
                                                    {{ ucfirst($variation->variation_value) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif




                        @push('js')
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    /**
                                     * Initializes variant selection for dropdown or radio inputs.
                                     * @param {string} inputSelector - The selector for the variant inputs (radio or dropdown).
                                     * @param {string} stockInfoId - The ID of the element where stock info is displayed.
                                     * @param {string} [activeClass] - Optional active class for styling selected inputs.
                                     */
                                    const initializeVariantSelection = (inputSelector, stockInfoId, activeClass = null) => {
                                        const variantInputs = document.querySelectorAll(inputSelector);
                                        const stockInfoElement = document.getElementById(stockInfoId);

                                        variantInputs.forEach(input => {
                                            const label = input.nextElementSibling;

                                            // Handle variant selection
                                            input.addEventListener('change', () => {
                                                // Clear active states for radio buttons (if applicable)
                                                if (activeClass) {
                                                    variantInputs.forEach(opt => opt.nextElementSibling?.classList
                                                        .remove(activeClass));
                                                }

                                                // Add active class for the selected input (if applicable)
                                                if (label && activeClass) {
                                                    label.classList.add(activeClass);
                                                }

                                                // Update stock information
                                                const stock = input.getAttribute('data-stock');
                                                if (stockInfoElement) {
                                                    stockInfoElement.innerHTML = stock > 0 ?
                                                        `<p class="text-success">${stock} Items Available</p>` :
                                                        `<p class="text-danger">Out of Stock</p>`;
                                                }

                                                // Update tooltip dynamically (for radio buttons)
                                                if (label) {
                                                    const tooltipInstance = bootstrap.Tooltip.getInstance(label) ||
                                                        new bootstrap.Tooltip(label, {
                                                            title: stock > 0 ? `${stock} Items Available` :
                                                                'Out of Stock',
                                                            trigger: 'hover',
                                                            placement: 'top',
                                                        });
                                                    tooltipInstance.show();
                                                }
                                            });

                                            // Keyboard accessibility (for radio buttons)
                                            if (label) {
                                                label.addEventListener('keydown', (e) => {
                                                    if (e.key === 'Enter' || e.key === ' ') {
                                                        input.checked = true;
                                                        input.dispatchEvent(new Event('change'));
                                                        e.preventDefault();
                                                    }
                                                });
                                            }
                                        });
                                    };

                                    // Initialize size dropdown
                                    initializeVariantSelection('#size-select option', 'stock-info-size');

                                    // Initialize weight dropdown
                                    initializeVariantSelection('#weight-select option', 'stock-info-weight');

                                    // Initialize color variants
                                    initializeVariantSelection('input[name="product-color"]', 'stock-info-color', 'active');

                                    // Initialize fragrance variants
                                    initializeVariantSelection('input[name="product-fragrance"]', 'stock-info-fragrance', 'active');
                                });
                            </script>
                        @endpush











                        <div class="product__details-qty">
                            <div class="cart-plus-minus">
                                <input type="text" value="1">
                            </div>
                            <a href="product-details.html" class="add-btn">Add To Cart</a>
                        </div>
                        <a href="product-details.html" class="buy-btn">Buy it Now</a>
                        <div class="product__wishlist-wrap">
                            <a href="product-details.html"><i class="flaticon-love"></i>Add To Wishlist</a>
                            <a href="product-details.html"><i class="flaticon-exchange"></i>Compare To Other</a>
                        </div>
                        <div class="product__details-bottom">
                            <ul class="list-wrap">
                                <li class="product__details-category">
                                    <span class="title">Categories:</span>
                                <li class="product__details-category">
                                    <span class="title">Categories:</span>
                                    @if ($product->category)
                                        @if ($product->category->parent)
                                            <a href="#">{{ $product->category->parent->name }}</a>,
                                        @endif
                                        <a href="#">{{ $product->category->name }}</a>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </li>

                                </li>

                                @if ($product->manufacturer_brand)
                                    <li class="product__details-category">
                                        <span class="title">Manufacturer:</span>
                                        <a href="javascript:void(0)">{{ $product->manufacturer_brand }}</a>
                                    </li>
                                @endif
                                <li class="product__details-tags">
                                    <span class="title">Tags:</span>
                                    @if ($product->tags->count())
                                        @foreach ($product->tags as $tag)
                                            <a href="#">{{ $tag->tag }}</a>{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </li>

                                <li class="product__details-social">
                                    <span class="title">Share :</span>
                                    <ul class="list-wrap">
                                        <li><a href="https://www.facebook.com/" target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/" target="_blank"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.whatsapp.com/" target="_blank"><i
                                                    class="fab fa-whatsapp"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i
                                                    class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.youtube.com/" target="_blank"><i
                                                    class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="product__details-checkout">
                            <span class="title">Guaranteed Safe Checkout</span>
                            <img src="assets/img/products/card.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-desc-wrap">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description-tab-pane" type="button" role="tab"
                                    aria-controls="description-tab-pane" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                    aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                                aria-labelledby="description-tab" tabindex="0">
                                @if (!empty($product->description))
                                    <p>
                                        {!! $product->description !!}
                                    </p>
                                @else
                                    <p>Description not available.</p>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                aria-labelledby="reviews-tab" tabindex="0">
                                <div class="product-desc-review">
                                    <div class="product-desc-review-title mb-15">
                                        <h5 class="title">Customer Reviews (0)</h5>
                                    </div>
                                    <div class="left-rc">
                                        <p>No reviews yet</p>
                                    </div>
                                    <div class="right-rc">
                                        <a href="#">Write a review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="related-product-area">
                <div class="row">
                    <div class="col-12">
                        <div class="section__title-two mb-20">
                            <h2 class="title">Related Products <img src="assets/img/images/title_shape.svg"
                                    alt="" class="injectable">
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="product__item-wrap">
                    <div class="swiper product-active">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="product__item">
                                    <div class="product__thumb">
                                        <a href="product-details.html"><img src="assets/img/products/products_img01.jpg"
                                                alt="img"></a>
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
                                        <h4 class="title"><a href="product-details.html">Dog Harness-Neoprene Comfort
                                                Liner-Orange and ...</a></h4>
                                        <h3 class="price">$12.00 <del>$25.00</del></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item">
                                    <div class="product__thumb">
                                        <a href="product-details.html"><img src="assets/img/products/products_img02.jpg"
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
                                        <h4 class="title"><a href="product-details.html">Arm & Hammer Super Deodori zing
                                                Dog Shampoo, Pet Wash</a></h4>
                                        <h3 class="price">$20.00 <del>$30.00</del></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item">
                                    <div class="product__thumb">
                                        <a href="product-details.html"><img src="assets/img/products/products_img03.jpg"
                                                alt="img"></a>
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
                                        <h4 class="title"><a href="product-details.html">Milk-Bone Brushing Chews Daily
                                                Dental Dog Treats ...</a></h4>
                                        <h3 class="price">$36.00 <del>$56.00</del></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item">
                                    <div class="product__thumb">
                                        <a href="product-details.html"><img src="assets/img/products/products_img04.jpg"
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
                                        <h4 class="title"><a href="product-details.html">Two Door Top Load Plastic Kennel
                                                & Pet Carrier, Blue 19”</a></h4>
                                        <h3 class="price">$18.00 <del>$33.00</del></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item">
                                    <div class="product__thumb">
                                        <a href="product-details.html"><img src="assets/img/products/products_img05.jpg"
                                                alt="img"></a>
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
                                        <h4 class="title"><a href="product-details.html">The Kitten House with Mat
                                                Sleeping Bed House</a></h4>
                                        <h3 class="price">$19.00 <del>$28.00</del></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
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
                                        <h4 class="title"><a href="product-details.html">Two Door Top Load Plastic Kennel
                                                & Pet Carrier, Blue 19”</a></h4>
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
            </div> --}}
        </div>
    </section>
    <!-- product-details-area-end -->
@endsection
