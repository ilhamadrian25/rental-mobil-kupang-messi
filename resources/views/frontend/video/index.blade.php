@extends('frontend/layout/app')

@push('title')
    <title>
        Video - {{ $settings->title }}</title>
@endpush

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                @foreach ($video as $item)
                    <div class="col-4">
                        <iframe src="{{ str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $item->url) }}"
                            frameborder="0" allowfullscreen></iframe>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: Video -->
    <section class="container mb-5">
        @if ($video->lastPage() > 1)
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            @if ($video->currentPage() > 1)
                                <li><a href="{{ $video->previousPageUrl() }}">&lt;</a></li>
                            @else
                                <li class="disabled"><span>&lt;</span></li>
                            @endif

                            @php
                                $start = max($video->currentPage() - 1, 1);
                                $end = min($start + 2, $video->lastPage());
                                
                                if ($start > 1) {
                                    echo '<li><a href="' . $video->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="disabled"><span>...</span></li>';
                                    }
                                }
                                
                                for ($i = $start; $i <= $end; $i++) {
                                    if ($i == $video->currentPage()) {
                                        echo '<li class="active"><span>' . $i . '</span></li>';
                                    } else {
                                        echo '<li><a href="' . $video->url($i) . '">' . $i . '</a></li>';
                                    }
                                }
                                
                                if ($end < $video->lastPage()) {
                                    if ($end < $video->lastPage() - 1) {
                                        echo '<li class="disabled"><span>...</span></li>';
                                    }
                                    echo '<li><a href="' . $video->url($video->lastPage()) . '">' . $video->lastPage() . '</a></li>';
                                }
                            @endphp

                            @if ($video->currentPage() < $video->lastPage())
                                <li><a href="{{ $video->nextPageUrl() }}">&gt;</a></li>
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
