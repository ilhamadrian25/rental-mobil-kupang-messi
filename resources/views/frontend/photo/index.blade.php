@extends('frontend/layout/app')

@push('title')
    <title>Foto - {{ $settings->title }}</title>
@endpush

@section('content')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>

    <script>
        // $('.portfolio-item').isotope({
        //  	itemSelector: '.item',
        //  	layoutMode: 'fitRows'
        //  });
        $('.portfolio-menu ul li').click(function() {
            $('.portfolio-menu ul li').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $('.portfolio-item').isotope({
                filter: selector
            });
            return false;
        });
        $(document).ready(function() {
            var popup_btn = $('.popup-btn');
            popup_btn.magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
    <section class="ftco-section">
        <div class="container">
            <div class="portfolio-item row">
                @foreach ($photo as $item)
                    <div class="item selfie col-lg-3 col-md-4 col-6 col-sm mt-2">
                        <a href="{{ asset('images') . '/' . $item->image }}" class="fancylight popup-btn"
                            data-fancybox-group="light">
                            <img class="img-fluid" src="{{ asset('images') . '/' . $item->image }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="container mb-5">
        @if ($photo->lastPage() > 1)
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            @if ($photo->currentPage() > 1)
                                <li><a href="{{ $photo->previousPageUrl() }}">&lt;</a></li>
                            @else
                                <li class="disabled"><span>&lt;</span></li>
                            @endif

                            @php
                                $start = max($photo->currentPage() - 1, 1);
                                $end = min($start + 2, $photo->lastPage());
                                
                                if ($start > 1) {
                                    echo '<li><a href="' . $photo->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="disabled"><span>...</span></li>';
                                    }
                                }
                                
                                for ($i = $start; $i <= $end; $i++) {
                                    if ($i == $photo->currentPage()) {
                                        echo '<li class="active"><span>' . $i . '</span></li>';
                                    } else {
                                        echo '<li><a href="' . $photo->url($i) . '">' . $i . '</a></li>';
                                    }
                                }
                                
                                if ($end < $photo->lastPage()) {
                                    if ($end < $photo->lastPage() - 1) {
                                        echo '<li class="disabled"><span>...</span></li>';
                                    }
                                    echo '<li><a href="' . $photo->url($photo->lastPage()) . '">' . $photo->lastPage() . '</a></li>';
                                }
                            @endphp

                            @if ($photo->currentPage() < $photo->lastPage())
                                <li><a href="{{ $photo->nextPageUrl() }}">&gt;</a></li>
                            @else
                                <li class="disabled"><span>&gt;</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
