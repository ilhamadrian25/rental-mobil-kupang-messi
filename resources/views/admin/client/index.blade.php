@extends('admin.layout.app')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <style>
        .swal2-container {
            z-index: 20000 !important;
        }
    </style>
@endpush

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <button type="button"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClient">Tambah
                Klien</button>
            <div class="row py-5">
                <div class="col-12 table-responsive">
                    <table id="listContact" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Pesan</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img src="{{ asset('images') . '/' . $item->image }}" width="300" height="300"
                                            alt="Profile" class="img-fluid" srcset=""></td>
                                    <td>{{ $item->message }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a type="button" class="dropdown-item text-danger delete-client"
                                                        data-id="{{ $item->id }}">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Klien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formClient">

                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama"
                                aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="mb-3">
                            <label for="imageInput" class="form-label">Pilih Gambar</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </div>
                        <div class="mb-3 text-center">
                            <img src="https://provengraphics.com/wp-content/uploads/2018/02/300x300.png" id="imagePreview"
                                class="img-fluid" alt="Preview">
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea name="message" class="form-control" id="pesan" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Pelanggan</label>
                            <input type="text" name="position" class="form-control" id="position"
                                placeholder="Pelanggan" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    {{-- Custom Script --}}
    <script>
        $(document).ready(function() {
            new DataTable('#listContact');

            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function() {
                const file = imageInput.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });


            $('#formClient').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData($('#formClient')[0]);

                $.ajax({
                    url: "{{ route('admin.client.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses Data',
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            }
                        })
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        console.log(response.responseJSON.message);
                        if (response.messageJSON && response.messageJSON.message[0]) {
                            const errors = response.messageJSON.message;
                            // ...
                        } else {
                            console.error(
                                "Response messageJSON or message property is missing.");
                        }
                        for (const field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                const errorMessage = errors[field][0];

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: errorMessage,
                                });
                            }
                        }
                    }
                })
            })

            $(document).on('click', '.delete-client', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const row = $(this).closest('tr'); // Menyimpan referensi baris yang akan dihapus

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Kamu tidak bisa mengembalikan data ini!",
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Hapus',
                    denyButtonText: 'Jangan hapus',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.client.destroy') }}",
                            method: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    row
                                        .remove(); // Menghapus baris dari tampilan
                                });
                            },
                            error: function(data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Data gagal dihapus',
                                });
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Data tidak dihapus', '', 'info');
                    }
                });
            });
        });
    </script>
@endpush
