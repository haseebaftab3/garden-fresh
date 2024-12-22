<div class="card-product grid card-product-size" data-availability="In stock" data-brand="Garden Fresh">
    <div class="card-product-wrapper">
        <a href="{{ $detailsUrl }}" class="product-img">
            <img class="lazyload img-product" data-src="{{ $image }}" src="{{ $image }}"
                alt="{{ $title }}" />
            <img class="lazyload img-hover" data-src="{{ $image1 }}" src="{{ $image1 }}"
                alt="image-product" />
        </a>

        @if ($badge)
            <div class="on-sale-wrap">
                <span class="on-sale-item">{{ $badge }}</span>
            </div>
        @endif

        <div class="list-btn-main">
            <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
        </div>
    </div>
    <div class="card-product-info">
        <a href="{{ $detailsUrl }}" class="title link">{{ $title }}
        </a>
        <div class="price">
            @if ((float) $oldPrice > 0)
                <span class="price old-price">
                    Rs {{ number_format((float) $price, 2) }}
                </span>
                <span class="price current-price">
                    Rs {{ number_format((float) $price * (1 - (float) $oldPrice / 100), 2) }}
                </span>
            @else
                <span class="price current-price">
                    Rs {{ number_format((float) $price, 2) }}
                </span>
            @endif

        </div>
    </div>
</div>
