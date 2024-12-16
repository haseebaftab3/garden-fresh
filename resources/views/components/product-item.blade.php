<div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="axil-product product-style-one has-color-pick mt--40">
        <div class="thumbnail">
            <a href="{{ $detailsUrl }}">
                <img src="{{ $image }}" alt="{{ $title }}">
            </a>
            @if ($badge)
                <div class="label-block label-right">
                    <div class="product-badget">{{ $badge }}</div>
                </div>
            @endif
            <div class="product-hover-action">
                <ul class="cart-action">
                    <li class="select-option"><a href="{{ $detailsUrl }}">View Detail</a></li>
                    {{-- <li class="quickview">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view-modal"
                            data-product-id="{{ $id }}">
                            <i class="far fa-eye"></i>
                        </a>
                    </li> --}}

                </ul>
            </div>
        </div>
        <div class="product-content">
            <div class="inner">
                <h5 class="title"><a href="{{ $detailsUrl }}">{{ $title }}</a></h5>
                <div class="product-price-variant">
                    @if ((float) $oldPrice > 0)
                        <span class="price current-price">
                            Rs {{ number_format((float) $price * (1 - (float) $oldPrice / 100), 2) }}
                        </span>
                        <span class="price old-price">
                            Rs {{ number_format((float) $price, 2) }}
                        </span>
                    @else
                        <span class="price current-price">
                            Rs {{ number_format((float) $price, 2) }}
                        </span>
                    @endif
                </div>
                @if (!empty($colorVariants))
                    <div class="color-variant-wrapper">
                        <ul class="color-variant">
                            @foreach ($colorVariants as $color)
                                <li class="color-extra-{{ $loop->index + 1 }}">
                                    <span><span class="color"
                                            style="background-color: {{ $color }}"></span></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
