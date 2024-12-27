<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
    <div class="mb-canvas-content">
        <div class="mb-body">
            <div class="mb-content-top">
                <ul class="nav-ul-mb">
                    <li class="nav-mb-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="mb-menu-link">
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-mb-item {{ Route::currentRouteName() == 'shop' ? 'active' : '' }}">
                        <a href="{{ route('shop') }}" class="mb-menu-link">
                            <span>Shop</span>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="mb-other-content">
                <ul class="mb-info">
                    <li>
                        <i class="icon icon-mail"></i>
                        <p>gardefreshpk@gmail.com</p>
                    </li>
                    <li>
                        <i class="icon icon-phone"></i>
                        <p><a href="https://wa.me/923390002134" target="_blank">+92 339 0002134 (WhatsApp)</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
