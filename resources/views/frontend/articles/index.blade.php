@extends('frontend/layout/app')

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Article <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Article kami</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                @foreach ($article as $item)
                    <div class="col-md-12 text-center d-flex ftco-animate">
                        <div class="blog-entry justify-content-end mb-md-5">
                            <a href="{{ route('article.show', $item->slug) }}" class="block-20 img"
                                style="background-image: url('{{ asset('assets/images/image_1.jpg') }}');">
                            </a>
                            <div class="text px-md-5 pt-4">
                                <h3 class="heading mt-2"><a href="#">{{ $item->title }}</a>
                                </h3>
                                <p>{!! Str::limit($item->content, 200) !!}
                                </p>
                                <p><a href="{{ route('article.show', $item->slug) }}" class="btn btn-primary">Lihat
                                        selengkapnya<span class="icon-long-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($article->lastPage() > 1)
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                @if ($article->currentPage() > 1)
                                    <li><a href="{{ $article->previousPageUrl() }}">&lt;</a></li>
                                @else
                                    <li class="disabled"><span>&lt;</span></li>
                                @endif

                                @php
                                    $start = max($article->currentPage() - 1, 1);
                                    $end = min($start + 2, $article->lastPage());
                                    
                                    if ($start > 1) {
                                        echo '<li><a href="' . $article->url(1) . '">1</a></li>';
                                        if ($start > 2) {
                                            echo '<li class="disabled"><span>...</span></li>';
                                        }
                                    }
                                    
                                    for ($i = $start; $i <= $end; $i++) {
                                        if ($i == $article->currentPage()) {
                                            echo '<li class="active"><span>' . $i . '</span></li>';
                                        } else {
                                            echo '<li><a href="' . $article->url($i) . '">' . $i . '</a></li>';
                                        }
                                    }
                                    
                                    if ($end < $article->lastPage()) {
                                        if ($end < $article->lastPage() - 1) {
                                            echo '<li class="disabled"><span>...</span></li>';
                                        }
                                        echo '<li><a href="' . $article->url($article->lastPage()) . '">' . $article->lastPage() . '</a></li>';
                                    }
                                @endphp

                                @if ($article->currentPage() < $article->lastPage())
                                    <li><a href="{{ $article->nextPageUrl() }}">&gt;</a></li>
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
