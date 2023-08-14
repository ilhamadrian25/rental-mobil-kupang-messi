@extends('admin.layout.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <form id="formCars">
                <div class="row">
                    @csrf
                    <!-- Basic -->
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Tambah data mobil</h5>

                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" placeholder="Nama"
                                        aria-describedby="basic-addon11" />
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" class="form-control" placeholder="100"
                                        aria-label="Amount (to the nearest dollar)" />
                                    <span class="input-group-text">/Hari</span>
                                </div>
                                <div class="input-group">
                                    <select class="form-select" name="category_id" id="inputGroupSelect01">
                                        <option selected disabled>Kategori...</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control" id="image" />
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <img id="imagePreview" src="#" alt="Preview" class="img-thumbnail"
                                        style="max-width: 300px; display: none;">
                                </div>
                                <button type="button" class="btn btn-primary add-feature">Tambah</button>
                                <div class="wrapper">


                                    <div class="row original">
                                        <div class="col-4">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01"><i
                                                        class="label-icon bi bi-speedometer"></i></label>
                                                <select name="fitur[icon][]" class="form-select feature-icon"
                                                    id="inputGroupSelect01">
                                                    <option selected>Tambah fitur...</option>
                                                    @php
                                                        $options = [
                                                            'bi bi-speedometer' => 'Speedometer',
                                                            'bi bi-people' => 'User',
                                                            'bi bi-fuel-pump' => 'Bahan bakar',
                                                            'bi bi-gear' => 'Gear',
                                                        ];
                                                    @endphp

                                                    @foreach ($options as $value => $label)
                                                        <option value="{{ $value }}">
                                                            {{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" name="fitur[label][]" id="" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-danger remove-feature"><i
                                                    class="bi bi-x"></i></button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
        <!-- / Content -->


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $("#imagePreview").attr("src", e.target.result);
                            $("#imagePreview").css("display", "block");
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#image").change(function() {
                    readURL(this);
                });

                $('#formCars').on('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('admin.car.store') }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil ditambahkan'
                            }).then(function() {
                                $('#formCars')[0].reset();
                                $('#imagePreview').attr('src', '');
                                window.location.href = data.redirect;
                            })
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
                                html: message
                            });
                        }
                    });
                })
            });


            var counterFeature = 1;

            $(document).on('change', '.feature-icon', function() {
                $(this).parent().find('i').attr('class', $(this).val());
            });

            $('.add-feature').on('click', function() {
                let copyElement = $('.original:first').clone();
                $('.wrapper').append(copyElement);
                counterFeature++;
            });

            $(document).on('click', '.remove-feature', function() {
                if (counterFeature < 2) {
                    alert("Anda tidak boleh menghapus semuanya");
                    return;
                }
                $(this).parent().parent().remove();
                counterFeature--;
            });
        </script>
    @endsection
