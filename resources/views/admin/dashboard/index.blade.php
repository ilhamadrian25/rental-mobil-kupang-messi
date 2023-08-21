@extends('admin.layout.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <a href="{{ route('admin.cars') }}"><i class=" bi bi-car-front-fill"></i></a>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Mobil</span>
                                    <h3 class="card-title mb-2">{{ $cars_count }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <a href="{{ route('admin.category_cars') }}"><i class="bi bi-car-front"></i></a>
                                        </div>
                                    </div>
                                    <span>Kategori Mobil</span>
                                    <h3 class="card-title text-nowrap mb-1">{{ $category_cars_count }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <a href="{{ route('admin.article') }}"><i
                                                    class="bi bi-journal-bookmark"></i></a>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">Artikel</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $article_count }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <a href="{{ route('admin.category_cars') }}"><i
                                                    class="bi bi-journal-album"></i></a>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Kategori Artikel</span>
                                    <h3 class="card-title mb-2">{{ $article_category_count }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    @endsection
