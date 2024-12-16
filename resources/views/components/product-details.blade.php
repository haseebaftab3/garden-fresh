<div class="row">
    <div class="col-lg-6 mb--40">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-product-thumbnail-wrap zoom-gallery">
                    <div class="product-large-thumbnail-4 single-product-thumbnail axil-product">


                        <div class="thumbnail">
                            <a href="{{ Storage::url($product->cover_image) }}" class="popup-zoom">
                                <img src="{{ Storage::url($product->cover_image) }}" alt="{{ $product->title }}">
                            </a>
                        </div>

                        @foreach ($product->gallery as $index => $image)
                            <div class="thumbnail">
                                <a href="{{ Storage::url($image->image_url) }}" class="popup-zoom">
                                    <img src="{{ Storage::url($image->image_url) }}" class="popup-zoom"
                                        alt="{{ $product->title }}">
                                </a>
                            </div>
                        @endforeach
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
                    </div>
                    @if ($product_discount_label)
                        <div class="label-block">
                            <div class="product-badget">{{ $product_discount_label }}</div>
                        </div>
                    @endif
                    <div class="product-quick-view position-view">
                        <a href="{{ Storage::url($product->cover_image) }}" class="popup-zoom">
                            <i class="far fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div
                    class="small-thumb-wrapper product-small-thumb-4 slick-layout-wrapper--10 axil-slick-arrow arrow-both-side">
                    <div class="small-thumb-img active">
                        <img src="{{ Storage::url($product->cover_image) }}" alt="{{ $product->title }}">
                    </div>

                    @foreach ($product->gallery as $index => $image)
                        <div class="small-thumb-img">
                            <img src="{{ Storage::url($image->image_url) }}" alt="{{ $product->title }}">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb--40">
        <div class="single-product-content">
            <div class="inner">
                <h2 class="product-title" title="{{ $product->title }}">{{ $product->title }}</h2>
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
                <div class="product-price">
                    @if ($product->discount && $product->discount > 0)
                        <h4 class="price-amount" id="main-price" data-original-price="{{ $product->price }}"
                            data-discount="{{ $product->discount }}" style="display: flex; gap: 5px;">
                            <span class="text-primary">
                                Rs <span id="FinalPriceValue">
                                    {{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                                </span>
                            </span>
                            &nbsp;
                            <span class="text-decoration-line-through text-danger price-amount">
                                Rs <span id="old-price">
                                    {{ number_format($product->price, 2) }}
                                </span>
                            </span>
                        </h4>
                    @else
                        <h4 id="main-price" class="price text-primary" data-original-price="{{ $product->price }}">
                            Rs <span id="FinalPriceValue">{{ number_format($product->price, 2) }}</span>
                        </h4>
                    @endif
                </div>

                @if ($finalStock > 0)
                    <span class="text-success">{{ $stockStatus }}: {{ $finalStock }}</span>
                @else
                    <span class="text-danger">{{ $stockStatus }}</span>
                @endif
                {{-- <span class="price-amount">$120.00 - $180.00</span> --}}
                <div class="product-rating">
                    <div class="star-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-number">6,405</div>
                    <div class="total-answerd">2 answered questions</div>
                </div>
                @if (!empty($product->description))
                    <p>
                        {!! \Illuminate\Support\Str::limit($product->description, 150) !!}
                    </p>
                @else
                    <p>Description not
                        available.</p>
                @endif

                @push('css')
                    <style>
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
                    </style>
                @endpush

                <form accept="#" method="POST" class="product-variations-wrapper">
                    <div id="alert-placeholder"></div>

                    <div class="loader-overlay">
                        <i class="fas fa-spinner fa-spin text-primary"></i>
                        <p>Loading product variations...</p>
                    </div>

                    <!-- Start Product Variation  -->
                    @if ($product->variations->where('variation_type', 'size')->isNotEmpty())
                        @php
                            // Sort sizes from small to large
                            $sortedSizes = $product->variations
                                ->where('variation_type', 'size')
                                ->sortBy('variation_value');
                        @endphp

                        <div class="product-variation product-size-variation">
                            <h6 class="title">Size:</h6>
                            <ul class="range-variant">
                                @foreach ($sortedSizes as $variation)
                                    @php
                                        $stock = $variation->variation_stock ?? $product->stock->quantity;
                                        $isAvailable = $stock > 0;
                                        $extraPrice = $variation->variation_price - $product->price ?? 0; // Extra price for the variant
                                    @endphp
                                    <li class="{{ $isAvailable ? '' : 'disabled' }} size-option"
                                        data-bs-toggle="popover" data-bs-trigger="hover"
                                        data-bs-content="Stock remaining: {{ $isAvailable ? $stock : 'Out of Stock' }}{{ $extraPrice > 0 ? ' | Extra Price: Rs ' . $extraPrice : '' }}"
                                        data-value="{{ $variation->variation_value }}"
                                        data-variation-id="{{ $variation->id }}"
                                        data-variation-type="{{ $variation->variation_type }}"
                                        data-stock="{{ $stock }}" data-extra-price="{{ $extraPrice }}"
                                        style="{{ $isAvailable ? 'cursor: pointer;' : 'cursor: not-allowed;' }}">
                                        {{ strtoupper($variation->variation_value) }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    @endif

                    {{-- Weight Variation --}}
                    @if ($product->variations->where('variation_type', 'weight')->isNotEmpty())
                        @php
                            // Sort weight variants
                            $weightVariants = $product->variations
                                ->where('variation_type', 'weight')
                                ->sortBy('variation_value');
                        @endphp

                        <div class="product-variation product-weight-variation">
                            <h6 class="title">Weight:</h6>
                            <ul class="range-variant">
                                @foreach ($weightVariants as $variation)
                                    @php
                                        $stock = $variation->variation_stock ?? $product->stock->quantity;
                                        $isAvailable = $stock > 0;
                                        $extraPrice = $variation->variation_price ?? $product->price; // Extra price for the variant
                                    @endphp
                                    <li class="{{ $isAvailable ? '' : 'disabled' }} weight-option"
                                        data-bs-toggle="popover" data-bs-trigger="hover"
                                        data-bs-content="Stock remaining: {{ $isAvailable ? $stock : 'Out of Stock' }}{{ $extraPrice > 0 ? ' | Extra Price: Rs ' . $extraPrice : '' }}"
                                        data-value="{{ $variation->variation_value }}"
                                        data-variation-id="{{ $variation->id }}"
                                        data-variation-type="{{ $variation->variation_type }}"
                                        data-stock="{{ $stock }}" data-extra-price="{{ $extraPrice }}"
                                        style="{{ $isAvailable ? 'cursor: pointer;' : 'cursor: not-allowed;' }}">
                                        {{ ucfirst($variation->variation_value) }} KG
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($product->variations->where('variation_type', 'fragrance')->isNotEmpty())
                        @php
                            // Sort fragrance variants alphabetically
                            $fragranceVariants = $product->variations
                                ->where('variation_type', 'fragrance')
                                ->sortBy('variation_value');
                        @endphp

                        <div class="product-variation product-fragrance-variation">
                            <h6 class="title">Fragrance:</h6>
                            <ul class="range-variant">
                                @foreach ($fragranceVariants as $variation)
                                    @php
                                        $stock = $variation->variation_stock ?? $product->stock->quantity;
                                        $isAvailable = $stock > 0;
                                        $extraPrice = $variation->variation_price ?? $product->price; // Extra price for the variant
                                    @endphp
                                    <li class="{{ $isAvailable ? '' : 'disabled' }} fragrance-option"
                                        data-bs-toggle="popover" data-bs-trigger="hover"
                                        data-bs-content="Stock remaining: {{ $isAvailable ? $stock : 'Out of Stock' }}{{ $extraPrice > 0 ? ' | Extra Price: Rs ' . $extraPrice : '' }}"
                                        data-value="{{ $variation->variation_value }}"
                                        data-variation-id="{{ $variation->id }}"
                                        data-variation-type="{{ $variation->variation_type }}"
                                        data-stock="{{ $stock }}" data-extra-price="{{ $extraPrice }}"
                                        style="{{ $isAvailable ? 'cursor: pointer;' : 'cursor: not-allowed;' }}">
                                        {{ ucfirst($variation->variation_value) }}
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    @if ($product->variations->where('variation_type', 'color')->isNotEmpty())
                        @php
                            // Sort color variants alphabetically
                            $colorVariants = $product->variations
                                ->where('variation_type', 'color')
                                ->sortBy('variation_value');
                        @endphp

                        <div class="product-variation">
                            <h6 class="title">Colors:</h6>
                            <div class="color-variant-wrapper">
                                <ul class="color-variant mt--0">
                                    @foreach ($colorVariants as $variation)
                                        @php
                                            $stock = $variation->variation_stock ?? $product->stock->quantity;
                                            $isAvailable = $stock > 0;
                                            $extraPrice = $variation->variation_price ?? $product->price;
                                            $colorName = ucfirst($variation->variation_value); // Color name
                                            $colorCode = $variation->variation_value ?? '#000'; // Assuming you have a color code field
                                        @endphp
                                        <li class="{{ $isAvailable ? '' : 'disabled' }} color-option"
                                            data-bs-toggle="popover" data-bs-trigger="hover"
                                            data-bs-content="Color: {{ $colorName }} | Stock: {{ $isAvailable ? $stock : 'Out of Stock' }}{{ $extraPrice > 0 ? ' | Extra Price: Rs ' . $extraPrice : '' }}"
                                            data-value="{{ $variation->variation_value }}"
                                            data-variation-id="{{ $variation->id }}"
                                            data-variation-type="{{ $variation->variation_type }}"
                                            data-stock="{{ $stock }}" data-extra-price="{{ $extraPrice }}">
                                            <span>
                                                <span class="color"
                                                    style="background-color: {{ $colorCode }};"></span>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    @endif

                    @if ($product->variations->where('variation_type', 'flavour')->isNotEmpty())
                        @php
                            // Sort flavor variants alphabetically
                            $flavourVariants = $product->variations
                                ->where('variation_type', 'flavour')
                                ->sortBy('variation_value');
                        @endphp

                        <div class="form-group">
                            <label>Flavour <span>*</span></label>
                            <select id="flavour-select" required>
                                <option value="" disabled selected>Select a flavour</option>
                                @foreach ($flavourVariants as $variation)
                                    @php
                                        $stock = $variation->variation_stock ?? $product->stock->quantity;
                                        $isAvailable = $stock > 0;
                                        $extraPrice = $variation->variation_price ?? $product->price;
                                    @endphp
                                    <option value="{{ $variation->variation_value }}"
                                        data-stock="{{ $stock }}" data-extra-price="{{ $extraPrice }}"
                                        data-variation-id="{{ $variation->id }}"
                                        data-variation-type="{{ $variation->variation_type }}"
                                        {{ $isAvailable ? '' : 'disabled' }}>
                                        {{ ucfirst($variation->variation_value) }}
                                        {{ $isAvailable ? '' : '(Out of Stock)' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="stock-info-flavour" class="stock-info mt-2">
                            <p class="text-muted">Please select a flavour to view stock details.</p>
                        </div>
                    @endif









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
                                    const oldPriceElement = document.getElementById('old-price');

                                    const originalPrice = calculateFinalPrice();
                                    let discountedPrice = originalPrice;

                                    // Apply discount if available
                                    if (discount > 0) {
                                        discountedPrice = originalPrice * (1 - discount / 100);
                                        oldPriceElement.textContent = originalPrice.toFixed(2);
                                    }

                                    finalPriceElement.textContent = discountedPrice.toFixed(2);
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
                            });
                        </script>
                    @endpush





                    @push('css')
                        <style>
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
                            }

                            .range-variant li.active {
                                background-color: var(--color-primary);
                                color: #fff;
                                border-color: var(--color-primary)
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
                        </style>
                    @endpush

                    <!-- End Product Variation  -->
                    <!-- Start Product Variation  -->

                    <!-- End Product Variation  -->
                    <div class="product-variation quantity-variant-wrapper">
                        <h6 class="title">Quantity</h6>
                        <div class="pro-qty"> <input type="number" class="quantity-input" id="quantity"
                                value="1" min="1" max="{{ $finalStock }}">
                        </div>
                    </div>
                    @push('js')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
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
                        </script>
                    @endpush
            </div>

            <!-- Start Product Action Wrapper  -->
            <div class="product-action-wrapper">
                <input type="hidden" id="product-id" value="{{ $product->id }}">

                <!-- Start Product Action  -->

                @if ($finalStock > 0)
                    <ul class="product-action d-flex-center mb--0">
                        <li class="checkout">
                            <button id="checkout-btn" class="axil-btn btn-bg-secondary">
                                <i class="far fa-shopping-bag"></i> Buy Now
                            </button>
                        </li>
                        <li class="add-to-cart">
                            <button type="button" class="axil-btn btn-bg-primary" id="add-to-cart-btn">
                                Add to Cart
                            </button>
                        </li>
                    </ul>
                @else
                    <ul class="product-action d-flex-center mb--0">
                        <li class="add-to-cart">
                            <button class="axil-btn btn-bg-secondary disabled" disabled>
                                <i class="far fa-shopping-bag"></i> Buy Now
                            </button>
                        </li>
                        <li class="add-to-cart">
                            <button class="axil-btn btn-bg-primary disabled" disabled>
                                <i class="far fa-shopping-cart"></i> Add to Cart
                            </button>
                        </li>
                    </ul>
                @endif
                @push('css')
                    <style>
                        .axil-btn.disabled {
                            cursor: not-allowed;
                            opacity: 0.6;
                            pointer-events: none;
                        }
                    </style>
                @endpush


                @push('js')
                    <script>
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
                                        resetForm(productForm); // Reset the form
                                        sideOffcanvasToggleMenu(".cart-dropdown-btn", "#cart-dropdown"); // Open cart dropdown
                                        fetchCartItems(); // Refresh cart items
                                        updateCartCount(result.cartCount); // Update cart count
                                        updateSubtotal(result.subtotal); // Update cart subtotal

                                        showAlert('success', result.message);

                                        if (redirectToCheckout) {
                                            // Redirect to checkout page if required
                                            window.location.href = '/checkout';
                                        }
                                    } else {
                                        // Show error message in alert placeholder
                                        showAlert('danger', result.details || 'Failed to add item to cart.');
                                    }
                                })
                                .catch((error) => {
                                    console.error('Error:', error);
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
                                const quantityInput = form.querySelector('.quantity-input');
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

            </div>

            <!-- End Product Action Wrapper  -->
        </div>
    </div>
</div>
