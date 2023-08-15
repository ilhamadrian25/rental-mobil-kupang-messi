@extends('admin.layout.app')

@section('content')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                            <h5 class="card-header">Edit - {{ $article->title }}</h5>

                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <label for="title" class="form-label">Judul</label>
                                <div class="input-group">
                                    <input type="hidden" name="id" value="{{ $article->id }}">
                                    <input type="text" id="title" class="form-control" name="title"
                                        placeholder="Judul" value="{{ $article->title }}"
                                        aria-describedby="basic-addon11" />
                                </div>
                                <label for="slug" class="form-label">Slug (Jika dikosongkan akan digenerate
                                    otomatis)</label>
                                <div class="input-group">
                                    <input type="text" id="slug" value="{{ $article->slug }}" class="form-control"
                                        name="slug" placeholder="Slug" aria-describedby="basic-addon11" />
                                </div>
                                <div class="wrapper">
                                    <label for="" class="form-label mb-0">Status</label>
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="publish"
                                            id="defaultRadio1" {{ $article->status === 'publish' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="defaultRadio1"> Publish </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio"
                                            {{ $article->status === 'draft' ? 'checked' : '' }} value="draft"
                                            id="defaultRadio2" />
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>
                                <label for="name" class="form-label">Kategori</label>
                                <div class="input-group">
                                    <select class="form-select" name="category_id" id="inputGroupSelect01">
                                        <option disabled>Kategori...</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($article->category_id === $item->id) selected @endif
                                                style="text-transform: capitalize">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="name" class="form-label">Gambar</label>
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control" id="image" />
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <img id="imagePreview" src="{{ asset('images') . '/' . $article->thumbnail }}"
                                        alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                                </div>
                                <div id="editor" name="content" class="form-control">{{ $article->content }}
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

        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow'
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
                    var data = document.getElementById('editor').textContent;
                    console.log(data);

                    formData.append('content', data);
                    $.ajax({
                        url: "{{ route('admin.article.update') }}",
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
                                window.location.href = response.redirect
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
