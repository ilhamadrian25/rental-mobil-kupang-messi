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
            <a type="button" href="{{ route('admin.car.create') }}" class="btn btn-primary">Tambah mobil</a>
            <div class="row py-5">
                <div class="col-12 table-responsive">
                    <table id="listCategory" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($car as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="text-transform: capitalize;">{{ $item->name }}</td>
                                    <td><img src="{{ asset('images') . '/' . $item->image }}" width="100" height="70"
                                            alt="" srcset="">
                                    </td>
                                    <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                                    <td style="text-transform: capitalize;">{{ $item->category->name }}</td>
                                    <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a type="button" href="{{ route('admin.car.edit', $item->id) }}"
                                                        class="dropdown-item text-primary"
                                                        data-id="{{ $item->id }}">Ubah</a></li>
                                                <li><a type="button" class="dropdown-item text-danger delete-category"
                                                        data-id="{{ $item->id }}">Hapus</a></li>
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
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    {{-- Custom Script --}}
    <script>
        $(document).ready(function() {
            new DataTable('#listCategory');

            $('.delete-category').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah anda yakin ingin mengahapus data ini?',
                    showDenyButton: true,
                    confirmButtonText: 'Hapus',
                    denyButtonText: 'Jangan hapus',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.car.destroy') }}",
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
                                    location.reload();
                                });
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.responseJSON.message,
                                })
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Data tidak dihapus', '', 'info')
                    }
                })
            });
        });
    </script>
@endpush

{{-- @section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <a type="button" href="{{ route('admin.car.create') }}" class="btn btn-primary">Tambah
                data mobil</a>
            <div class="row py-5">
                <div class="col-12 table-responsive">
                    <table id="listCategory" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($car as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="text-transform: capitalize;">{{ $item->name }}</td>
                                    <td><img src="{{ asset('images') . '/' . $item->image }}" width="100" height="70"
                                            alt="" srcset="">
                                    </td>
                                    <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                                    <td style="text-transform: capitalize;">{{ $item->category->name }}</td>
                                    <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a type="button" href="{{ route('admin.car.edit', $item->id) }}"
                                                        class="dropdown-item text-primary"
                                                        data-id="{{ $item->id }}">Ubah</a></li>
                                                <li><a type="button" class="dropdown-item text-danger delete-category"
                                                        data-id="{{ $item->id }}">Hapus</a></li>
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
@endsection --}}

{{-- @push('script')
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script> --}}

{{-- Custom Script --}}
{{-- 
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
                            url: "{{ route('admin.car.destroy') }}",
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
@endpush --}}
