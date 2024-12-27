@extends('layouts.master')
@section('title', 'Buy Premium Quality Farm-Fresh Kinnow Oranges Online – Garden Fresh Pakistan')
@section('content')

    <!-- Start Breadcrumb Area  -->
    <x-breadcrumb home-url="{{ route('home') }}" home-label="Home" current-page="My Account" title="Explore All Products"
        image="{{ asset('assets/images/bg/1.jpg') }}" image-alt="Product Thumbnail" />

    <!-- End Breadcrumb Area  -->
    <section class="flat-spacing">
        <div class="container">
            <div class="tf-shop-control d-flex justify-content-end">

                <div class="tf-control-sorting">
                    <p class="d-none d-lg-block text-caption-1">Sort by:</p>

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
                    {{-- <div class="dropdown-menu">
                            <div class="select-item" data-sort-value="best-selling">
                                <span class="text-value-item">Best selling</span>
                            </div>
                            <div class="select-item" data-sort-value="a-z">
                                <span class="text-value-item">Alphabetically, A-Z</span>
                            </div>
                            <div class="select-item" data-sort-value="z-a">
                                <span class="text-value-item">Alphabetically, Z-A</span>
                            </div>
                            <div class="select-item" data-sort-value="price-low-high">
                                <span class="text-value-item">Price, low to high</span>
                            </div>
                            <div class="select-item" data-sort-value="price-high-low">
                                <span class="text-value-item">Price, high to low</span>
                            </div>
                        </div> --}}
                </div>
            </div>
            <div class="wrapper-control-shop">
                <div class="tf-grid-layout wrapper-shop tf-col-4 position-relative" id="product-list">
                    @include('partials.product-list', ['products' => $products])
                </div>
                <div id="loader-shop"></div>
                <!-- pagination -->
                <div class="wg-pagination justify-content-center">
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" id="load-more" class="btn btn-bg-lighter btn-load-more"
                            data-last-page="{{ $products->lastPage() }}">
                            Load more
                        </a>
                        <p id="list-end" class="text-muted" style="display: none;padding:30px">No more products to
                            display.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>



    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const productList = document.getElementById('product-list');
                const loaderShop = document.getElementById('loader-shop');
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
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
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

@endsection
