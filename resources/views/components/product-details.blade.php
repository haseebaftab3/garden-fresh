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
                                            {!! \Illuminate\Support\Str::limit($product->description, 150) !!}
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
                                                        data-bs-content="Stock remaining: {{ $isAvailable ? $stock : 'Out of Stock' }}{{ $extraPrice > 0 ? ' | Extra Price: Rs ' . $extraPrice : '' }}"
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
                                        <p class="text-caption-1">Estimated Delivery:&nbsp;&nbsp;<span>12-26
                                                days</span> (International), <span>3-6 days</span> (United States)</p>
                                    </div>
                                    <div class="tf-product-info-return">
                                        <div class="icon">
                                            <i class="icon-arrowClockwise"></i>
                                        </div>
                                        <p class="text-caption-1">Return within <span>45 days</span> of purchase.
                                            Duties & taxes are non-refundable.</p>
                                    </div>
                                    <div class="dropdown dropdown-store-location">
                                        <div class="dropdown-title dropdown-backdrop" data-bs-toggle="dropdown"
                                            aria-haspopup="true">
                                            <div class="tf-product-info-view link">
                                                <div class="icon">
                                                    <i class="icon-map-pin"></i>
                                                </div>
                                                <span>View Store Information</span>
                                            </div>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <div class="dropdown-content">

                                                <div class="line-bt"></div>
                                                <div>
                                                    <h6>Fashion Modave</h6>
                                                    <p>Pickup available. Usually ready in 24 hours</p>
                                                </div>
                                                <div>
                                                    <p>766 Rosalinda Forges Suite 044,</p>
                                                    <p>Gracielahaven, Oregon</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="tf-product-info-sku">
                                    <li>
                                        <p class="text-caption-1">SKU:</p>
                                        <p class="text-caption-1 text-1">53453412</p>
                                    </li>
                                    <li>
                                        <p class="text-caption-1">Stock:</p>
                                        @if ($finalStock > 0)
                                            <p class="text-caption-1 text-1"> {{ $finalStock }} Items Left
                                            </p>
                                        @else
                                            <p class="text-caption-1 text-1">0 Items Left</p>
                                        @endif

                                    </li>
                                    <li>
                                        <p class="text-caption-1">Available:</p>
                                        <p class="text-caption-1 text-1">{{ $stockStatus }}</p>
                                    </li>
                                    <li>
                                        <p class="text-caption-1">Categories:</p>
                                        <p class="text-caption-1"><a href="#" class="text-1 link">Clothes</a>,
                                            <a href="#" class="text-1 link">women</a>, <a href="#"
                                                class="text-1 link">T-shirt</a>
                                        </p>
                                    </li>
                                </ul>
                                <div class="tf-product-info-guranteed">
                                    <div class="text-title">
                                        Guranteed safe checkout:
                                    </div>
                                    {{-- <div class="tf-payment">
                                        <a href="#">
                                            <img src="images/payment/img-1.png" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="images/payment/img-2.png" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="images/payment/img-3.png" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="images/payment/img-4.png" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="images/payment/img-5.png" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="images/payment/img-6.png" alt="">
                                        </a>
                                    </div> --}}
                                </div>
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
                            <div class="tab-description">
                                <div class="right">
                                    <div class="letter-1 text-btn-uppercase mb_12">Stretch strap top</div>
                                    <p class="mb_12 text-secondary">Nodding to retro styles, this Hyperbola T-shirt is
                                        defined by its off-the-shoulder design. It's spun from a green stretch cotton
                                        jersey and adorned with an embroidered AC logo on the front, a brand's
                                        signature.</p>
                                    <p class="text-secondary">Thick knitted fabric. Short design. Straight design.
                                        Rounded neck. Sleeveless. Straps. Unclosed. Cable knit finish. Co-ord.</p>
                                </div>
                                <div class="left">
                                    <div class="letter-1 text-btn-uppercase mb_12">COMPOSITION, ORIGIN AND CARE
                                        GUIDELINES</div>
                                    <ul class="list-text type-disc mb_12 gap-6">
                                        <li class="font-2">Composition: 55% polyester, 30% acrylic, 13% polyamide, 2%
                                            elastane</li>
                                        <li class="font-2">Designed in Barcelona</li>
                                        <li class="font-2">Origin</li>
                                        <li class="font-2">Manufacture: USA</li>
                                    </ul>
                                    <div class="d-flex gap-20 mb_12 list-icon-guideline">
                                        <div class="d-flex">
                                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="24" height="21.6"
                                                    fill="url(#pattern0_15741_41601)" />
                                                <defs>
                                                    <pattern id="pattern0_15741_41601"
                                                        patternContentUnits="objectBoundingBox" width="1"
                                                        height="1">
                                                        <use xlink:href="#image0_15741_41601"
                                                            transform="scale(0.0125 0.0138889)" />
                                                    </pattern>
                                                    <image id="image0_15741_41601" width="80" height="72"
                                                        xlink:href="data:image/png;base64,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" />
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="d-flex">
                                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="24" height="21.6"
                                                    fill="url(#pattern0_15741_41602)" />
                                                <defs>
                                                    <pattern id="pattern0_15741_41602"
                                                        patternContentUnits="objectBoundingBox" width="1"
                                                        height="1">
                                                        <use xlink:href="#image0_15741_41602"
                                                            transform="scale(0.0125 0.0138889)" />
                                                    </pattern>
                                                    <image id="image0_15741_41602" width="80" height="72"
                                                        xlink:href="data:image/png;base64,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" />
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="d-flex">
                                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="24" height="21.6"
                                                    fill="url(#pattern0_15741_41603)" />
                                                <defs>
                                                    <pattern id="pattern0_15741_41603"
                                                        patternContentUnits="objectBoundingBox" width="1"
                                                        height="1">
                                                        <use xlink:href="#image0_15741_41603"
                                                            transform="scale(0.0125 0.0138889)" />
                                                    </pattern>
                                                    <image id="image0_15741_41603" width="80" height="72"
                                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABICAYAAABhlHJbAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAUKADAAQAAAABAAAASAAAAABhcJAMAAAErUlEQVR4Ae2bzVXbQBSFbR/D3i04axaglAAlkBJMCbiEuAQoAUogJcSwYO8S4j32wbl3oqeMpBl5RgJJ2M/nmJFkzd+n+35GEoOBfpSAElACSkAJKAEloASUgBJQAm0TGNbt8Pz8/LJu3T7W2263q9fX11Xs2MaxFeT84XD4xG2UcuhLl6enpwtMYB47iVFshUM9f7fb1bKow5BPg6tKVzQajYw1LZfLaB5Hr8CXl5dfwr+OXz96gIQH812mEBOBGVoqwH+kDEAExGkoODlPAYIEFCjpiypQlBFZigKTs7OzSUxdVSBo2YFkPB5HqVABpnKrG0gUYAoQAcSkM8gJVYExPkzOrRtIVIFCcDCQXHAaE0gUYArw+flZAA5iAokC/K9A5oOyrAv2gwrQAohAIvlg8J0ZBWgBrBNIFKAFcLPZGBOGEicIJFPrJ++mArTQ8JY+VLjmIdyhDvKDCtACmG4aP/j+/q4KLLPZf0QiMcw4KJCoAgtMsZQzt7ZCAUY/Ayj0592lE0ZCKmZQ8idcc+JqR9068nb2sT9MAM+MF+P7bifYrm5qP9YsNpY+T0h45YKvXv8fiRJktkIpzpn7jQBSZYhWM1ypGaB51SR+RQaAc9dw0pUDk3O7KDG+a3wpBrEg7zBqASS4k5OTW3QwY8soTQcAtcQ2c6kltlf75G8q9fAPrIlzoospuZ7icKMBovFb+K+fVkMrqOker0Y81nk1wmqnT5vBS7rgIJKq7oFXJp0pk84FVHbfp5l/xFgw1wlc0x+2hTlWBpKgNObi4iKByf4WeFDcHE/xvx0iPEKDJXE1YtIZALzkMd9nrwkTHio/Ad4Eja3x/WE/hPE1fADHacZTzLsykFQqkFJGI3cCD9tXRwJvYGUJ4rKcmqhUIPzAHWoxGlHSV181qjpnvv+gBJJKgN4gkiTJNfp4YD8AeNOmv6PysYoxKRL7hwWs2+yfffIDBjuWUKPX8pwK5AQAjabL+o9tDt72uexcPjg+w/26q9TBy+FPLcGAeS0VyK/c7s/16fSBvPri997e3qLf2sz1ELmDfpmgl1Y1nIityshm654uZuwNJE6AnAR7xBVYdJAc03U4P7EPvZ2NRBzE/PfemSkBpKmIArC66FWSjAmVlBnBo86pRoGo6H1WXAIIeJI4cmlmbm/X6blBHXnVzNVE1W+u8xsds1M2uA9nNC4BRI/GhHC1nU6z0YjCKj/6TsOYvL/56jQ9jj5FhfsB2u8II+K1PlhOFkFrgUHnXAf2eftrbiuiKZjQ+rBIIySf/y2mMYYyqXdkvrIOvUEqNRez6QKcAAaLFSBy16nAHECcOE0rimylndbL9AJ25Ubs+QoLBpJpMSsp+kADkNTtFo55216+up4VFwEamcLeFaClGgjKWAL8sFho9msOIEzY5Fk4sYv0JRtU3zbAxZgxSknxsiHmAGZHdSNHwHJppUCSAaSDlFpdRj0ZQ89KUWDppaMMIFKGDGDPBt/5cBhIoELj1oqBJJfGyEixHjb/vSj7WuYI0IyzRYYToMtZ5po44h0oMecHM4D8l3eYcav3/o74OujUlYASUAJKQAkoASWgBJSAElACDQj8BQtLlbWiLn8cAAAAAElFTkSuQmCC" />
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="d-flex">
                                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="24" height="21.6"
                                                    fill="url(#pattern0_15741_41604)" />
                                                <defs>
                                                    <pattern id="pattern0_15741_41604"
                                                        patternContentUnits="objectBoundingBox" width="1"
                                                        height="1">
                                                        <use xlink:href="#image0_15741_41604"
                                                            transform="scale(0.0125 0.0138889)" />
                                                    </pattern>
                                                    <image id="image0_15741_41604" width="80" height="72"
                                                        xlink:href="data:image/png;base64,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" />
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="d-flex">
                                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="24" height="21.6"
                                                    fill="url(#pattern0_15741_41605)" />
                                                <defs>
                                                    <pattern id="pattern0_15741_41605"
                                                        patternContentUnits="objectBoundingBox" width="1"
                                                        height="1">
                                                        <use xlink:href="#image0_15741_41605"
                                                            transform="scale(0.0125 0.0138889)" />
                                                    </pattern>
                                                    <image id="image0_15741_41605" width="80" height="72"
                                                        xlink:href="data:image/png;base64,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" />
                                                </defs>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-caption-2">MACHINE WASHING MAX 30°C / 85ºF SHORT SPIN DRY</div>
                                </div>
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
        strong {
            font-weight: inherit !important;
        }

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
