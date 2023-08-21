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
                Foto</button>
            <div class="row py-5">
                <div class="col-12 table-responsive">
                    <table id="listFoto" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($image as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="{{ asset('images') . '/' . $item->image }}" alt="Foto" width="150"
                                            height="180" class="img-fluid">
                                    </td>
                                    <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a type="button" class="dropdown-item text-danger delete-image"
                                                        data-id="{{ $item->id }}" data-type="image">Delete</a></li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formFoto">

                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="imageInput" class="form-label">Pilih Gambar</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </div>
                        <input type="hidden" name="type" value="image">
                        <div class="mb-3 text-center">
                            <img src="https://provengraphics.com/wp-content/uploads/2018/02/300x300.png" id="imagePreview"
                                class="img-fluid" alt="Preview">
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
            new DataTable('#listFoto');

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

            $('#formFoto').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData($('#formFoto')[0]);

                $.ajax({
                    url: "{{ route('admin.gallery.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
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
                        var message = '';
                        var obj = response.responseJSON.message;
                        $.each(obj, function(key, value) {
                            message += '<li>' + value + '</li>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            html: message,
                        });
                    }
                })
            })

            $(document).on('click', '.delete-image', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const type = $(this).data('type');
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
                            url: "{{ route('admin.gallery.destroy') }}",
                            method: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                                type: type,
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    row
                                        .remove();
                                });
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.responseJSON.message,
                                });
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Foto tidak dihapus', '', 'info');
                    }
                });
            });
        });
    </script>
@endpush
