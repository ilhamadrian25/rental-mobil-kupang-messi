@extends('frontend/layout/app')

@push('title')
    <title>Mobil - {{ $settings->title }}</title>
@endpush

@section('content')
    {{-- <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Mobil <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Choose Your Car</h1>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                @foreach ($cars as $item)
                    <div class="col-md-4">
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end"
                                    style="background-image: url({{ asset('images/car-1.jpg') }});">
                                </div>
                                <div class="text">
                                    <h2 class="mb-2 text-center"><a href="#">{{ $item->name }}</a></h2>
                                    {{-- <div class="d-flex justify-content-center mb-3"> --}}
                                    {{-- <span class="cat">Bisa buka kunci</span> --}}
                                    {{-- <p class="price ml-auto">$500 <span>/day</span></p> --}}
                                    {{-- </div> --}}
                                    <p class="d-flex justify-content-center mb-0">
                                        <a href="https://api.whatsapp.com/send?phone={{ $address->whatsapp }}&text=Apakah+mobil+{{ $item->name }}+tersedia?"
                                            target="_blank" class="btn btn-primary py-2 mr-1">Sewa Sekarang</a>
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
                    </div>
                @endforeach
            </div>

            @if ($cars->lastPage() > 1)
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                @if ($cars->currentPage() > 1)
                                    <li><a href="{{ $cars->previousPageUrl() }}">&lt;</a></li>
                                @else
                                    <li class="disabled"><span>&lt;</span></li>
                                @endif

                                @php
                                    $start = max($cars->currentPage() - 1, 1);
                                    $end = min($start + 2, $cars->lastPage());
                                    
                                    if ($start > 1) {
                                        echo '<li><a href="' . $cars->url(1) . '">1</a></li>';
                                        if ($start > 2) {
                                            echo '<li class="disabled"><span>...</span></li>';
                                        }
                                    }
                                    
                                    for ($i = $start; $i <= $end; $i++) {
                                        if ($i == $cars->currentPage()) {
                                            echo '<li class="active"><span>' . $i . '</span></li>';
                                        } else {
                                            echo '<li><a href="' . $cars->url($i) . '">' . $i . '</a></li>';
                                        }
                                    }
                                    
                                    if ($end < $cars->lastPage()) {
                                        if ($end < $cars->lastPage() - 1) {
                                            echo '<li class="disabled"><span>...</span></li>';
                                        }
                                        echo '<li><a href="' . $cars->url($cars->lastPage()) . '">' . $cars->lastPage() . '</a></li>';
                                    }
                                @endphp

                                @if ($cars->currentPage() < $cars->lastPage())
                                    <li><a href="{{ $cars->nextPageUrl() }}">&gt;</a></li>
                                @else
                                    <li class="disabled"><span>&gt;</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
