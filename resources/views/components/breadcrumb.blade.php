<div class="axil-breadcrumb-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="inner">
                    <ul class="axil-breadcrumb">
                        <li class="axil-breadcrumb-item"><a href="{{ $homeUrl }}">{{ $homeLabel }}</a></li>
                        <li class="separator"></li>
                        <li class="axil-breadcrumb-item active" aria-current="page">{{ $currentPage }}</li>
                    </ul>
                    <h1 class="title">{{ $title }}</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="inner">
                    <div class="bradcrumb-thumb">
                        <img src="{{ asset($image) }}" alt="{{ $imageAlt }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
