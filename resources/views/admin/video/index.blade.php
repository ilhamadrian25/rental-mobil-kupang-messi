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
                Video</button>
            <div class="row py-5">
                <div class="col-12 table-responsive">
                    <table id="listVideo" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Video</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($video as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    @php
                                        $embedUrl = str_replace('youtu.be', 'www.youtube.com/embed/', $item->url);
                                    @endphp
                                    <td><iframe width="560" height="315" src="{{ $embedUrl }}" frameborder="0"
                                            allowfullscreen></iframe></td>
                                    <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a type="button" class="dropdown-item text-danger delete-video"
                                                        data-id="{{ $item->id }}" data-type="video">Delete</a></li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formVideo">

                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="url" class="form-label">Url YouTube</label>
                            <input type="text" name="url" class="form-control" id="url"
                                placeholder="harus seperti : https://youtu.be/I1ASZGaH13U"
                                aria-describedby="defaultFormControlHelp" />
                            <input type="hidden" name="type" value="video">
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
            new DataTable('#listVideo');

            $('#formVideo').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData($('#formVideo')[0]);

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

            $(document).on('click', '.delete-video', function(e) {
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
                                        .remove(); // Menghapus baris dari tampilan
                                });
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
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
