@extends('admin.layout.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
                            <h5 class="card-header">Buat Artikel</h5>

                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <label for="title" class="form-label">Judul</label>
                                <div class="input-group">
                                    <input type="text" id="title" class="form-control" name="title"
                                        placeholder="Judul" aria-describedby="basic-addon11" />
                                </div>
                                <label for="slug" class="form-label">Slug (Jika dikosongkan akan digenerate
                                    otomatis)</label>
                                <div class="input-group">
                                    <input type="text" id="slug" class="form-control" name="slug"
                                        placeholder="Slug" aria-describedby="basic-addon11" />
                                </div>
                                <div class="wrapper">
                                    <label for="" class="form-label mb-0">Status</label>
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="publish"
                                            id="defaultRadio1" checked />
                                        <label class="form-check-label" for="defaultRadio1"> Publish </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="draft"
                                            id="defaultRadio2" />
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>
                                <label for="name" class="form-label">Kategori</label>
                                <div class="input-group">
                                    <select class="form-select" name="category_id" id="inputGroupSelect01">
                                        <option selected disabled>Kategori...</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" style="text-transform: capitalize">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="name" class="form-label">Gambar</label>
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control" id="image" />
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <img id="imagePreview" src="#" alt="Preview" class="img-thumbnail"
                                        style="max-width: 300px; display: none;">
                                </div>
                                <textarea id="content" name="content" class="form-control"></textarea>
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
        <script>
            $('#content').summernote({
                placeholder: 'Hallo ',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $('#slug').on('input', function() {
                var title = $(this).val();
                var slug = slugify(title);

                $('#slug').val(slug);
            });
            $('#title').on('input', function() {
                var title = $(this).val();
                var slug = slugify(title);

                $('#slug').val(slug);
            });

            function slugify(text) {
                return text.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-');
            }
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
                        url: "{{ route('admin.article.store') }}",
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
                                window.location.href = "{{ route('admin.article') }}";
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
                    Swal.fire(
                        'Error',
                        'Anda tidak boleh menghapus semuanya',
                        'error',
                    );
                    return;
                }
                $(this).parent().parent().remove();
                counterFeature--;
            });
        </script>
    @endsection
