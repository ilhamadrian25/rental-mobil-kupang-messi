<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $page }} - {{ $settings->title }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    @stack('style')

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
                        <img src="{{ asset('logo') . '/' . $settings->logo_admin }}" class="img-fluid" alt=""
                            srcset="">
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item @if (request()->segment(2) === 'dashboard') active @endif">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">master Data</span>
                    </li>
                    @if (isset($car))
                        <li
                            class="menu-item  {{ request()->is('admin/cars') || request()->is('admin/cars/create') || request()->is('admin/cars/edit/' . $car->id) || request()->is('admin/category-cars') ? 'active open' : '' }}">
                        @else
                        <li
                            class="menu-item  {{ request()->is('admin/cars') || request()->is('admin/cars/create') || request()->is('admin/category-cars') ? 'active open' : '' }}">
                    @endif
                    <a href="" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bi bi-car-front-fill"></i>
                        <div data-i18n="Cars">Mobil</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/cars') ? 'active' : '' }}">
                            <a href="{{ route('admin.cars') }}" class="menu-link">
                                <div data-i18n="all cars">Semua mobil</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/cars/create') ? 'active' : '' }}">
                            <a href="{{ route('admin.car.create') }}" class="menu-link">
                                <div data-i18n="add car">Tambah data mobil</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/category-cars') ? 'active' : '' }}">
                            <a href="{{ route('admin.category_cars') }}" class="menu-link">
                                <div data-i18n="Notifications">Kategori mobil</div>
                            </a>
                        </li>
                    </ul>
                    </li>
                    @if (isset($article->slug))
                        <li
                            class="menu-item {{ request()->is('admin/category') || request()->is('admin/article/create') || request()->is('admin/article/edit/' . $article->slug) || request()->is('admin/article') ? 'active open' : '' }}">
                        @else
                        <li
                            class="menu-item {{ request()->is('admin/category') || request()->is('admin/article/create') || request()->is('admin/article') ? 'active open' : '' }}">
                    @endif
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bi bi-newspaper"></i>
                        <div data-i18n="article">Artikel</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/article') ? 'active' : '' }}">
                            <a href="{{ route('admin.article') }}" class="menu-link">
                                <div data-i18n="Article">Semua artikel</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/article/create') ? 'active' : '' }}">
                            <a href="{{ route('admin.article.create') }}" class="menu-link">
                                <div data-i18n="Create article">Buat artikel</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/category') ? 'active' : '' }}">
                            <a href="{{ route('admin.category') }}" class="menu-link">
                                <div data-i18n="Basic">Semua kategori</div>
                            </a>
                        </li>
                    </ul>
                    </li>
                    <li
                        class="menu-item {{ request()->fullUrlIs('*type=video*') || request()->fullUrlIs('*type=image*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon bi bi-file-earmark-image"></i>
                            <div data-i18n="article">Galeri</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->fullUrlIs('*type=image*') ? 'active' : '' }}">
                                <a href="{{ route('admin.gallery') . '?type=image' }}" class="menu-link">
                                    <div data-i18n="Article">Foto</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->fullUrlIs('*type=video*') ? 'active' : '' }}">
                                <a href="{{ route('admin.gallery') . '?type=video' }}" class="menu-link">
                                    <div data-i18n="Create article">Video</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item @if (request()->segment(2) === 'contact') active @endif">
                        <a href="{{ route('admin.contact') }}" class="menu-link">
                            <i class="menu-icon tf-icons bi bi-chat-left-dots-fill"></i>
                            <div data-i18n="Basic">Kontak</div>
                        </a>
                    </li>
                    <li class="menu-item @if (request()->segment(2) === 'client') active @endif">
                        <a href="{{ route('admin.client') }}" class="menu-link">
                            <i class="menu-icon tf-icons bi bi-people"></i>
                            <div data-i18n="Basic">Klien</div>
                        </a>
                    </li>
                    <!-- Components -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
                    <li class="menu-item @if (request()->segment(2) === 'settings') active @endif">
                        <a href="{{ route('admin.settings') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-cog"></i>
                            <div data-i18n="Settings">Pengaturan Umum</div>
                        </a>
                    </li>
                    <li class="menu-item @if (request()->segment(2) === 'about') active @endif">
                        <a href="{{ route('admin.about') }}" class="menu-link">
                            <i class="menu-icon tf-icons bi bi-file"></i>
                            <div data-i18n="Basic">Halaman About</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('images/Sample_User_Icon.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('images/Sample_User_Icon.png') }}" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                @yield('content')

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            Copyright © {{ date('Y') }} {{ $settings->title }} Developed by <a
                                href="https://inovindo.co.id" target="_blank"
                                class="footer-link fw-bolder">INOVINDO</a>. All rights reserved.
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin/assets/js/dashboards-analytics.js') }}"></script>

    @stack('script')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
