@foreach ($products as $product)
    @php
        $product_discount_label = '';
        if (!empty($product->discount) && $product->discount > 0) {
            $product_discount_label = 'Sale';
        } elseif (!empty($product->updated_at) && \Carbon\Carbon::parse($product->updated_at)->diffInDays(now()) <= 5) {
            $product_discount_label = 'New';
        } elseif (
            empty($product->updated_at) &&
            !empty($product->created_at) &&
            \Carbon\Carbon::parse($product->created_at)->diffInDays(now()) <= 5
        ) {
            $product_discount_label = 'New';
        }
    @endphp

    <x-product-item image="{{ Storage::url($product->cover_image) }}"
        detailsUrl="{{ route('product.details', $product->slug) }}"
        wishlistUrl="{{ route('wishlist.add', $product->id) }}" cartUrl="{{ route('cart.add', $product->id) }}"
        badge="{{ $product_discount_label }}" rating="0" reviewsCount="0" title="{{ $product->title }}"
        price="{{ (float) $product->price }}" oldPrice="{{ $product->discount > 0 ? (float) $product->discount : '' }}"
        id="{{ $product->id }}" />
@endforeach

{{--
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quickViewLinks = document.querySelectorAll('.quickview a[data-bs-toggle="modal"]');
            const quickViewModal = document.getElementById('quick-view-modal');

            quickViewLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const productId = this.dataset.productId;

                    if (productId) {
                        handleQuickView(productId);
                    }
                });
            });

            function handleQuickView(productId) {
                showLoadingSpinner(quickViewModal);

                fetch(`/product/${productId}/quick-view`)
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        populateProductModal(data);
                    })
                    .catch(error => {
                        console.error('Error loading quick view data:', error);
                        displayErrorMessage();
                    })
                    .finally(() => {
                        hideLoadingSpinner();
                    });
            }

            function populateProductModal(data) {
                const modalContent = `
                <div class="row">
                    <div class="col-lg-10 order-lg-2">
                        ${generateLargeThumbnailSection(data)}
                    </div>
                    <div class="col-lg-2 order-lg-1">
                        ${generateSmallThumbnailSection(data)}
                    </div>
                </div>
            `;

                const modalElement = document.getElementById("QuickViewModalImageData");
                modalElement.innerHTML = modalContent;

                initializeSlickSliders();
            }

            function generateLargeThumbnailSection(data) {
                const imagesHtml = data.images?.map(imageUrl => generateThumbnailHtml(imageUrl)).join('') ||
                    '<p class="text-center">No images available</p>';
                return `
                <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                    <div id="largeThumbnailCarousel" class="slick-slider large-slider">
                        ${data.cover_image ? generateThumbnailHtml(data.cover_image) : ''}
                        ${imagesHtml}
                    </div>
                </div>
            `;
            }

            function generateSmallThumbnailSection(data) {
                const thumbnailsHtml = data.images?.map(imageUrl => generateSmallThumbnailHtml(imageUrl)).join(
                    '') ||
                    '<p>No thumbnails available</p>';
                return `
                <div id="smallThumbnailCarousel" class="slick-slider small-slider">
                    ${data.cover_image ? generateSmallThumbnailHtml(data.cover_image) : ''}
                    ${thumbnailsHtml}
                </div>
            `;
            }

            function generateThumbnailHtml(imageUrl) {
                return `
                <div class="thumbnail">
                    <a href="${imageUrl}" class="popup-zoom">
                        <img src="${imageUrl}" alt="Product Images" class="d-block w-100">
                    </a>
                    <div class="label-block label-right">
                        <div class="product-badget">20% OFF</div>
                    </div>
                </div>
            `;
            }

            function generateSmallThumbnailHtml(imageUrl) {
                return `
                <div class="small-thumb-img">
                    <img src="${imageUrl}" alt="Thumbnail Image" class="img-thumbnail">
                </div>
            `;
            }

            function initializeSlickSliders() {
                $('#largeThumbnailCarousel').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    asNavFor: '#smallThumbnailCarousel'
                });

                $('#smallThumbnailCarousel').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '#largeThumbnailCarousel',
                    dots: false,
                    focusOnSelect: true,
                    vertical: true
                });
            }

            function showLoadingSpinner(modal) {
                modal.insertAdjacentHTML('afterbegin', '<div class="loading-spinner">Loading...</div>');
            }

            function hideLoadingSpinner() {
                const spinner = quickViewModal.querySelector('.loading-spinner');
                if (spinner) spinner.remove();
            }

            function displayErrorMessage() {
                quickViewModal.innerHTML = `
                <p class="error-message">
                    Failed to load product details. Please try again later.
                </p>
            `;
            }
        });
    </script>
@endpush --}}
