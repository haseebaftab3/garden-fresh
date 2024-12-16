@extends('layout.master')
@section('title', 'About us')
@section('content')

    <!-- breadcrumb-area -->
    <x-breadcrumb title="About Us" :links="[['name' => 'Home', 'url' => route('home')], ['name' => 'About Us']]" />
    <!-- breadcrumb-area-end -->

    <section class="blog__post-area-four">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="section__title-two mb-20">
                        <h2 class="title">Latest Categories <img src="{{ asset('assets/img/images/title_shape.svg') }}"
                                alt="" class="injectable"></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="view-all-btn">
                        <a href="{{ route('category.index') }}">See All <i class="flaticon-right-arrow-angle"></i></a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @forelse ($categories as $category)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="blog__post-item-four shine-animate-item">
                            <div class="blog__post-thumb-four shine-animate">
                                <a href="{{ route('category.show', $category->slug) }}">
                                    {{-- <img src="{{ asset('assets/img/blog/' . $category->image) }}"
                                        alt="{{ $category->name }}"> --}}
                                </a>
                                <ul class="list-wrap blog__post-tag blog__post-tag-three">
                                    <li><a href="{{ route('category.index') }}">{{ $category->name }}</a></li>
                                </ul>
                            </div>
                            <div class="blog__post-content-four">
                                <div class="blog__post-meta">
                                    <ul class="list-wrap">
                                        {{-- <li><i class="flaticon-calendar"></i>{{ $category->created_at->format('d M Y') }} --}}
                                        </li>
                                        <li><i class="flaticon-user"></i>by <a href="#">admin</a></li>
                                    </ul>
                                </div>
                                <h2 class="title">
                                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No categories available</p>
                @endforelse
            </div>

            <!-- Pagination links -->
            {{-- <div class="pagination-wrapper">
                {{ $categories->links() }}
            </div> --}}
        </div>
        <div class="blog__shape-wrap-four">
            <img src="{{ asset('assets/img/blog/h4_blog_shape01.png') }}" alt="img" data-aos="fade-down-left"
                data-aos-delay="400" class="aos-init aos-animate">
            <img src="{{ asset('assets/img/blog/h4_blog_shape02.png') }}" alt="img" data-aos="fade-up-right"
                data-aos-delay="400" class="aos-init aos-animate">
        </div>
    </section>

@endsection
