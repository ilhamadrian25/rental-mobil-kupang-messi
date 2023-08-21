@extends('frontend/layout/app')

@push('title')
    <title>{{ $article->title }} - {{ $settings->title }}</title>
@endpush

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('images') . '/' . $article->thumbnail }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a
                                href="{{ route('article') }}">Artikel <i class="ion-ios-arrow-forward"></i></a>
                    </p>
                    <h1 class="mb-3 bread">{{ $article->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate">
                    <h2 class="mb-3">{{ $article->title }}</h2>
                    <p>
                        {!! $article->content !!}
                    </p>
                </div> <!-- .col-md-8 -->
                <div class="col-md-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Kategori</h3>
                            @foreach ($category as $item)
                                <li><a href="#">{{ $item->name }} <span>({{ $item->article_count }})</span></a>
                                </li>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>Artikel terbaru</h3>
                        @foreach ($articles as $item)
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4"
                                    style="background-image: url({{ asset('assets/images/image_1.jpg') }});"></a>
                                <div class="text">
                                    <h3 class="heading"><a
                                            href="{{ route('article.show', $item->slug) }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="meta">
                                        <div><span class="icon-calendar"></span>{{ $item->created_at }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section> <!-- .section -->
@endsection
