@extends('admin.layout.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="ex3-tab-1" data-bs-toggle="tab" href="#general"
                                    role="tab" aria-controls="ex3-tabs-1" aria-selected="true">Umum</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ex3-tab-2" data-bs-toggle="tab" href="#ex3-tabs-2" role="tab"
                                    aria-controls="ex3-tabs-2" aria-selected="false">Logo</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ex3-tab-3" data-bs-toggle="tab" href="#ex3-tabs-3" role="tab"
                                    aria-controls="ex3-tabs-3" aria-selected="false">Kontak</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ex3-tab-3" data-bs-toggle="tab" href="#social" role="tab"
                                    aria-controls="ex3-tabs-3" aria-selected="false">Sosmed</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="ex2-content">
                            <div class="tab-pane fade show active" id="general" role="tabpanel"
                                aria-labelledby="ex3-tab-1">
                                <label for="defaultFormControlInput" class="form-label">Nama Website</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                            </div>
                            <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                                Tab 2 content Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates,
                                doloremque
                                minima mollitia sapiente illo ut harum fugit explicabo error perspiciatis at cumque nisi
                                eaque
                                commodi culpa est sed ad amet.
                            </div>
                            <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
                                Tab 3 content Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates,
                                doloremque
                                minima mollitia sapiente illo ut harum fugit explicabo error perspiciatis at cumque nisi
                                eaque
                                commodi culpa est sed ad amet.
                            </div>
                            <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social">
                                <form id="formSocialMedia">
                                    @csrf
                                    <label for="defaultFormControlInput" class="form-label">Facebook URL</label>
                                    <input type="text" class="form-control" name="facebook_url"
                                        value="{{ $social[0]->url }}" id="defaultFormControlInput"
                                        placeholder="https://facebook.com/" aria-describedby="defaultFormControlHelp" />
                                    <label for="defaultFormControlInput" class="form-label">YouTube URL</label>
                                    <input type="text" class="form-control" name="youtube_url"
                                        value="{{ $social[1]->url }}" id="defaultFormControlInput"
                                        placeholder="https://youtube.com/" aria-describedby="defaultFormControlHelp" />
                                    <label for="defaultFormControlInput" class="form-label">Instagram URL</label>
                                    <input type="text" class="form-control" name="instagram_url"
                                        value="{{ $social[2]->url }}" id="defaultFormControlInput"
                                        placeholder="https://instagram.com/" aria-describedby="defaultFormControlHelp" />
                                    <div class="mt-5 text-end">
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- / Content -->
    @endsection

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#formSocialMedia').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '{{ route('admin.social.update') }}',
                        type: 'PUT',
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Social Media Berhasil Diubah',
                            })
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Social Media Gagal Diubah',
                            })
                        }
                    })
                })
            })
        </script>
    @endpush
