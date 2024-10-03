@extends('layouts/backend')

@section('vendorCSS')
    <link rel="stylesheet"
        href="../../assets/vendor/libs/@form-validation/form-validation.css" />
    {{-- <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" /> --}}
@endsection

@section('pageCSS')
    <link rel="stylesheet" href="../../assets/vendor/css/pages/cards-advance.css" />
@endsection

@section('menu')
    <!-- Dashboards -->
    <li class="menu-item active">
        <a href="/dashboard" class="menu-link">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Dashboards">Dashboards</div>
        </a>
    </li>

    <!-- Apps & Pages -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
    </li>

    <!-- Profile -->
    <li class="menu-item">
        <a href="/profile" class="menu-link">
            <i class="menu-icon tf-icons ti ti-address-book"></i>
            <div data-i18n="Profile">Profile</div>
            {{-- <div class="badge bg-primary rounded-pill ms-auto">5</div> --}}
        </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
            <div data-i18n="Layouts">Layouts</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item">
                <a href="layouts-collapsed-menu.html" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mail"></i>
                    <div data-i18n="Kegiatan">Kegiatan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="layouts-content-navbar.html" class="menu-link">
                    <div data-i18n="Pengumuman">Pengumuman</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Saldo -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text" data-i18n="Kas & Saldo">Kas &amp; Saldo</span>
    </li>

    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-cash"></i>
            <div data-i18n="Kas & Saldo">Kas &amp; Saldo</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item">
                <a href="layouts-collapsed-menu.html" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mail"></i>
                    <div data-i18n="Musholla">Musholla</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="layouts-content-navbar.html" class="menu-link">
                    <div data-i18n="Wakaf Tanah">Wakaf Tanah</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Gallery -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text" data-i18n="Photo & Album">Photo &amp; Album</span>
    </li>

    <li class="menu-item">
        <a href="app-email.html" class="menu-link">
            <i class="menu-icon tf-icons ti ti-album"></i>
            <div data-i18n="Album">Album</div>
        </a>
    </li>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3
        mb-4">
    Dashboard
    <button type="button" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#modalDashboard">
        <i class="ti ti-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block">Add New Record</span>
    </button>
    </h4>

    <div class="row">
        <!-- Upcoming Webinar -->
        @foreach ($beranda as $i => $item)
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="bg-label-primary rounded-3 text-center mb-3">
                            <img class="img-fluid rounded-3 shadow-lg" src="{{ asset('storage/img/' . $item->gambar) }}" alt="Card girl image"
                                width="100%" />
                        </div>
                        <h4 class="mb-2 pb-1">{{ $item->judul }}</h4>
                        <p class="small">
                            {{ $item->isi }}
                        </p>
                        <div class="row mb-3 g-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <div class="avatar flex-shrink-0 me-2">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-clock ti-md"></i></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-nowrap last-update">{{ $item->updated_at }}</h6>
                                        <small class="text-muted">Last updated</small>
                                    </div>
                                    <div class="dropdown ms-auto">
                                        <!-- Tambahkan kelas "ms-auto" untuk mendorong ke kanan -->
                                        <button class="btn p-0" type="button" id="MonthlyCampaign"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditDashboard{{ $item->id }}">Edit</a>
                                            <a href="#" class="dropdown-item delete-button" data-id="{{ $item->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalEditDashboard{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Edit Dashboard</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                 <form action="{{ route('dashboard.update', $item->id) }}" id="formValidationExamples" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-6">
                                            <label for="gambar" class="form-label">Image</label>
                                            <input type="file" id="gambar" name="gambar" class="form-control"
                                                accept="image/png, image/jpg, image/jpeg"/>
                                            @if ($item->gambar)
                                                <p>Current file: <a href="{{ asset('storage/img/' . $item->gambar) }}" target="_blank">{{ $item->gambar }}</a></p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="judul" class="form-label">Title</label>
                                            <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan Title" value="{{ $item->judul }}" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="isi" class="form-label">Content</label>
                                            <textarea class="form-control" id="isi" name="isi" rows="3">{{ $item->isi }}</textarea>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> @endforeach
    </div>
    <!--/ Upcoming Webinar -->

    <!-- Modal Dashboard -->

    <div class="modal
        fade" id="modalDashboard" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Add Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.store') }}" id="formValidationExamples" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label for="gambar" class="form-label">Image</label>
                            <input type="file" id="gambar" name="gambar" class="form-control"
                                accept="image/png, image/jpg, image/jpeg" />
                        </div>
                        <div class="col-md-6">
                            <label for="judul" class="form-label">Title</label>
                            <input type="text" id="judul" name="judul" class="form-control"
                                placeholder="Masukkan Title" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="isi" class="form-label">Content</label>
                            <textarea class="form-control" id="isi" name="isi" rows="3"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" name="submitButton" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    </div>
@endsection

@section('vendorJs')
    <script src="../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="../../assets/vendor/libs/moment/moment.js"></script>
    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/auto-focus.js"></script>
    {{-- <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script> --}}
@endsection

@section('pageJs')
    {{-- <script src="../../assets/js/form-validation.js"></script>
    <script src="../../assets/js/extended-ui-sweetalert2.js"></script> --}}

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000); // 5000 ms = 5 detik
        });
    </script>
@endsection
