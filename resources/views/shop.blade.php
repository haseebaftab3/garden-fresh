@extends('layouts.master')
@section('title', 'The Pets Medic | Home')
@section('content')

    <!-- Start Breadcrumb Area  -->
    <x-breadcrumb home-url="index.html" home-label="Home" current-page="My Account" title="Explore All Products"
        image="assets/images/product/product-45.png" image-alt="Product Thumbnail" />

    <!-- End Breadcrumb Area  -->
    <!-- Start Shop Area  -->
    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="axil-shop-top">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="category-select">

                                    <!-- Category Filter -->
                                    <select id="category-filter" class="single-select">
                                        <option value="">All Categories</option>
                                        @foreach ($parentCategories as $category)
                                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Price Filter -->
                                    <select id="price-range-filter" class="single-select">
                                        <option value="">All Prices</option>
                                        @php
                                            $priceSpread = $maxPrice - $minPrice;
                                            $step = $priceSpread > 5000 ? 1000 : ($priceSpread > 1000 ? 500 : 100); // Adjust step size dynamically
                                            $startPrice = floor($minPrice / $step) * $step;
                                            $endPrice = ceil($maxPrice / $step) * $step;
                                        @endphp
                                        @for ($i = $startPrice; $i < $endPrice; $i += $step)
                                            <option value="{{ $i }}-{{ $i + $step }}">
                                                {{ number_format($i) }} - {{ number_format($i + $step) }}
                                            </option>
                                        @endfor
                                        @if ($priceSpread > 10000)
                                            <option value="{{ $endPrice }}+">Above {{ number_format($endPrice) }}
                                            </option>
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="category-select justify-content-lg-end">
                                    <!-- Sorting -->
                                    <select id="sort-by-filter" class="single-select">
                                        <option value="latest">Sort by Latest</option>
                                        {{-- <option value="popularity">Sort by Popularity</option> --}}
                                        {{-- <option value="rating">Sort by Rating</option> --}}
                                        <option value="price-asc">Price: Low to High</option>
                                        <option value="price-desc">Price: High to Low</option>
                                        <option value="new_to_old">Sort by New to Old</option>
                                        <option value="old_to_new">Sort by Old to New</option>
                                        {{-- <option value="discount">Sort by Discount</option>
                                        <option value="viewed">Sort by Most Viewed</option>
                                        <option value="bestseller">Sort by Bestsellers</option> --}}
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product List -->
                <div id="product-list" class="row row--15">
                    @include('partials.product-list', ['products' => $products])
                </div>

                <div class="text-center pt--30">
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" id="load-more"
                            class="axil-btn btn-bg-lighter btn-load-more" data-last-page="{{ $products->lastPage() }}">
                            Load more
                        </a>
                        <p id="list-end" class="text-muted" style="display: none;padding:30px">No more products to
                            display.</p>
                    @endif
                </div>





                @push('js')
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const productList = document.getElementById('product-list');
                            const loadMoreButton = document.getElementById('load-more');
                            const listEnd = document.getElementById('list-end');
                            const categoryFilter = document.getElementById('category-filter');
                            const priceFilter = document.getElementById('price-range-filter');
                            const sortByFilter = document.getElementById('sort-by-filter');
                            const loader = document.createElement('div');
                            loader.className = 'loader';
                            loader.innerHTML = `<div class="spinner"></div>`;

                            let isLoading = false;
                            let currentPage = 1;
                            let lastPage = parseInt(loadMoreButton?.dataset.lastPage || 1);

                            function showLoader() {
                                if (!productList.contains(loader)) {
                                    productList.appendChild(loader);
                                }
                            }

                            function hideLoader() {
                                if (productList.contains(loader)) {
                                    productList.removeChild(loader);
                                }
                            }

                            function fetchProducts(url, append = false) {
                                if (!isLoading && url && currentPage <= lastPage) {
                                    isLoading = true;
                                    showLoader();
                                    loadMoreButton && (loadMoreButton.style.display =
                                        'none');

                                    fetch(url, {
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            hideLoader();
                                            if (data.productHtml) {
                                                if (append) {
                                                    productList.insertAdjacentHTML('beforeend', data.productHtml);
                                                } else {
                                                    productList.innerHTML = data.productHtml;
                                                }

                                                currentPage = data.currentPage;
                                                lastPage = data.lastPage;

                                                if (currentPage >= lastPage) {
                                                    loadMoreButton && loadMoreButton.remove();
                                                    listEnd && (listEnd.style.display = 'block');
                                                } else {
                                                    loadMoreButton && (loadMoreButton.style.display = 'block');
                                                    loadMoreButton.setAttribute('href', buildPaginatedUrl(currentPage + 1));
                                                }
                                            } else {
                                                hideLoader();
                                                if (!append) {
                                                    productList.innerHTML =
                                                        '<p class="text-center" style="padding:100px 0">No products found.</p>';
                                                    listEnd && (listEnd.style.display =
                                                        'none');
                                                    loadMoreButton && loadMoreButton
                                                        .remove();
                                                }
                                            }
                                            isLoading = false;
                                        })
                                        .catch(error => {
                                            console.error('Error loading products:', error);
                                            hideLoader();
                                            loadMoreButton && (loadMoreButton.style.display = 'block');
                                            isLoading = false;
                                        });
                                }
                            }

                            function buildUrl() {
                                const currentPath = window.location.pathname; // Get the current path
                                const category = categoryFilter?.value || '';
                                const priceRange = priceFilter?.value?.split('-') || [];
                                const sortBy = sortByFilter?.value || '';
                                return `${currentPath}?category=${category}&price_min=${priceRange[0] || ''}&price_max=${priceRange[1] || ''}&sort_by=${sortBy}`;
                            }


                            function buildPaginatedUrl(page) {
                                const baseUrl = buildUrl();
                                return `${baseUrl}&page=${page}`;
                            }

                            function applyFilters() {
                                productList.innerHTML = ''; // Reset products
                                listEnd && (listEnd.style.display = 'none'); // Hide end-of-list message
                                currentPage = 1; // Reset pagination
                                loadMoreButton && loadMoreButton.setAttribute('href', buildPaginatedUrl(currentPage));
                                fetchProducts(buildUrl());
                            }

                            if (categoryFilter) {
                                categoryFilter.addEventListener('change', applyFilters);
                            }

                            if (priceFilter) {
                                priceFilter.addEventListener('change', applyFilters);
                            }

                            if (sortByFilter) {
                                sortByFilter.addEventListener('change', applyFilters);
                            }

                            if (loadMoreButton) {
                                loadMoreButton.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    if (currentPage < lastPage) {
                                        fetchProducts(loadMoreButton.getAttribute('href'), true);
                                    }
                                });
                            }

                            window.addEventListener('scroll', function() {
                                if (
                                    loadMoreButton &&
                                    currentPage < lastPage &&
                                    loadMoreButton.offsetTop - window.innerHeight <= window.scrollY + 200 &&
                                    !isLoading
                                ) {
                                    fetchProducts(loadMoreButton.getAttribute('href'), true);
                                }
                            });
                        });
                    </script>
                @endpush
                @push('css')
                    <style>
                        .loader {
                            text-align: center;
                            margin: 18px 0;
                            display: flex;
                            justify-content: center;
                        }

                        .loader .spinner {
                            border: 4px solid rgba(0, 0, 0, 0.1);
                            border-top: 4px solid #3498db;
                            border-radius: 50%;
                            width: 40px;
                            height: 40px;
                            animation: spin 1s linear infinite;
                        }

                        @keyframes spin {
                            from {
                                transform: rotate(0deg);
                            }

                            to {
                                transform: rotate(360deg);
                            }
                        }

                        #list-end {
                            margin-top: 20px;
                            font-size: 16px;
                            color: #555;
                            font-weight: 500;
                            text-align: center;
                        }
                    </style>
                @endpush
            </div>
            <!-- End .container -->
        </div>
        <!-- End Shop Area  -->
        <!-- Start Axil Newsletter Area  -->
        <div class="axil-newsletter-area axil-section-gap pt--0">
            <div class="container">
                <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                    <div class="newsletter-content">
                        <span class="title-highlighter highlighter-primary2"><i
                                class="fas fa-envelope-open"></i>Newsletter</span>
                        <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                        <div class="input-group newsletter-form">
                            <div class="position-relative newsletter-inner mb--15">
                                <input placeholder="example@gmail.com" type="text">
                            </div>
                            <button type="submit" class="axil-btn mb--15">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End Axil Newsletter Area  -->
    @endsection
