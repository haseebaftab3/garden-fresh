<!-- Product_Main -->
<section class="flat-spacing">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <!-- Product default -->
                <div class="col-md-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <div class="thumbs-slider">
                            <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                data-direction="vertical">
                                <div class="swiper-wrapper stagger-wrap">
                                    <div class="swiper-slide stagger-item" data-color="gray">
                                        <div class="item">
                                            <img class="lazyload" data-src="{{ Storage::url($product->cover_image) }}"
                                                src="{{ Storage::url($product->cover_image) }}"
                                                alt="{{ $product->title }}">
                                        </div>
                                    </div>
                                    @foreach ($product->gallery as $index => $image)
                                        <div class="swiper-slide stagger-item" data-color="gray">
                                            <div class="item">
                                                <img class="lazyload" data-src="{{ Storage::url($image->image_url) }}"
                                                    src="{{ Storage::url($image->image_url) }}"
                                                    alt="{{ $product->title }}">
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" data-color="gray">
                                        <a href="{{ Storage::url($product->cover_image) }}" target="_blank"
                                            class="item" data-pswp-width="600px" data-pswp-height="800px">
                                            <img class="tf-image-zoom lazyload"
                                                data-zoom="{{ Storage::url($product->cover_image) }}"
                                                data-src="{{ Storage::url($product->cover_image) }}"
                                                src="{{ Storage::url($product->cover_image) }}"
                                                alt="{{ $product->title }}">
                                        </a>
                                    </div>
                                    @foreach ($product->gallery as $index => $image)
                                        <div class="swiper-slide" data-color="gray">
                                            <a href="{{ Storage::url($image->image_url) }}" target="_blank"
                                                class="item" data-pswp-width="600px" data-pswp-height="800px">
                                                <img class="tf-image-zoom lazyload"
                                                    data-zoom="{{ Storage::url($image->image_url) }}"
                                                    data-src="{{ Storage::url($image->image_url) }}"
                                                    src="{{ Storage::url($image->image_url) }}" alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Product default -->

                @php
                    $baseStock = $product->stock->quantity; // Base stock
                    $variantStocks = $product->variations->pluck('variation_stock')->toArray(); // Variant stocks array

                    // Calculate total stock from variants
                    $totalVariantStock = array_sum($variantStocks);

                    // Final stock: Use variants if they exist; fallback to base stock
                    $finalStock = $totalVariantStock > 0 ? $totalVariantStock : $baseStock;

                    // Stock status
                    $stockStatus = $finalStock > 0 ? 'In Stock' : 'Out of Stock';
                @endphp

                <!-- tf-product-info-list -->
                <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            <div class="tf-product-info-heading">
                                <div class="tf-product-info-name">
                                    <div class="text text-btn-uppercase">Citrus</div>
                                    <h3 class="name">{{ $product->title }}</h3>
                                    @if ($finalStock <= 0)
                                        <div class="tf-product-pre-order text-btn-uppercase">Sold Out</div>
                                    @endif

                                    {{-- <div class="sub">
                                        <div class="tf-product-info-rate">
                                            <div class="list-star">
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                                <i class="icon icon-star"></i>
                                            </div>
                                            <div class="text text-caption-1">(134 reviews)</div>
                                        </div>
                                        <div class="tf-product-info-sold">
                                            <i class="icon icon-lightning"></i>
                                            <div class="text text-caption-1">18 sold in last 32 hours</div>
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="tf-product-info-desc">
                                    @php
                                        $product_discount_label = '';
                                        if (!empty($product->discount) && $product->discount > 0) {
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
                                            $product_discount_label = 'New';
                                        }
                                    @endphp

                                    <div class="tf-product-info-price">
                                        @if ($product->discount && $product->discount > 0)
                                            <h5 class="price price-on-sale font-2 price-amount" id="main-price"
                                                data-original-price="{{ $product->price }}"
                                                data-discount="{{ $product->discount }}">
                                                <span>
                                                    Rs <span id="FinalPriceValue">
                                                        {{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                                                    </span>
                                                </span>
                                            </h5>
                                            <h4 class="compare-at-price font-2 price-amount">
                                                Rs <span id="old-price">
                                                    {{ number_format($product->price, 2) }}
                                                </span>
                                            </h4>
                                        @else
                                            <h5 id="main-price" class="price price-on-sale font-2"
                                                data-original-price="{{ $product->price }}">
                                                Rs <span
                                                    id="FinalPriceValue">{{ number_format($product->price, 2) }}</span>
                                            </h5>
                                        @endif

                                        @if (!empty($product->discount) && $product->discount > 0)
                                            <div class="badges-on-sale text-btn-uppercase">
                                                {{ $product->discount }} %
                                            </div>
                                        @endif
                                    </div>

                                    @if (!empty($product->description))
                                        <p>
                                            {!! \Illuminate\Support\Str::limit(strip_tags($product->description), 150) !!}
                                        </p>
                                    @else
                                        <p>Description not available.</p>
                                    @endif
                                </div>
                            </div>

                            <div class="tf-product-info-choose-option">



                                <form accept="#" method="POST" class="product-variations-wrapper">
                                    <div id="alert-placeholder"></div>

                                    {{-- <div class="loader-overlay">
                                        <i class="fas fa-spinner fa-spin text-primary"></i>
                                        <p>Loading product variations...</p>
                                    </div> --}}

                                    @if ($product->variations->where('variation_type', 'weight')->isNotEmpty())
                                        @php
                                            // Sort weight variants
                                            $weightVariants = $product->variations
                                                ->where('variation_type', 'weight')
                                                ->sortBy('variation_value');
                                        @endphp

                                        <div class="product-variation product-weight-variation">
                                            <div class="d-flex justify-content-between mb_12">
                                                <div class="variant-picker-label">
                                                    Weight
                                                </div>
                                            </div>
                                            <ul class="range-variant">
                                                @foreach ($weightVariants as $variation)
                                                    @php
                                                        $stock =
                                                            $variation->variation_stock ?? $product->stock->quantity;
                                                        $isAvailable = $stock > 0;
                                                        $extraPrice = $variation->variation_price ?? $product->price; // Extra price for the variant
                                                    @endphp
                                                    <li class="{{ $isAvailable ? '' : 'disabled' }} weight-option text-title"
                                                        data-bs-toggle="popover" data-bs-trigger="hover"
                                                        data-bs-content="Available"
                                                        data-value="{{ $variation->variation_value }}"
                                                        data-variation-id="{{ $variation->id }}"
                                                        data-variation-type="{{ $variation->variation_type }}"
                                                        data-stock="{{ $stock }}"
                                                        data-extra-price="{{ $extraPrice }}"
                                                        style="{{ $isAvailable ? 'cursor: pointer;' : 'cursor: not-allowed;' }}">
                                                        {{ ucfirst($variation->variation_value) }} KG
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </form>



                                <div class="tf-product-info-quantity">
                                    <div class="title mb_12">Quantity:</div>
                                    <div class="wg-quantity">
                                        <span class="btn-quantity btn-decrease dec qtybtn">-</span>
                                        <input class="quantity-product" id="quantity" value="1" min="1"
                                            max="{{ $finalStock }}" type="text" name="number" value="1">
                                        <span class="btn-quantity btn-increase inc qtybtn">+</span>
                                    </div>
                                </div>


                                <input type="hidden" id="product-id" value="{{ $product->id }}">
                                @if ($finalStock > 0)
                                    <div class="tf-product-info-by-btn mb_10">

                                        <a href="#" id="checkout-btn" class="btn-style-3 text-btn-uppercase">
                                            <i class="far fa-shopping-bag"></i> Buy Now
                                        </a>


                                        <button type="button"
                                            class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart"
                                            id="add-to-cart-btn">
                                            Add to Cart
                                        </button>

                                    </div>
                                @else
                                    <div>
                                        <div class="tf-product-info-by-btn mb_10">
                                            <a href="#shoppingCart" data-bs-toggle="modal"
                                                class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart btn-sold-out"><span>Sold
                                                    out -&nbsp;</span>
                                            </a>

                                        </div>
                                    </div>
                                @endif
                                {{-- <div>
                                    <div class="tf-product-info-by-btn mb_10">
                                        <a href="#shoppingCart" data-bs-toggle="modal"
                                            class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart"><span>Add
                                                to cart -&nbsp;</span><span class="tf-qty-price total-price">Rs
                                                79.99</span></a>
                                    </div>
                                    <a href="#" class="btn-style-3 text-btn-uppercase">Buy it now</a>
                                </div> --}}
                                <div class="tf-product-info-help">
                                    <div class="tf-product-info-extra-link">
                                        <a href="#delivery_return" data-bs-toggle="modal"
                                            class="tf-product-extra-icon">
                                            <div class="icon">
                                                <i class="icon-shipping"></i>
                                            </div>
                                            <p class="text-caption-1">Delivery & Return</p>
                                        </a>
                                        <a href="#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon">
                                            <div class="icon">
                                                <i class="icon-question"></i>
                                            </div>
                                            <p class="text-caption-1">Ask A Question</p>
                                        </a>
                                        <a href="#share_social" data-bs-toggle="modal" class="tf-product-extra-icon">
                                            <div class="icon">
                                                <i class="icon-share"></i>
                                            </div>
                                            <p class="text-caption-1">Share</p>
                                        </a>
                                    </div>
                                    <div class="tf-product-info-time">
                                        <div class="icon">
                                            <i class="icon-timer"></i>
                                        </div>
                                        <p class="text-caption-1">Estimated Delivery:&nbsp;&nbsp;<span>5-10 days</span>
                                            (Pakistan only)</p>
                                    </div>
                                    <div class="tf-product-info-return">
                                        <div class="icon">
                                            <i class="icon-arrowClockwise"></i>
                                        </div>
                                        <p class="text-caption-1">Return within <span>45 days</span> of purchase.
                                            Duties & taxes are non-refundable.</p>
                                    </div>
                                </div>
                                <ul class="tf-product-info-sku">
                                    <li>
                                        <p class="text-caption-1">SKU:</p>
                                        <p class="text-caption-1 text-1">{{ $product->sku }}</p>
                                    </li>
                                    <li>
                                        <p class="text-caption-1">Availability:</p>
                                        <p class="text-caption-1 text-1">{{ $stockStatus }}</p>
                                    </li>
                                    <li>
                                        <p class="text-caption-1">Categories:</p>
                                        <p class="text-caption-1"><a href="#"
                                                class="text-1 link">{{ $product->category->name }}</a>

                                        </p>
                                    </li>
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- /tf-product-info-list -->
            </div>
        </div>
    </div>

</section>
<!-- /Product_Main -->

<!-- Product_Description_Tabs -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-tabs style-1">
                    <ul class="widget-menu-tab">
                        <li class="item-title active">
                            <span class="inner">Description</span>
                        </li>
                        {{-- <li class="item-title">
                            <span class="inner">Customer Reviews</span>
                        </li> --}}
                        <li class="item-title">
                            <span class="inner">Shipping & Returns</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Return Policies</span>
                        </li>
                    </ul>
                    <div class="widget-content-tab">
                        <div class="widget-content-inner active">
                            <div>
                                <p class="mb_12 text-secondary">
                                    @if (!empty($product->description))
                                        <p>
                                            {!! $product->description !!}
                                        </p>
                                    @else
                                        <p>Description not available.</p>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="widget-content-inner">
                            <div class="tab-shipping">
                                <div class="w-100">
                                    <div class="text-btn-uppercase mb_12">We've got your back</div>
                                    <p class="mb_12">One delivery fee to most locations (check our Orders & Delivery
                                        page)</p>
                                    <p class="">Free returns within 14 days (excludes final sale and
                                        made-to-order items, face masks and certain products containing hazardous or
                                        flammable materials, such as fragrances and aerosols)</p>
                                </div>
                                <div class="w-100">
                                    <div class="text-btn-uppercase mb_12">Import duties information</div>
                                    <p>Let us handle the legwork. Delivery duties are included in the item price when
                                        shipping to all EU countries (excluding the Canary Islands), plus The United
                                        Kingdom, USA, Canada, China Mainland, Australia, New Zealand, Puerto Rico,
                                        Switzerland, Singapore, Republic Of Korea, Kuwait, Mexico, Qatar, India, Norway,
                                        Saudi Arabia, Taiwan Region, Thailand, U.A.E., Japan, Brazil, Isle of Man, San
                                        Marino, Colombia, Chile, Argentina, Egypt, Lebanon, Hong Kong SAR, Bahrain and
                                        Turkey. All import duties are included in your order – the price you see is the
                                        price you pay.</p>
                                </div>
                                <div class="w-100">
                                    <div class="text-btn-uppercase mb_12">Estimated delivery</div>
                                    <p class="mb_6 font-2">Express: May 10 - May 17</p>
                                    <p class="font-2">Sending from USA</p>
                                </div>
                                <div class="w-100">
                                    <div class="text-btn-uppercase mb_12">Need more information?</div>
                                    <div>
                                        <a href="#"
                                            class="link text-secondary text-decoration-underline mb_6 font-2">Orders &
                                            delivery</a>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="link text-secondary text-decoration-underline mb_6 font-2">Returns &
                                            refunds</a>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="link text-secondary text-decoration-underline font-2">Duties &
                                            taxes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <div class="tab-policies">
                                <div class="text-btn-uppercase mb_12">Return Policies</div>
                                <p class="mb_12 text-secondary">At Modave, we stand behind the quality of our products.
                                    If you're not completely satisfied with your purchase, we offer hassle-free returns
                                    within 30 days of delivery.</p>
                                <div class="text-btn-uppercase mb_12">Easy Exchanges or Refunds</div>
                                <ul class="list-text type-disc mb_12 gap-6">
                                    <li class="text-secondary font-2">Exchange your item for a different size, color,
                                        or style, or receive a full refund.</li>
                                    <li class="text-secondary font-2">All returned items must be unworn, in their
                                        original packaging, and with tags attached.</li>
                                </ul>
                                <div class="text-btn-uppercase mb_12">Simple Process</div>
                                <ul class="list-text type-number">
                                    <li class="text-secondary font-2">Initiate your return online or contact our
                                        customer service team for assistance.</li>
                                    <li class="text-secondary font-2">Pack your item securely and include the original
                                        packing slip.</li>
                                    <li class="text-secondary font-2">Ship your return back to us using our prepaid
                                        shipping label.</li>
                                    <li class="text-secondary font-2">Once received, your refund will be processed
                                        promptly.</li>
                                </ul>
                                <p class="text-secondary font-2">For any questions or concerns regarding returns, don't
                                    hesitate to reach out to our dedicated customer service team. Your satisfaction is
                                    our priority.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Product_Description_Tabs -->


<!-- tf-add-cart-success -->
<div class="tf-add-cart-success">
    <div class="tf-add-cart-heading">
        <h5>Shopping Cart</h5>
        <i class="icon icon-close tf-add-cart-close"></i>
    </div>
    <div class="tf-add-cart-product">
        <div class="image">
            <img class="ls-is-cached lazyloaded" data-src="{{ Storage::url($product->cover_image) }}"
                alt="Product Image" src="{{ Storage::url($product->cover_image) }}">
        </div>
        <div class="content">
            <div class="text-title">
                <a class="link" href="product-detail.html">{{ $product->title }}</a>
            </div>
            <div class="text-caption-1" id="AddedStatus">Added Successfully</div>
            <div class="text-title">Rs<span id="SuccessPrice">{{ number_format($product->price, 2) }}</span></div>
        </div>
    </div>
    <a href="{{ route('cart.index') }}" class="tf-btn w-100 btn-fill radius-4"><span
            class="text text-btn-uppercase">View
            cart</span></a>
</div>
<!-- /tf-add-cart-success -->


@push('css')
    <style>
        /* strong {
                                                                            font-weight: inherit !important;
                                                                        } */

        .loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }

        .product-variations-wrapper {
            position: relative;
        }


        .range-variant {
            display: flex;
            gap: 10px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .range-variant li {
            padding: 10px 15px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            position: relative;
            border-radius: 13px;
        }

        .range-variant li.active {
            background-color: black;
            color: #fff;
            border-color: var(--color-primary);
        }

        .range-variant li.disabled {
            color: #ccc;
            border-color: #eee;
            cursor: not-allowed;
        }


        .single-product-modern .single-product-content .inner .range-variant li {
            width: fit-content;
        }


        @media only screen and (max-width: 991px) {
            .single-product-modern .small-thumb-wrapper .small-thumb-img {
                width: 120px !important;
            }

            .draggable .slick-track {
                width: 100% !important;
                transform: translate3d(0px, 0px, 0px) !important;
                display: flex;
                justify-content: center;
            }
        }

        .axil-btn.disabled {
            cursor: not-allowed;
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all popovers
            const popoverTriggerList = [...document.querySelectorAll('[data-bs-toggle="popover"]')];
            popoverTriggerList.forEach(el => new bootstrap.Popover(el, {
                container: 'body',
                placement: 'top'
            }));

            // Object to store the selected elements for each variant group
            const selectedVariants = {};

            // Function to calculate the final price based on selected variants
            function calculateFinalPrice() {
                const basePrice = parseFloat({{ $product->price }}) || 0;
                const variantPrices = Object.values(selectedVariants)
                    .map(price => parseFloat(price) || 0)
                    .filter(price => price > 0);

                return variantPrices.reduce((total, price) => total + price, basePrice);
            }

            // Extract product discount
            const discount = parseFloat(
                {{ $product->discount && $product->discount > 0 ? $product->discount : 0 }}) || 0;

            // Function to update the Final Price in the DOM
            function updateFinalPrice() {
                const finalPriceElement = document.getElementById('FinalPriceValue');
                const SuccessPrice = document.getElementById('SuccessPrice');
                const oldPriceElement = document.getElementById('old-price');

                const originalPrice = calculateFinalPrice();
                let discountedPrice = originalPrice;

                // Apply discount if available
                if (discount > 0) {
                    discountedPrice = originalPrice * (1 - discount / 100);
                    oldPriceElement.textContent = originalPrice.toFixed(2);
                }

                finalPriceElement.textContent = discountedPrice.toFixed(2);
                SuccessPrice.textContent = discountedPrice.toFixed(2);
            }


            // Utility function for handling active class toggling and price updates
            const setupVariantSelection = (selector, key) => {
                const elements = document.querySelectorAll(selector);
                elements.forEach(item => {
                    item.addEventListener('click', function() {
                        if (this.classList.contains('disabled')) return;

                        // Remove active class from all items in the group
                        elements.forEach(el => el.classList.remove('active'));
                        // Add active class to clicked item
                        this.classList.add('active');

                        // Update the selected variant cost
                        const extraPrice = this.getAttribute('data-extra-price');
                        if (extraPrice !== null) {
                            selectedVariants[key] = parseFloat(
                                extraPrice);
                        } else {
                            selectedVariants[key] = 0;
                        }

                        // Update the final price
                        updateFinalPrice();
                    });
                });
            };

            // Setup variant selection handlers
            setupVariantSelection('.size-option', 'size');
            setupVariantSelection('.weight-option', 'weight');
            setupVariantSelection('.fragrance-option', 'fragrance');
            setupVariantSelection('.color-option', 'color');

            // Handle dropdown selection
            const flavourSelect = document.getElementById('flavour-select');
            if (flavourSelect) {
                flavourSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const extraPrice = selectedOption.getAttribute('data-extra-price');

                    if (extraPrice !== null) {
                        selectedVariants['flavour'] = parseFloat(extraPrice);
                    } else {
                        selectedVariants['flavour'] = 0;
                    }

                    // Update the final price
                    updateFinalPrice();
                });
            }
            const quantityInput = document.getElementById('quantity');
            const plusBtn = document.querySelector('.inc');
            const minusBtn = document.querySelector('.dec');

            const maxStock = {{ $finalStock }};

            plusBtn.addEventListener('click', function() {

                let currentQuantity = parseInt(quantityInput.value);

                if (currentQuantity > maxStock) {
                    quantityInput.value = maxStock;
                }
            });

            // Handle decrement
            minusBtn.addEventListener('click', function() {
                let currentQuantity = parseInt(quantityInput.value);
                if (currentQuantity < 1) {
                    quantityInput.value = 1;
                }
            });

            // Validate manual input
            quantityInput.addEventListener('input', function() {
                let currentQuantity = parseInt(quantityInput.value);

                if (isNaN(currentQuantity) || currentQuantity < 1) {
                    quantityInput.value = 1;
                } else if (currentQuantity > maxStock) {
                    quantityInput.value = maxStock;
                }
            });
        });


        const variantSelectors = [{
                selector: '.size-option',
                label: 'Size'
            },
            {
                selector: '.weight-option',
                label: 'Weight'
            },
            {
                selector: '.fragrance-option',
                label: 'Fragrance'
            },
            {
                selector: '.color-option',
                label: 'Color'
            },
            {
                selector: '#flavour-select',
                label: 'Flavour'
            }
        ];

        const validateAndSendData = () => {
            let isValid = true;
            let missedVariants = [];
            const selectedVariants = [];

            variantSelectors.forEach(({
                selector,
                label
            }) => {
                if (selector.startsWith('#')) {
                    // Handle dropdowns
                    const dropdown = document.querySelector(selector);
                    if (dropdown) {
                        const selectedOption = dropdown.options[dropdown.selectedIndex];
                        const stock = selectedOption?.getAttribute('data-stock');
                        const variationId = selectedOption?.getAttribute('data-variation-id');

                        if ((!dropdown.value || dropdown.value === "") || (stock && parseInt(stock) <= 0)) {
                            isValid = false;
                            missedVariants.push(label);
                        } else if (variationId) {
                            selectedVariants.push(variationId);
                        }
                    }
                } else {
                    // Handle button groups
                    const elements = document.querySelectorAll(selector);
                    const hasStock = Array.from(elements).some(el => parseInt(el.getAttribute('data-stock')) >
                        0);
                    const activeElement = Array.from(elements).find(el => el.classList.contains('active'));
                    const variationId = activeElement?.getAttribute('data-variation-id');

                    if (hasStock && !activeElement) {
                        isValid = false;
                        missedVariants.push(label);
                    } else if (variationId) {
                        selectedVariants.push(variationId);
                    }
                }
            });

            if (!isValid) {
                const alertPlaceholder = document.getElementById('alert-placeholder');
                const alertHTML = `
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    Please select the following variants before proceeding: ${missedVariants.join(', ')}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                alertPlaceholder.innerHTML = alertHTML;
                return false;
            } else {
                document.getElementById('alert-placeholder').innerHTML = ''; // Remove alert
                return selectedVariants;
            }
        };

        const sendToCart = (redirectToCheckout = false) => {
            const selectedVariants = validateAndSendData();
            if (!selectedVariants) return; // Exit if validation fails

            const productId = document.querySelector('#product-id').value; // Assuming a hidden input for product ID
            const quantity = document.querySelector('#quantity').value || 1;

            // Get the buttons and form
            const addToCartBtn = document.getElementById('add-to-cart-btn');
            const checkoutBtn = document.getElementById('checkout-btn');
            const productForm = document.querySelector('.product-variations-wrapper');

            // Show spinner and disable the buttons
            [addToCartBtn, checkoutBtn].forEach((btn) => {
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                }
            });

            // Prepare data for AJAX
            const data = {
                product_id: productId,
                variant_ids: selectedVariants, // Send selected variant IDs
                quantity: quantity,
            };

            // Send data using AJAX
            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((result) => {
                    if (result.success) {
                        console.log('Cart updated:', result);
                        resetForm(productForm); // Reset the form
                        sideOffcanvasToggleMenu(".cart-dropdown-btn", "#cart-dropdown"); // Open cart dropdown
                        fetchCartItems(); // Refresh cart items
                        updateCartCount(result.cartCount); // Update cart count
                        updateSubtotal(result.subtotal); // Update cart subtotal

                        showAlert('success', result.message);
                        document.getElementById("AddedStatus").innerHTML = "Item added to cart successfully.";
                        document.getElementById("AddedStatus").classList.add("text-success");
                        if (redirectToCheckout) {
                            // Redirect to checkout page if required
                            window.location.href = '/checkout';
                        }
                    } else {
                        // Show error message in alert placeholder
                        document.getElementById("AddedStatus").innerHTML = "Failed to add item to cart.";
                        document.getElementById("AddedStatus").classList.add("text-danger");
                        showAlert('danger', result.details || 'Failed to add item to cart.');
                    }
                })
                .catch((error) => {
                    // console.error('Error:', error);
                    document.getElementById("AddedStatus").innerHTML =
                        "An error occurred while adding the item to the cart.";
                    document.getElementById("AddedStatus").classList.add("text-danger");
                    showAlert('danger', 'An error occurred while adding the item to the cart.');
                })
                .finally(() => {
                    // Reset button state after the operation
                    [addToCartBtn, checkoutBtn].forEach((btn) => {
                        if (btn) {
                            btn.disabled = false;
                            btn.innerHTML = btn.id === 'add-to-cart-btn' ?
                                '<i class="far fa-shopping-bag"></i> Add to Cart' :
                                '<i class="far fa-shopping-bag"></i> Buy Now';
                        }
                    });
                });
        };

        // Attach event listeners to buttons
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        const checkoutBtn = document.getElementById('checkout-btn');

        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', (event) => {
                event.preventDefault();
                sendToCart(false); // Add to cart without redirection
            });
        }

        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', (event) => {
                event.preventDefault();
                sendToCart(true); // Add to cart and redirect to checkout
            });
        }




        function showAlert(type, message, details = null) {
            const alertPlaceholder = document.getElementById('alert-placeholder');
            if (alertPlaceholder) {
                let detailHtml = '';
                if (details) {
                    detailHtml = `<div>${details}</div>`;
                }

                alertPlaceholder.innerHTML = `
                                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                                    <strong>${message}</strong>
                                    ${detailHtml}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
            } else {
                console.error('Alert placeholder not found.');
            }
        }

        function resetForm(form) {
            if (form) {
                form.reset(); // Reset standard form elements like inputs, selects, and checkboxes

                // Manually reset custom elements if needed
                document.querySelectorAll('.range-variant .active').forEach((el) => {
                    el.classList.remove('active');
                });

                // Reset custom quantity inputs
                const quantityInput = document.getElementById('quantity');
                if (quantityInput) {
                    quantityInput.value = 1; // Reset quantity to 1
                }

                // Reset dropdowns with placeholders
                const flavourSelect = document.getElementById('flavour-select');
                if (flavourSelect) {
                    flavourSelect.selectedIndex = 0; // Reset to the first option
                }

                // Reset stock info placeholder
                const stockInfoFlavour = document.getElementById('stock-info-flavour');
                if (stockInfoFlavour) {
                    stockInfoFlavour.innerHTML = '<p class="text-muted">Please select a flavour to view stock details.</p>';
                }

                // Remove active state for color options
                document.querySelectorAll('.color-option.active').forEach((el) => {
                    el.classList.remove('active');
                });

                // Reset product price
                resetProductPrice();
            }
        }

        // Function to reset the product price
        function resetProductPrice() {
            const mainPrice = document.getElementById('main-price');
            const finalPriceValue = document.getElementById('FinalPriceValue');
            const oldPrice = document.getElementById('old-price');

            if (mainPrice) {
                // Check if there is a discount applied
                const productPrice = parseFloat(mainPrice.dataset
                    .originalPrice); // Assuming you store the original price in a data attribute
                const discountPercentage = parseFloat(mainPrice.dataset
                    .discount); // Assuming you store the discount percentage in a data attribute

                if (discountPercentage && discountPercentage > 0) {
                    const discountedPrice = productPrice * (1 - discountPercentage / 100);

                    // Update the price values
                    if (finalPriceValue) {
                        finalPriceValue.textContent = discountedPrice.toFixed(2);
                    }
                    if (oldPrice) {
                        oldPrice.textContent = productPrice.toFixed(2);
                    }
                } else {
                    // If no discount, reset to the original price
                    if (finalPriceValue) {
                        finalPriceValue.textContent = productPrice.toFixed(2);
                    }
                    if (oldPrice) {
                        oldPrice.textContent = '';
                    }
                }
            }
        }


        function sideOffcanvasToggleMenu(toggleButtonSelector, menuSelector) {
            $("body").on("click", toggleButtonSelector, function(e) {
                e.preventDefault();

                const $body = $("body");
                const $menu = $(menuSelector);
                const $mask = $("<div />").addClass("closeMask");

                // Open the menu
                if (!$menu.hasClass("open")) {
                    openMenu();
                }

                // Function to open the menu
                function openMenu() {
                    $body.addClass("menu-open");
                    $menu.addClass("open");
                    $menu.parent().append($mask);
                    $body.css({
                        overflow: "hidden"
                    });
                }

                // Function to close the menu
                function closeMenu() {
                    $body.removeClass("menu-open").removeAttr("style");
                    $menu.removeClass("open");
                    $(".closeMask").remove();
                }

                // Close menu on mask or close button click
                $body.on("click", ".sidebar-close, .closeMask", function() {
                    closeMenu();
                });
            });
        }


        const buyNowBtn = document.querySelector('.add-to-cart a[href="/checkout"]');


        if (buyNowBtn) {
            buyNowBtn.addEventListener('click', function(event) {
                if (!validateVariants()) {
                    event.preventDefault();
                }
            });
        }
    </script>
@endpush
