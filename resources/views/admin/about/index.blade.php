@extends('admin.layout.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <form id="formAbout">
                <div class="row">
                    @csrf
                    <!-- Basic -->
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Ubah halaman Tentang</h5>

                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <label for="image" class="form-label">Gambar 1</label>
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control" id="image" />
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <img id="imagePreview" src="{{ asset('images') . '/' . $about->image }}" alt="Preview"
                                        class="img-thumbnail" style="max-width: 300px;">
                                </div>

                                <label for="image" class="form-label">Gambar 2</label>
                                <div class="input-group">
                                    <input type="file" name="image2" class="form-control" id="image2" />
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <img id="imagePreview2" src="{{ asset('images') . '/' . $about->image2 }}"
                                        alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                                </div>
                                <textarea class="form-control" name="description" id="description">{{ $about->description }}</textarea>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- / Content -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $('#description').summernote({
                placeholder: 'Hello stand alone ui',
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
        <script>
            $(document).ready(function() {
                function readURL(input, previewId) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $(previewId).attr("src", e.target.result);
                            $(previewId).css("display", "block");
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#image").change(function() {
                    readURL(this, "#imagePreview");
                });

                $("#image2").change(function() {
                    readURL(this, "#imagePreview2");
                });

                function getQuillContent() {
                    var content = quill.root.innerHTML;
                    return content;
                }

                $('#formAbout').on('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('admin.about.update') }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                        },
                        error: function(response) {
                            var message = '';
                            var obj = response.responseJSON.message;

                            if (typeof obj == 'object') {
                                $.each(obj, function(key, value) {
                                    message += '<li>' + value + '</li>';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    html: message
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    html: response.responseJSON.message,
                                });
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
