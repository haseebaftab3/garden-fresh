<header>
    <div class="tg-header__top">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-8">
                    <ul class="tg-header__top-info left-side list-wrap">
                        <li><i class="flaticon-placeholder"></i>59 Jakc Street Brooklyn, New York</li>
                        <li><i class="flaticon-mail"></i><a
                                href="mailto:Petspostinfo@gmail.com">Petspostinfo@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <ul class="tg-header__top-right list-wrap">
                        <li><i class="flaticon-phone"></i>Need help? Call Us: <a href="tel:0123456789">+ 1800 2900</a>
                        </li>
                        <li class="tg-header__top-social">
                            <ul class="list-wrap">
                                <li><a href="https://www.facebook.com/" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li><a href="https://www.whatsapp.com/" target="_blank"><i
                                            class="fab fa-whatsapp"></i></a></li>
                                <li><a href="https://www.instagram.com/" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com/" target="_blank"><i
                                            class="fab fa-youtube"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area tg-header__area-two">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tgmenu__wrap">
                        <nav class="tgmenu__nav">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="" style="height: 90px;" alt="Logo"></a>
                            </div>
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="about.html">About</a></li>
                                    @if (isset($categories) && count($categories) > 0)
                                        @foreach ($categories as $category)
                                            @if (isset($category->children) && count($category->children) > 0)
                                                <li class="menu-item-has-children">

                                                    <a
                                                        href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                                                    <ul class="sub-menu">
                                                        @foreach ($category->children as $subCategory)
                                                            <li><a
                                                                    href="{{ route('category.show', $subCategory->slug) }}">{{ $subCategory->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="dropdown-btn"><span class="plus-line"></span></div>
                                                </li>
                                            @else
                                                <!-- Link to the category page using the category's slug -->
                                                <li><a
                                                        href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif

                                    <li><a href="contact.html">contacts</a></li>
                                </ul>
                            </div>
                            <div class="tgmenu__action d-none d-md-block">
                                <ul class="list-wrap">
                                    <li class="header-search">
                                        <a href="javascript:void(0)" class="search-open-btn">
                                            <i class="flaticon-loupe"></i>
                                        </a>
                                    </li>
                                    <li class="header-cart">
                                        <a href="javascript:void(0)">
                                            <i class="flaticon-shopping-bag"></i>
                                            <span>0</span>
                                        </a>
                                    </li>
                                    <li class="header-btn login-btn"><a href="contact.html" class="btn"><i
                                                class="flaticon-user"></i>Login</a></li>
                                </ul>
                            </div>
                            <div class="mobile-nav-toggler">
                                <i class="flaticon-layout"></i>
                            </div>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn"><i class="fas fa-times"></i></div>
                            <div class="nav-logo">
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt="Logo"></a>
                            </div>
                            <div class="tgmobile__search">
                                <form action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div class="tgmobile__menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="list-wrap">
                                    <li><a href="https://www.facebook.com/" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/" target="_blank"><i
                                                class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.whatsapp.com/" target="_blank"><i
                                                class="fab fa-whatsapp"></i></a></li>
                                    <li><a href="https://www.instagram.com/" target="_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.youtube.com/" target="_blank"><i
                                                class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                    <!-- End Mobile Menu -->

                </div>
            </div>
        </div>
    </div>

    <!-- header-search -->
    <div class="search__popup">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search__wrapper">
                        <div class="search__close">
                            <button type="button" class="search-close-btn">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="search__form">
                            <form action="#">
                                <div class="search__input">
                                    <input class="search-input-field" type="text"
                                        placeholder="Type keywords here">
                                    <span class="search-focus-border"></span>
                                    <button>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentcolor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search-popup-overlay"></div>
    <!-- header-search-end -->

</header>
