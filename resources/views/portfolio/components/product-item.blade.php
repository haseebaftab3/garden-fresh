<div class="col">
    <div class="product__item">
        <div class="product__thumb">
            <a href="{{ $detailsUrl }}"><img src="{{ $image }}" alt="{{ $title }}"></a>
            <div class="product__action">
                <a href="{{ $wishlistUrl }}"><i class="flaticon-love"></i></a>
                <a href="{{ $detailsUrl }}"><i class="flaticon-loupe"></i></a>
            </div>
            @if ($badge)
                <div class="sale-wrap">
                    <span>{{ $badge }}</span>
                </div>
            @endif
            <div class="product__add-cart">
                <a href="{{ $cartUrl }}" class="btn"><i class="flaticon-shopping-bag"></i>Add To Cart</a>
            </div>
        </div>
        <div class="product__content">
            @if (!empty($rating) && !empty($reviewsCount))
                <div class="product__reviews">
                    <div class="rating">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="{{ $i < $rating ? 'fas' : 'far' }} fa-star"></i>
                        @endfor
                    </div>
                    <span>({{ $reviewsCount }} Reviews)</span>
                </div>
            @endif

            <h4 class="title"><a href="{{ $detailsUrl }}">{{ $title }}</a></h4>
            @if ((float) $oldPrice > 0)
                <h3 class="price">
                    Rs {{ number_format((float) $price * (1 - (float) $oldPrice / 100), 2) }}
                    <del>
                        Rs {{ number_format((float) $price, 2) }}
                    </del>
                </h3>
            @else
                <h3 class="price">Rs {{ number_format((float) $price, 2) }}</h3>
            @endif

        </div>
    </div>
</div>
