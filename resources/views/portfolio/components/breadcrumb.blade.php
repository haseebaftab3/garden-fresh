<section class="breadcrumb__area fix">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="breadcrumb__content">
                    <h3 class="title">{{ $title }}</h3>
                    <nav class="breadcrumb">
                        @foreach ($links as $link)
                            <span property="itemListElement" typeof="ListItem">
                                @if ($loop->last)
                                    <!-- Current page, not clickable -->
                                    <span>{{ $link['name'] }}</span>
                                @else
                                    <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                                    <span class="breadcrumb-separator">
                                        <i class="flaticon-right-arrow-angle"></i>
                                    </span>
                                @endif
                            </span>
                        @endforeach
                    </nav>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="breadcrumb__img">
                    <img src="{{ asset('assets/img/images/breadcrumb_img.png') }}" alt="img" data-aos="fade-left"
                        data-aos-delay="800">
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb__shape-wrap">
        <img src="{{ asset('assets/img/images/breadcrumb_shape01.png') }}" alt="img" data-aos="fade-down-right"
            data-aos-delay="400">
        <img src="{{ asset('assets/img/images/breadcrumb_shape02.png') }}" alt="img" data-aos="fade-up-left"
            data-aos-delay="400">
    </div>
</section>
