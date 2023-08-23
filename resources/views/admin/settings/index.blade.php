@extends('admin.layout.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#website" aria-controls="website" aria-selected="true">
                                Website
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#logo" aria-controls="logo" aria-selected="false">
                                Logo
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#contact" aria-controls="navs-pills-top-messages" aria-selected="false">
                                Kontak
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#sosmed" aria-controls="navs-pills-top-messages" aria-selected="false">
                                Sosial Media
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#meta" aria-controls="navs-pills-top-messages" aria-selected="false">
                                Meta
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="website" role="tabpanel">
                            <form id="web">
                                <div class="tab-pane fade show active" id="website" role="tabpanel">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title" class="form-label">Nama website</label>
                                        <input type="text" id="title" value="{{ $settings->title }}"
                                            placeholder="Nama website" name="title" class="form-control">
                                    </div>
                                    <input type="hidden" name="type" value="web">
                                    <div>
                                        <label for="exampleFormControlTextarea1" class="form-label">Footer About</label>
                                        <textarea class="form-control" name="about" id="exampleFormControlTextarea1" rows="3">{{ $settings->about }}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="logo" role="tabpanel">
                            <form id="formLogo">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="image1" class="form-label">Logo</label>
                                            <br>
                                            <img id="previewImage1" src="{{ asset('logo') . '/' . $settings->logo }}"
                                                alt="Pratinjau Logo" style="max-width: 200px;">
                                            <br>
                                            <input type="file" class="form-control" id="image1" name="logo"
                                                style="display: none;">
                                            <button type="button" class="btn btn-secondary"
                                                id="uploadImage1">Unggah</button>(.png,
                                            .jpg, .jpeg, .gif, .svg)
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <input type="hidden" name="type" value="logo">
                                        <div class="mb-3">
                                            <label for="image2" class="form-label">Favicon</label>
                                            <br>
                                            <img id="previewImage2" src="{{ asset('logo') . '/' . $settings->favicon }}"
                                                alt="Pratinjau Favicon" style="max-width: 200px;">
                                            <br>
                                            <input type="file" class="form-control" id="image2" name="favicon"
                                                style="display: none;">
                                            <button type="button" class="btn btn-secondary"
                                                id="uploadImage2">Unggah</button>(.png,.icon)
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="image3" class="form-label">Logo Admin</label>
                                            <br>
                                            <img id="previewImage3"
                                                src="{{ asset('logo') . '/' . $settings->logo_admin }}"
                                                alt="Pratinjau Logo Admin" style="max-width: 200px;">
                                            <br>
                                            <input type="file" class="form-control" id="image3" name="logo_admin"
                                                style="display: none;">
                                            <button type="button" class="btn btn-secondary"
                                                id="uploadImage3">Unggah</button>(.png,
                                            .jpg, .jpeg, .gif, .svg)
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload Semua</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <form id="formContact">
                                <div>
                                    @csrf
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="address" id="address" rows="3">{{ $address->address }}</textarea>
                                </div>
                                <input type="hidden" name="type" value="contact">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Email" value="{{ $address->email }}" />
                                </div>
                                <div>
                                    <label for="telp" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" name="telp" id="telp"
                                        placeholder="Nomor Telepon" value="{{ $address->telp }}" />
                                </div>
                                <div>
                                    <label for="whatsapp" class="form-label">Whatsapp</label>
                                    <input type="text" class="form-control" name="whatsapp" id="whatsapp"
                                        placeholder="Nomor Telepon" value="{{ $address->whatsapp }}" />
                                </div>
                                <div>
                                    <label for="maps" class="form-label">Maps embed</label>
                                    <input type="text" class="form-control" name="maps" id="maps"
                                        placeholder="Nomor Telepon" value="{{ $address->maps }}" />
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    {!! $address->maps !!}
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="sosmed" role="tabpanel">
                            <form id="formSocial">
                                @csrf
                                <input type="hidden" name="type" value="sosmed">
                                <div>
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" id="facebook"
                                        placeholder="Email" value="{{ $social[0]->url }}" />
                                </div>
                                <div>
                                    <label for="youtube" class="form-label">YouTube</label>
                                    <input type="text" class="form-control" name="youtube" id="youtube"
                                        placeholder="Nomor Telepon" value="{{ $social[1]->url }}" />
                                </div>
                                <div>
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" class="form-control" name="instagram" id="instagram"
                                        placeholder="Nomor Telepon" value="{{ $social[2]->url }}" />
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="meta" role="tabpanel">
                            <form id="formMeta">
                                @csrf
                                <input type="hidden" name="type" value="meta">
                                <div>
                                    <label for="title" class="form-label">Title</label>
                                    <textarea name="title" class="form-control" id="title" cols="20" rows="2">{{ $meta->title }}</textarea>
                                </div>
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="20" rows="2">{{ $meta->description }}</textarea>
                                </div>
                                <div>
                                    <label for="keywords" class="form-label">Keywords</label>
                                    <textarea name="keywords" class="form-control" id="keywords" cols="20" rows="2">{{ $meta->keywords }}</textarea>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper -->
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const imageInputs = document.querySelectorAll('[type="file"]');
        const uploadButtons = document.querySelectorAll('[id^="uploadImage"]');
        const previewImages = document.querySelectorAll('[id^="previewImage"]');

        uploadButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                imageInputs[index].click();
            });

            imageInputs[index].addEventListener('change', function() {
                const file = imageInputs[index].files[0];
                if (file) {
                    previewImages[index].style.display = 'block';
                    previewImages[index].src = URL.createObjectURL(file);
                } else {
                    previewImages[index].style.display = 'none';
                    previewImages[index].src = '#';
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#web').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.setting.update') }}",
                    method: "PATCH",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });
                    },
                    error: function(response) {
                        var message = '';
                        var obj = response.responseJSON.message;

                        if (typeof obj === 'object') {
                            $.each(obj, function(key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.responseJSON.message,
                            });
                        }
                    }
                });
            });

            $('#formContact').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.setting.update') }}",
                    method: "PATCH",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });
                    },
                    error: function(response) {
                        var message = '';
                        var obj = response.responseJSON.message;

                        if (typeof obj === 'object') {
                            $.each(obj, function(key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.responseJSON.message,
                            });
                        }
                    }
                });
            });

            $('#formSocial').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.setting.update') }}",
                    method: "PATCH",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });
                    },
                    error: function(response) {
                        var message = '';
                        var obj = response.responseJSON.message;

                        if (typeof obj === 'object') {
                            $.each(obj, function(key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.responseJSON.message,
                            });
                        }
                    }
                });
            });

            $('#formMeta').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.setting.update') }}",
                    method: "PATCH",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });
                    },
                    error: function(response) {
                        var message = '';
                        var obj = response.responseJSON.message;

                        if (typeof obj === 'object') {
                            $.each(obj, function(key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.responseJSON.message,
                            });
                        }
                    }
                });
            });

            $('#formLogo').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                $.ajax({
                    url: "{{ route('admin.setting.post') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });
                    },
                    error: function(response) {
                        var message = '';
                        var obj = response.responseJSON.message;

                        if (typeof obj === 'object') {
                            $.each(obj, function(key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.responseJSON.message,
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
