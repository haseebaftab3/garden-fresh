<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="22">
            </span>
        </a>
        <!-- Toggle button for vertical menu -->
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-menu-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>


                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}">
                        <i class="ri-dashboard-line"></i> <span>Dashboard</span>
                    </a>
                </li>

                <!-- Products -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="ri-layout-grid-line"></i> <span>Products</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link"> Product List </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.create') }}" class="nav-link"> Add New Product </a>
                            </li>
                            <!-- Updated Category Link -->
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link"> Categories </a>
                            </li>
                        </ul>
                    </div>
                </li>




                <!-- Orders -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOrders">
                        <i class="ri-file-list-3-line"></i> <span>Orders</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link"> Orders List </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSalesDiscounts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSalesDiscounts">
                        <i class="ri-price-tag-3-line"></i> <span>Sales & Discounts</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSalesDiscounts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.sales.index') }}" class="nav-link"> Sales List </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sales.create') }}" class="nav-link"> Create Sale </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.discounts.index') }}" class="nav-link"> Discounts List </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.discounts.create') }}" class="nav-link"> Create Discount </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <!-- Customers -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.customers.index') }}">
                        <i class="ri-group-line"></i> <span>Customers</span>
                    </a>
                </li>

                <!-- Sales -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSales" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSales">
                        <i class="ri-bank-card-line"></i> <span>Sales</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSales">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.sales.reports') }}" class="nav-link"> Sales Reports </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Contacts -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.contacts.index') }}">
                        <i class="ri-contacts-line"></i> <span>Contacts</span>
                    </a>
                </li>

                <!-- Analytics -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="analytics.html">
                        <i class="ri-bar-chart-box-line"></i> <span>Analytics</span>
                    </a>
                </li>

                <!-- Marketing -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMarketing" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMarketing">
                        <i class="ri-mail-send-line"></i> <span>Marketing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMarketing">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="email-campaigns.html" class="nav-link"> Email Campaigns </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="settings.html">
                        <i class="ri-settings-3-line"></i> <span>Settings</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->