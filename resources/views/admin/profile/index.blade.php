@extends('admin.layout.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan /</span>Akun</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Profile</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('images/Sample_User_Icon.png') }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <form id="formInformation">
                                <div class="row">
                                    @csrf
                                    <input type="hidden" name="type" value="1">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Nama</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ Auth::user()->name }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ Auth::user()->email }}" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Ubah</button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>
                    <div class="card">
                        <h5 class="card-header">Password</h5>
                        <div class="card-body">
                            <form id="formSecurity">
                                <div class="row">
                                    @csrf
                                    <input type="hidden" name="type" value="2">
                                    <div class="mb-3 col-md-12">
                                        <div class="form-password-toggle">
                                            <label class="form-label" for="lastpassword">Password lama</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="lastpassword"
                                                    name="lastpassword"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="basic-default-password2" />
                                                <span id="basic-default-password2"
                                                    class="input-group-text cursor-pointer"><i
                                                        class="bx bx-hide"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <div class="form-password-toggle">
                                            <label class="form-label" for="password">Password baru</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="basic-default-password2" />
                                                <span id="basic-default-password2"
                                                    class="input-group-text cursor-pointer"><i
                                                        class="bx bx-hide"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <div class="form-password-toggle">
                                            <label class="form-label" for="confPassword">Konfirmasi Password baru</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="confPassword"
                                                    name="confPassword"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="basic-default-password2" />
                                                <span id="basic-default-password2"
                                                    class="input-group-text cursor-pointer"><i
                                                        class="bx bx-hide"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Ubah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#formInformation').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('admin.profile.update') }}",
                        method: "PATCH",
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: response.message,
                                icon: 'success'
                            });
                        },
                        error: function(response) {
                            var obj = response.responseJSON.message;

                            if (typeof obj === 'object') {
                                var message = '';

                                $.each(obj, function(key, value) {
                                    message += '<li>' + value + '</li>';
                                });

                                Swal.fire({
                                    title: 'Error!',
                                    html: message,
                                    icon: 'error'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    html: response.message,
                                    icon: 'error'
                                });

                            }
                        }
                    });
                });
                $('#formSecurity').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('admin.profile.update') }}",
                        method: "PATCH",
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: response.message,
                                icon: 'success'
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error: function(response) {
                            var obj = response.responseJSON.message;

                            if (typeof obj === 'object') {
                                var message = '';

                                $.each(obj, function(key, value) {
                                    message += '<li>' + value + '</li>';
                                });

                                Swal.fire({
                                    title: 'Error!',
                                    html: message,
                                    icon: 'error'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    html: response.message,
                                    icon: 'error'
                                });

                            }
                        }
                    });
                });
            });
        </script>
    @endsection
