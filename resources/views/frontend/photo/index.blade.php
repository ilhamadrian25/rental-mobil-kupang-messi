@extends('frontend/layout/app')

@section('content')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    <style>
        /* Custom styling for the photo grid */
        .photo-grid .photo-item {
            margin-bottom: 20px;
            cursor: pointer;
        }

        .photo-item img {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .photo-item img:hover {
            transform: scale(1.05);
        }

        /* Custom styling for the modal */
        .modal-content {
            background-color: transparent;
            border: none;
        }

        .modal-dialog {
            max-width: 80vw;
        }

        .modal-content img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <section class="ftco-section">
        <div class="container mt-4">
            <div class="row photo-grid">
                @foreach ($photo as $item)
                    <div class="col-md-3 photo-item" data-bs-toggle="modal" data-bs-target="#previewModal"
                        data-image="{{ asset('images') . '/' . $item->image }}">
                        <img src="{{ asset('images') . '/' . $item->image }}" alt="Photo 1">
                    </div>
                @endforeach
            </div>
        </div>

        @if ($photo->lastPage() > 1)
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            @if ($photo->currentPage() > 1)
                                <li><a href="{{ $photo->previousPageUrl() }}">&lt;</a></li>
                            @else
                                <li class="disabled"><span>&lt;</span></li>
                            @endif

                            @php
                                $start = max($photo->currentPage() - 1, 1);
                                $end = min($start + 2, $photo->lastPage());
                                
                                if ($start > 1) {
                                    echo '<li><a href="' . $photo->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="disabled"><span>...</span></li>';
                                    }
                                }
                                
                                for ($i = $start; $i <= $end; $i++) {
                                    if ($i == $photo->currentPage()) {
                                        echo '<li class="active"><span>' . $i . '</span></li>';
                                    } else {
                                        echo '<li><a href="' . $photo->url($i) . '">' . $i . '</a></li>';
                                    }
                                }
                                
                                if ($end < $photo->lastPage()) {
                                    if ($end < $photo->lastPage() - 1) {
                                        echo '<li class="disabled"><span>...</span></li>';
                                    }
                                    echo '<li><a href="' . $photo->url($photo->lastPage()) . '">' . $photo->lastPage() . '</a></li>';
                                }
                            @endphp

                            @if ($photo->currentPage() < $photo->lastPage())
                                <li><a href="{{ $photo->nextPageUrl() }}">&gt;</a></li>
                            @else
                                <li class="disabled"><span>&gt;</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Preview Modal -->
        <div class="modal fade mt-6" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="" alt="Preview" id="previewImage" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const photoItems = document.querySelectorAll('.photo-item');
            const previewImage = document.getElementById('previewImage');

            photoItems.forEach(item => {
                item.addEventListener('click', () => {
                    const imagePath = item.getAttribute('data-image');
                    previewImage.setAttribute('src', imagePath);
                });
            });
        </script>
    </section>
@endsection
