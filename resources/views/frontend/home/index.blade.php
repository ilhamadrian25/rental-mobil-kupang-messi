@extends('frontend/layout/app')

@push('title')
    <title>Beranda - {{ $settings->title }}</title>
@endpush

@section('content')
    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ($banners as $item)
                <!-- Slides -->
                <div class="swiper-slide">
                    <img src="{{ asset('banner') . '/' . $banner->image }}" alt="slider" width="100%">
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>

    <!-- hidden -->
    <div class="d-none hero-wrap ftco-degree-bg" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                <div class="col-lg-8 ftco-animate">
                    <div class="text w-100 text-center mb-md-5 pb-md-5">
                        <h1 class="mb-4">Fast &amp; Easy Way To Rent A Car</h1>
                        <p style="font-size: 18px;">A small river named Duden flows by their place and supplies it with the
                            necessary regelialia. It is a paradisematic country, in which roasted parts</p>
                        <a href="https://www.youtube.com/watch?v=yk5UAdInbeM"
                            class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="ion-ios-play"></span>
                            </div>
                            <div class="heading-title ml-5">
                                <span>Easy steps for renting a car</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="d-none ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex align-items-center">
                            <form action="#" class="request-form ftco-animate bg-primary">
                                <h2>Make your trip</h2>
                                <div class="form-group">
                                    <label for="" class="label">Pick-up location</label>
                                    <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Drop-off location</label>
                                    <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
                                </div>
                                <div class="d-flex">
                                    <div class="form-group mr-2">
                                        <label for="" class="label">Pick-up date</label>
                                        <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
                                    </div>
                                    <div class="form-group ml-2">
                                        <label for="" class="label">Drop-off date</label>
                                        <input type="text" class="form-control" id="book_off_date" placeholder="Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Pick-up time</label>
                                    <input type="text" class="form-control" id="time_pick" placeholder="Time">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Rent A Car Now" class="btn btn-secondary py-3 px-4">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
                                <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-route"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Choose Your Pickup Location</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-handshake"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Select the Best Deal</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-rent"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Reserve Your Rental Car</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="#" class="btn btn-primary py-3 px-4">Reserve Your Perfect Car</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- hidden -->


    <section class="ftco-section ftco-about">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center"
                    style="background-image: url({{ asset('images') . '/' . $about->image }});">
                </div>
                <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section heading-section-white pl-md-5">
                        <span class="subheading">Tentang kami</span>
                        <h2 class="mb-4">Selamat datang</h2>

                        <p>{!! Str::limit($about->description, 1200) !!}</p>
                        <p><a href="{{ route('about') }}" class="btn btn-primary py-3 px-4">Lihat lebih lengkap</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">Apa yang kita tawarkan</span>
                    <h2 class="mb-2">Kendaraan Unggulan</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        @foreach ($cars as $item)
                            <div class="item">
                                <div class="car-wrap rounded ftco-animate">
                                    <div class="img rounded d-flex align-items-end"
                                        style="background-image: url({{ asset('images') . '/' . $item->image }});">
                                    </div>
                                    <div class="text">
                                        <h2 class="mb-2 text-center"><a
                                                href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp }}&text=Apakah+mobil+{{ $item->name }}+tersedia?">{{ $item->name }}</a>
                                        </h2>
                                        {{-- <div class="d-flex justify-content-center mb-3"> --}}
                                        {{-- <span class="cat">Bisa buka kunci</span> --}}
                                        {{-- <p class="price ml-auto">$500 <span>/day</span></p> --}}
                                        {{-- </div> --}}
                                        <p class="d-flex justify-content-center mb-0">
                                            <a href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp }}&text=Apakah+mobil+{{ $item->name }}+tersedia?"
                                                class="btn btn-primary py-2 mr-1">Sewa Sekarang</a>
                                        </p>
                                        @php
                                            $features = json_decode($item->features);
                                        @endphp
                                        <div class="mt-3 mb-0 border p-2">
                                            <div class="row text-dark">
                                                @foreach ($features as $feature)
                                                    <div class="col-6">
                                                        <i class="{{ $feature->icon }} mr-1"></i>
                                                        <span>{{ $feature->label }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-2">
                        <a href="{{ route('cars') }}" type="button" class="btn btn-primary">Lihat Semua mobil</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section" style="background: rgba(187, 208, 251, 1);">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Mengapa Memilih Kami?</span>
                    <h2 class="mb-3">{{ $settings->title }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-4">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="bi bi-currency-dollar"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">HARGA TERJANGKAU</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="bi bi-car-front"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">ARMADA LENGKAP</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="bi bi-person"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">DRIVER PROFESIONAL</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <img src="{{ asset('assets/images/keungulan-sewa-mobil-kupang-murah.png') }}" alt=""
                        srcset="">
                </div>
                <div class="col-md-4 col-4">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="bi bi-key"></span>
                        </div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">BISA LEPAS KUNCI</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="bi bi-trophy"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">PELAYANAN TERBAIK</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="bi bi-watch"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">TEPAT WAKTU</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <br>
    <br>

    <section class="ftco-section ftco-intro"
        style="background-image: url({{ asset('images') . '/' . $about->image2 }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6 heading-section heading-section-white ftco-animate">
                    <h2 class="mb-3">Ada Pertanyaan Lain, Silakan Hubungi Kami</h2>
                    <a href="https://api.whatsapp.com/send?phone={{ $address->whatsapp }}&text=Hallo..."
                        class="btn btn-primary btn-lg">
                        <i class="bi bi-whatsapp"></i>
                        Whatsapp
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Testimonial</span>
                    <h2 class="mb-3">Apa yang orang katakan tentang kami</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        @foreach ($clients as $item)
                            <div class="item">
                                <div class="testimony-wrap rounded text-center py-4 pb-5">
                                    <div class="user-img mb-2"
                                        style="background-image: url({{ asset('images') . '/' . $item->image }})">
                                    </div>
                                    <div class="text pt-4">
                                        <p class="mb-4">{{ $item->message }}</p>
                                        <p class="name">{{ $item->name }}</p>
                                        <span class="position">{{ $item->position }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Artikel</span>
                    <h2>Artikel terbaru</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($article as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="col-md-12 px-0 text-center d-flex ftco-animate">
                                <div class="blog-entry justify-content-end mb-md-5">
                                    <a href="{{ route('article.show', $item->slug) }}" class="block-20 img"
                                        style="background-image: url('{{ asset('images') . '/' . $item->thumbnail }}');">
                                    </a>
                                    <div class="text px-md-5 pt-4">
                                        <h3 class="heading mt-2"><a
                                                href="{{ route('article.show', $item->slug) }}">{{ $item->title }}</a>
                                        </h3>
                                        {!! Str::limit($item->content, 400) !!}
                                        <br>
                                        <div class="mt-5">

                                            <p>
                                                <a href="{{ route('article.show', $item->slug) }}"
                                                    class="btn btn-primary">Lihat
                                                    selengkapnya<span class="icon-long-arrow-right"></span></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{--
    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="60">0</strong>
                            <span>Year <br>Experienced</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="1090">0</strong>
                            <span>Total <br>Cars</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="2590">0</strong>
                            <span>Happy <br>Customers</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="67">0</strong>
                            <span>Total <br>Branches</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection


@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endpush


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    </script>
@endpush
