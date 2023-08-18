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
                            <h5 class="card-header">Edit - {{ $car->name }}</h5>

                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <input type="hidden" name="id" value="{{ $car->id }}" hidden>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $car->name }}" name="name"
                                        placeholder="Nama" aria-describedby="basic-addon11" />
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" class="form-control" value="0"
                                        placeholder="Harga (Opsional)" value="{{ number_format($car->price, 0, ',', '.') }}"
                                        aria-label="Amount (to the nearest dollar)" />
                                    <span class="input-group-text">/Hari</span>
                                </div>
                                <div class="input-group">
                                    <select class="form-select" name="category_id" id="inputGroupSelect01">
                                        <option selected disabled>Kategori...</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id === $car->category_cars_id) @selected(true) @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control" id="image" />
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <img id="imagePreview" src="{{ asset('images') . '/' . $car->image }}" alt="Preview"
                                        class="img-thumbnail" style="max-width: 300px;">
                                </div>
                                <button type="button" class="btn btn-primary add-feature">Tambah</button>
                                <div class="wrapper">
                                    @php
                                        $arrayData = json_decode($car->features, true);
                                    @endphp
                                    @foreach ($arrayData as $item)
                                        <div class="row original">
                                            <div class="col-6 col-lg-4">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect01"><i
                                                            class="label-icon {{ $item['icon'] }}"></i></label>
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
                                                            <option value="{{ $value }}"
                                                                {{ $item['icon'] === $value ? 'selected' : '' }}>
                                                                {{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="fitur[label][]" value="{{ $item['label'] }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-danger remove-feature"><i
                                                        class="bi bi-x"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        url: "{{ route('admin.car.update') }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            }).then(function() {
                                $('#formCars')[0].reset();
                                $('#imagePreview').attr('src', '');
                                location.reload();
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
                if (counterFeature > 4) {
                    Swal.fire(
                        'Error',
                        'Terlalu banyak',
                        'error',
                    );
                    return;
                }
                let copyElement = $('.original:first').clone();
                $('.wrapper').append(copyElement);
                counterFeature++;
            });

            $(document).on('click', '.remove-feature', function() {
                if (counterFeature < 1) {
                    Swal.fire(
                        'Error',
                        'Anda tidak boleh menghapus semuanya',
                        'error',
                    );
                    return;
                }

                console.log($(this).remove());
                // counterFeature--;
            });

            /* Tanpa Rupiah */
            var tanpa_rupiah = document.getElementById('rupiah');
            tanpa_rupiah.addEventListener('keyup', function(e) {
                tanpa_rupiah.value = formatRupiah(this.value);
            });

            /* Fungsi */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        </script>
    @endsection
