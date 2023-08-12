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
                Kategori</button>
            <div class="row py-5">
                <div class="col-12 table-responsive">
                    <table id="listCategory" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a type="button" class="dropdown-item text-danger delete-category"
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formCategory">

                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama"
                                aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Slug (jika kosong akan digenerate otomatis)</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug"
                                aria-describedby="defaultFormControlHelp" />
                            <br>
                            <input type="text" class="form-control" id="slugOutput"
                                aria-describedby="defaultFormControlHelp" disabled />
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
            function generateSlug(title) {
                return title.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
            }

            const titleInput = document.getElementById('slug');
            const slugInput = document.getElementById('slugOutput');

            titleInput.addEventListener('input', function() {
                const title = titleInput.value;
                const generatedSlug = generateSlug(title);
                slugInput.value = generatedSlug;
            });


            new DataTable('#listCategory');

            $('#formCategory').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.category.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });
                    }
                })
            })

            $(document).on('click', '.delete-category', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const row = $(this).closest('tr');

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
                            url: "{{ route('admin.category.destroy') }}",
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
                                        .remove();
                                });
                            },
                            error: function(response, xhr) {
                                Swal.fire({
                                    icon: xhr,
                                    title: 'Gagal',
                                    text: response.responseJSON.message,
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
