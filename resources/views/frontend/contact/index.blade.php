@extends('frontend/layout/app')

@push('title')
    <title>Kontak - Free Bootstrap 4 Template by Colorlib</title>
@endpush

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Kontak <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Kontak Kami</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-4">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-map-o"></span>
                                </div>
                                <p><span>Alamat:</span> {{ $address->address }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-mobile-phone"></span>
                                </div>
                                <p><span>Telepon:</span> <a href="tel://1234567920">{{ $address->telp }}</a></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-envelope-o"></span>
                                </div>
                                <p><span>Email:</span> <a href="mailto:info@yoursite.com">{{ $address->email }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 block-9 mb-md-5">
                    <form id="ContactForm" class="bg-light p-5">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="telp" class="form-control" placeholder="Nomor Telepon">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subjek">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="" cols="30" rows="7" class="form-control" placeholder="Pesan"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary py-3 px-5">Kirim Pesan</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div id="map" class="bg-white"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $('#ContactForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('contact.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                        }).then(function() {
                            var form = document.getElementById("ContactForm");
                            form.reset();
                        });
                    },
                    error: function(response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: response.responseJSON.message,
                        });
                    }
                });
            });

        });
    </script>
@endpush
