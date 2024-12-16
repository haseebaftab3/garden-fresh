@extends('admin.template.master')

@section('title', 'Product Details')
@section('content')
@push('css')
<link href="{{ asset('admin-assets/assets/libs/gridjs/theme/mermaid.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin-assets/assets/libs/nouislider/nouislider.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin-assets/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
<script src="{{ asset('admin-assets/assets/libs/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/libs/wnumb/wNumb.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/libs/gridjs/gridjs.umd.js') }}"></script>
<script src="{{ asset('admin-assets/assets/libs/gridjs/plugins/selection/dist/selection.umd.js') }}"></script>
<script src="{{ asset('admin-assets/assets/js/pages/ecommerce-product-list.init.js') }}"></script>
<script src="{{ asset('admin-assets/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<script>
    var productNavSlider = new Swiper('.product-nav-slider', {
            loop: !1,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: !0,
            watchSlidesProgress: !0,
        }),
        productThubnailSlider = new Swiper('.product-thumbnail-slider', {
            loop: !1,
            spaceBetween: 24,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: productNavSlider
            },
        });
</script>
@endpush

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ $product->name ?? 'Product Details' }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $product->name ?? 'Product Details' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-lg-5">
                            <div class="col-xl-4 col-md-8 mx-auto">
                                <div class="product-img-slider sticky-side-div">
                                    <!-- Cover Image Slider -->
                                    <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                        <div class="swiper-wrapper">
                                            <!-- Cover Image -->
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $product->cover_image) }}"
                                                    alt="{{ $product->title }}" class="img-fluid d-block" />
                                            </div>
                                            <!-- Gallery Images -->
                                            @foreach ($product->gallery as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $image->image_url) }}"
                                                    alt="{{ $product->title }}" class="img-fluid d-block" />
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                    <!-- end swiper thumbnail slide -->

                                    <!-- Navigation Slider -->
                                    <div class="swiper product-nav-slider mt-2">
                                        <div class="swiper-wrapper">
                                            <!-- Cover Image in Navigation -->
                                            <div class="swiper-slide">
                                                <div class="nav-slide-item">
                                                    <img src="{{ asset('storage/' . $product->cover_image) }}"
                                                        alt="{{ $product->title }}" class="img-fluid d-block" />
                                                </div>
                                            </div>
                                            <!-- Gallery Images in Navigation -->
                                            @foreach ($product->gallery as $image)
                                            <div class="swiper-slide">
                                                <div class="nav-slide-item">
                                                    <img src="{{ asset('storage/' . $image->image_url) }}"
                                                        alt="{{ $product->title }}" class="img-fluid d-block" />
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- end swiper nav slide -->
                                </div>

                            </div>
                            <!-- end col -->

                            <div class="col-xl-8">
                                <div class="mt-xl-0 mt-5">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h4>{{ $product->title }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                Brand :
                                                <div>
                                                    <a href="#"
                                                        class="text-primary d-block">{{ $product->manufacturer_brand ?? 'Unknown Brand' }}</a>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="text-muted">
                                                    Seller :
                                                    <span
                                                        class="text-body fw-medium">{{ $product->manufacturer_name ?? 'Unknown Seller' }}</span>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="text-muted">
                                                    Published :
                                                    <span
                                                        class="text-body fw-medium">{{ $product->publish_date ? \Carbon\Carbon::parse($product->publish_date)->format('d M, Y') : \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div>
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="btn btn-light" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit">
                                                    <i class="ri-pencil-fill align-bottom"></i>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                                                                                                                            <div class="text-muted fs-16">
                                                                                                                                                <span class="mdi mdi-star text-warning"></span>
                                                                                                                                                <span class="mdi mdi-star text-warning"></span>
                                                                                                                                                <span class="mdi mdi-star text-warning"></span>
                                                                                                                                                <span class="mdi mdi-star text-warning"></span>
                                                                                                                                                <span class="mdi mdi-star text-warning"></span>
                                                                                                                                            </div>
                                                                                                                                            <div class="text-muted">
                                                                                                                                                ( 5.50k Customer Review )
                                                                                                                                            </div>
                                                                                                                                        </div> -->

                                    <div class="row mt-4">
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="p-2 border border-dashed rounded">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-success fs-24">
                                                            <i class="ri-money-dollar-circle-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Price :</p>
                                                        @if ($product->discount)
                                                        <h5 class="mb-0">
                                                            <span class="text-decoration-line-through text-danger">
                                                                Rs{{ number_format($product->price, 2) }}
                                                            </span>
                                                            Rs{{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                                                        </h5>
                                                        @else
                                                        <h5 class="mb-0">
                                                            Rs{{ number_format($product->price, 2) }}</h5>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="p-2 border border-dashed rounded">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-success fs-24">
                                                            <i class="ri-file-copy-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">
                                                            No. of Orders :
                                                        </p>
                                                        <h5 class="mb-0">{{ is_numeric($product->orders) ? number_format($product->orders) : 0 }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="p-2 border border-dashed rounded">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-success fs-24">
                                                            <i class="ri-stack-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">
                                                            Available Stocks :
                                                        </p>
                                                        <h5 class="mb-0">
                                                            {{ number_format(optional($product->stock)->quantity, 0) }}
                                                        </h5>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="p-2 border border-dashed rounded">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-success fs-24">
                                                            <i class="ri-inbox-archive-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">
                                                            Discount
                                                        </p>
                                                        <h5 class="mb-0">
                                                            {{ $product->discount !== null ? number_format($product->discount) . '%' : 'N/A' }}
                                                        </h5>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>

                                    <div class="row mt-4">
                                        <!-- Sizes -->
                                        <div class="col-xl-4">
                                            <div class="mt-4">
                                                <h5 class="fs-14">Sizes :</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if ($product->variations->where('variation_type', 'size')->isNotEmpty())
                                                    @foreach ($product->variations->where('variation_type', 'size') as $index => $variation)
                                                    @php
                                                    $stock =
                                                    $variation->variation_stock !== null
                                                    ? $variation->variation_stock
                                                    : $product->stock->quantity;
                                                    $stockStatus =
                                                    $stock > 0
                                                    ? "$stock Items Available"
                                                    : 'Out of Stock';
                                                    @endphp
                                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                        data-bs-placement="top" title="{{ $stockStatus }}">
                                                        <input type="radio" class="btn-check"
                                                            name="productsize-radio"
                                                            id="productsize-radio{{ $index }}"
                                                            {{ $stock > 0 ? '' : 'disabled' }} />


                                                        <label
                                                            class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center"
                                                            for="productsize-radio{{ $index }}">{{ strtoupper(\Illuminate\Support\Str::limit($variation->variation_value, 3, '')) }}</label>

                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <p class="text-muted">N/A</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <!-- Colors -->
                                        <div class="col-xl-4">
                                            <div class="mt-4">
                                                <h5 class="fs-14">Colors :</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if ($product->variations->where('variation_type', 'color')->isNotEmpty())
                                                    @foreach ($product->variations->where('variation_type', 'color') as $index => $variation)
                                                    @php
                                                    $stock =
                                                    $variation->variation_stock !== null
                                                    ? $variation->variation_stock
                                                    : $product->stock->quantity;
                                                    $stockStatus =
                                                    $stock > 0
                                                    ? "$stock Items Available"
                                                    : 'Out of Stock';
                                                    @endphp
                                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                        data-bs-placement="top" title="{{ $stockStatus }}">
                                                        <button type="button"
                                                            class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-{{ strtolower($variation->variation_value) }}"
                                                            {{ $stock > 0 ? '' : 'disabled' }}>
                                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                                        </button>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <p class="text-muted">N/A</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <!-- Fragrances -->
                                        <div class="col-xl-4">
                                            <div class="mt-4">
                                                <h5 class="fs-14">Fragrances :</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if ($product->variations->where('variation_type', 'fragrance')->isNotEmpty())
                                                    @foreach ($product->variations->where('variation_type', 'fragrance') as $index => $variation)
                                                    @php
                                                    $stock =
                                                    $variation->variation_stock !== null
                                                    ? $variation->variation_stock
                                                    : $product->stock->quantity;
                                                    $stockStatus =
                                                    $stock > 0
                                                    ? "$stock Items Available"
                                                    : 'Out of Stock';
                                                    @endphp
                                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                        data-bs-placement="top" title="{{ $stockStatus }}">
                                                        <input type="radio" class="btn-check"
                                                            name="productfragrance-radio"
                                                            id="productfragrance-radio{{ $index }}"
                                                            {{ $stock > 0 ? '' : 'disabled' }} />
                                                        <label
                                                            class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                                            for="productfragrance-radio{{ $index }}"
                                                            {{ $stock > 0 ? '' : 'disabled' }}>
                                                            {{ ucfirst($variation->variation_value) }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <p class="text-muted">N/A</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- end col -->
                                    </div>

                                    <!-- end row -->




                                    <div class="product-content mt-5">
                                        <h5 class="fs-14 mb-3">Product Description :</h5>
                                        <nav>
                                            <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="nav-speci-tab"
                                                        data-bs-toggle="tab" href="#nav-speci" role="tab"
                                                        aria-controls="nav-speci"
                                                        aria-selected="true">Specification</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab"
                                                        href="#nav-detail" role="tab" aria-controls="nav-detail"
                                                        aria-selected="false">Details</a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                            <!-- Specification Tab -->
                                            <div class="tab-pane fade show active" id="nav-speci" role="tabpanel"
                                                aria-labelledby="nav-speci-tab">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" style="width: 200px">Category</th>
                                                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Brand</th>
                                                                <td>{{ $product->manufacturer_brand ?? 'N/A' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Color</th>
                                                                <td>
                                                                    {{ $product->variations->where('variation_type', 'color')->pluck('variation_value')->unique()->implode(', ') ?? 'N/A' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Material</th>
                                                                <td>{{ $product->metaData->material ?? 'N/A' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Weight</th>
                                                                <td>{{ $product->weight ? $product->weight . ' Gram' : 'N/A' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Tags</th>
                                                                <td>
                                                                    {{ $product->tags->pluck('tag')->implode(', ') ?? 'N/A' }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Details Tab -->
                                            <div class="tab-pane fade" id="nav-detail" role="tabpanel"
                                                aria-labelledby="nav-detail-tab">
                                                <div>
                                                    <h5 class="font-size-16 mb-3">{{ $product->title }}</h5>
                                                    {!! $product->description !!}
                                                    <div>
                                                        <p class="mb-2">
                                                            <i
                                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                            SKU: {{ $product->sku ?? 'N/A' }}
                                                        </p>
                                                        <p class="mb-2">
                                                            <i
                                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                            Price: Rs{{ number_format($product->price, 2) }}
                                                        </p>
                                                        @if ($product->discount)
                                                        <p class="mb-2">
                                                            <i
                                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                            Discount: {{ $product->discount }}%
                                                        </p>
                                                        @endif
                                                        <p class="mb-2">
                                                            <i
                                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                            Stock: {{ $product->stock->quantity ?? 'N/A' }}
                                                        </p>
                                                        <p class="mb-0">
                                                            <i
                                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                            Return Policy:
                                                            {{ $product->return_policy ? 'Yes, within ' . $product->return_period . ' days' : 'No' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- product-content -->

                                    {{-- <div class="mt-5">
                                            <div>
                                                <h5 class="fs-14 mb-3">Ratings & Reviews</h5>
                                            </div>
                                            <div class="row gy-4 gx-0">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <div class="pb-3">
                                                            <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1">
                                                                        <div class="fs-16 align-middle text-warning">
                                                                            <i class="ri-star-fill"></i>
                                                                            <i class="ri-star-fill"></i>
                                                                            <i class="ri-star-fill"></i>
                                                                            <i class="ri-star-fill"></i>
                                                                            <i class="ri-star-half-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <h6 class="mb-0">4.5 out of 5</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <div class="text-muted">
                                                                    Total
                                                                    <span class="fw-medium">5.50k</span>
                                                                    reviews
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">5 star</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div
                                                                            class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-success"
                                                                                role="progressbar" style="width: 50.16%"
                                                                                aria-valuenow="50.16" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">2758</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">4 star</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div
                                                                            class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-success"
                                                                                role="progressbar" style="width: 19.32%"
                                                                                aria-valuenow="19.32" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">1063</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">3 star</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div
                                                                            class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-success"
                                                                                role="progressbar" style="width: 18.12%"
                                                                                aria-valuenow="18.12" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">997</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">2 star</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div
                                                                            class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-warning"
                                                                                role="progressbar" style="width: 7.42%"
                                                                                aria-valuenow="7.42" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">408</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->

                                                            <div class="row align-items-center g-2">
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0">1 star</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-2">
                                                                        <div
                                                                            class="progress animated-progress progress-sm">
                                                                            <div class="progress-bar bg-danger"
                                                                                role="progressbar" style="width: 4.98%"
                                                                                aria-valuenow="4.98" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="p-2">
                                                                        <h6 class="mb-0 text-muted">274</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end row -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->

                                                <div class="col-lg-8">
                                                    <div class="ps-lg-4">
                                                        <div class="d-flex flex-wrap align-items-start gap-3">
                                                            <h5 class="fs-14">Reviews:</h5>
                                                        </div>

                                                        <div class="me-lg-n3 pe-lg-4" data-simplebar
                                                            style="max-height: 225px">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="py-2">
                                                                    <div class="border border-dashed rounded p-3">
                                                                        <div class="d-flex align-items-start mb-3">
                                                                            <div class="hstack gap-3">
                                                                                <div
                                                                                    class="badge rounded-pill bg-success mb-0">
                                                                                    <i class="mdi mdi-star"></i> 4.2
                                                                                </div>
                                                                                <div class="vr"></div>
                                                                                <div class="flex-grow-1">
                                                                                    <p class="text-muted mb-0">
                                                                                        Superb sweatshirt. I loved it.
                                                                                        It is for winter.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="d-flex flex-grow-1 gap-2 mb-3">
                                                                            <a href="#" class="d-block">
                                                                                <img src="assets/images/small/img-12.jpg"
                                                                                    alt=""
                                                                                    class="avatar-sm rounded object-fit-cover" />
                                                                            </a>
                                                                            <a href="#" class="d-block">
                                                                                <img src="assets/images/small/img-11.jpg"
                                                                                    alt=""
                                                                                    class="avatar-sm rounded object-fit-cover" />
                                                                            </a>
                                                                            <a href="#" class="d-block">
                                                                                <img src="assets/images/small/img-10.jpg"
                                                                                    alt=""
                                                                                    class="avatar-sm rounded object-fit-cover" />
                                                                            </a>
                                                                        </div>

                                                                        <div class="d-flex align-items-end">
                                                                            <div class="flex-grow-1">
                                                                                <h5 class="fs-14 mb-0">Henry</h5>
                                                                            </div>

                                                                            <div class="flex-shrink-0">
                                                                                <p class="text-muted fs-13 mb-0">
                                                                                    12 Jul, 21
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="py-2">
                                                                    <div class="border border-dashed rounded p-3">
                                                                        <div class="d-flex align-items-start mb-3">
                                                                            <div class="hstack gap-3">
                                                                                <div
                                                                                    class="badge rounded-pill bg-success mb-0">
                                                                                    <i class="mdi mdi-star"></i> 4.0
                                                                                </div>
                                                                                <div class="vr"></div>
                                                                                <div class="flex-grow-1">
                                                                                    <p class="text-muted mb-0">
                                                                                        Great at this price, Product
                                                                                        quality and look is awesome.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-end">
                                                                            <div class="flex-grow-1">
                                                                                <h5 class="fs-14 mb-0">Nancy</h5>
                                                                            </div>

                                                                            <div class="flex-shrink-0">
                                                                                <p class="text-muted fs-13 mb-0">
                                                                                    06 Jul, 21
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="py-2">
                                                                    <div class="border border-dashed rounded p-3">
                                                                        <div class="d-flex align-items-start mb-3">
                                                                            <div class="hstack gap-3">
                                                                                <div
                                                                                    class="badge rounded-pill bg-success mb-0">
                                                                                    <i class="mdi mdi-star"></i> 4.2
                                                                                </div>
                                                                                <div class="vr"></div>
                                                                                <div class="flex-grow-1">
                                                                                    <p class="text-muted mb-0">
                                                                                        Good product. I am so happy.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-end">
                                                                            <div class="flex-grow-1">
                                                                                <h5 class="fs-14 mb-0">Joseph</h5>
                                                                            </div>

                                                                            <div class="flex-shrink-0">
                                                                                <p class="text-muted fs-13 mb-0">
                                                                                    06 Jul, 21
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="py-2">
                                                                    <div class="border border-dashed rounded p-3">
                                                                        <div class="d-flex align-items-start mb-3">
                                                                            <div class="hstack gap-3">
                                                                                <div
                                                                                    class="badge rounded-pill bg-success mb-0">
                                                                                    <i class="mdi mdi-star"></i> 4.1
                                                                                </div>
                                                                                <div class="vr"></div>
                                                                                <div class="flex-grow-1">
                                                                                    <p class="text-muted mb-0">
                                                                                        Nice Product, Good Quality.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-end">
                                                                            <div class="flex-grow-1">
                                                                                <h5 class="fs-14 mb-0">Jimmy</h5>
                                                                            </div>

                                                                            <div class="flex-shrink-0">
                                                                                <p class="text-muted fs-13 mb-0">
                                                                                    24 Jun, 21
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end Ratings & Reviews -->
                                        </div> --}}
                                    <!-- end card body -->
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
@endsection
