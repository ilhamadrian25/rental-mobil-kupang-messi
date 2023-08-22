<!DOCTYPE html>
<html lang="en">

<head>
    @stack('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @stack('styles')

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-dark" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-rental-mobil-kupang-messi-rev.png') }}" alt="logo" width="120px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @if (!request()->segment(1)) active @endif"><a href="{{ route('home') }}"
                            class="nav-link">Beranda</a></li>
                    {{-- <li class="nav-item @if (request()->segment(1) === 'services') active @endif"><a
                            href="{{ route('services') }}" class="nav-link">Layanan</a></li> --}}
                    <li class="nav-item @if (request()->segment(1) === 'cars' || request()->segment(1) === 'car') active @endif"><a href="{{ route('cars') }}"
                            class="nav-link">Mobil</a></li>
                    {{-- <li class="nav-item @if (request()->segment(1) === 'price') active @endif"><a href="{{ route('price') }}"
                            class="nav-link">Harga</a></li> --}}
                    <li
                        class="nav-item {{ request()->is('gallery/video') || request()->is('gallery/photo') ? 'active dropdown' : 'dropdown' }}">
                        <a href="{{ route('article') }}"
                            class="nav-link {{ request()->is('gallery/video') || request()->is('gallery/photo') ? 'dropdown-toggle' : 'dropdown-toggle' }}">Galeri</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ request()->is('gallery/photo') ? 'active' : '' }}"
                                href="{{ route('gallery.photo') }}">Foto</a>
                            <a class="dropdown-item {{ request()->is('gallery/video') ? 'active' : '' }}""
                                href="{{ route('gallery.video') }}">Video</a>
                        </div>
                    </li>

                    <li class="nav-item @if (request()->segment(1) === 'article') active @endif"><a
                            href="{{ route('article') }}" class="nav-link">Artikel</a></li>
                    <li class="nav-item @if (request()->segment(1) === 'contact') active @endif"><a
                            href="{{ route('contact') }}" class="nav-link">Kontak</a></li>
                    <li class="nav-item @if (request()->segment(1) === 'about') active @endif"><a href="{{ route('about') }}"
                            class="nav-link">Tentang</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('content')


    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="#" class="logo"><img
                                    src="{{ asset('logo') . '/' . $settings->logo }}" width="100" height="60"
                                    alt="" srcset=""></a></h2>
                        <p>{{ $settings->about }}</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="{{ $social[0]->url }}"><span
                                        class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="{{ $social[1]->url }}"><span
                                        class="icon-youtube"></span></a></li>
                            <li class="ftco-animate"><a href="{{ $social[2]->url }}"><span
                                        class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Punya pertanyaan?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span
                                        class="text">{{ $address->address }}</span></li>
                                <li><a href="tel:{{ $address->telp }}"><span class="icon icon-phone"></span><span
                                            class="text">{{ $address->telp }}</span></a></li>
                                <li><a
                                        href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp }}&text=Hallo..."><span
                                            class="icon fa fa-whatsapp"></span><span
                                            class="text">{{ $address->whatsapp }}</span></a></li>
                                <li><a href="mailto:{{ $address->email }}"><span
                                            class="icon icon-envelope"></span><span
                                            class="text">{{ $address->email }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3926.9755599605583!2d123.584749!3d-10.18264!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c569b631bd76741%3A0x94f6093584d434b3!2sJl.%20Klp.%2C%20Air%20Nona%2C%20Kec.%20Kota%20Raja%2C%20Kota%20Kupang%2C%20Nusa%20Tenggara%20Tim.!5e0!3m2!1sid!2sid!4v1691215348454!5m2!1sid!2sid"
                            width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | {{ $settings->title }} <i
                            class="icon-heart color-danger" aria-hidden="true"></i> Developed by <a
                            href="https://inovindo.co.id" target="_blank">INOVINDO</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="https://use.fontawesome.com/1ef5390edc.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('assets/js/google-map.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('script')

</body>

</html>
