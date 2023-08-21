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
            <a type="button" href="{{ route('admin.article.create') }}" class="btn btn-primary">Buat Artikel</a>
            <div class="row py-5">
                <div class="col-12 table-responsive">
                    <table id="listArticle" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Thumbnail</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Tanggal dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($article as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{!! substr($item->title, 0, 50) . '...' !!}</td>
                                    <td><img src="{{ asset('images') . '/' . $item->thumbnail }}" class="img-fluid"
                                            alt="thumbnail" style="width: 100px; height: 70px"></td>
                                    @php
                                        substr($item->content, 0, 50) . '...';
                                    @endphp
                                    <td>{!! substr($item->content, 0, 50) . '...' !!}</td>
                                    <td>{!! $item->status === 'publish'
                                        ? '<span class="badge bg-success">Publish</span>'
                                        : '<span class="badge bg-warning">Draft</span>' !!}
                                    </td>
                                    <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a href="{{ route('admin.article.edit', $item->slug) }}" type="button"
                                                        class="dropdown-item">Edit</a></li>
                                                <li><a type="button" class="dropdown-item">Lihat</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a type="button" data-id="{{ $item->id }}"
                                                        class="dropdown-item text-danger delete-article">Hapus</a></li>
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
            new DataTable('#listArticle');

            $('.delete-article').on('click', function(e) {
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
                            url: "{{ route('admin.article.destroy') }}",
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
