@extends('admin.layout.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                aria-selected="true">
                                Home
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                aria-selected="false">
                                Profile
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#contact" aria-controls="navs-pills-top-messages" aria-selected="false">
                                Kontak
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                            <div class="form-group">
                                <label for="title" class="form-label">Nama website</label>
                                <input type="text" id="title" placeholder="Nama website" name="title"
                                    class="form-control">
                            </div>
                            <textarea name="" id="" class="form-control"></textarea>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                            <p>
                                Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                                cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice
                                cream
                                cheesecake fruitcake.
                            </p>
                            <p class="mb-0">
                                Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu
                                halvah
                                cotton candy liquorice caramels.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Email</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                            </div>
                            <p class="mb-0">
                                Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake.
                                Sweet
                                roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding
                                jelly
                                jelly-o tart brownie jelly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper -->
@endsection

@push('script')
@endpush
