@extends('layouts/backend')

@section('vendorCSS')
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/flatpickr/flatpickr.css" />
@endsection

@section('pageCSS')
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/pages/cards-advance.css" />
@endsection

@section('menu')
    <!-- Dashboards -->
    <li class="menu-item">
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
    <li class="menu-item active open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
            <div data-i18n="Layouts">Layouts</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item active">
                <a href="/kegiatan" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mail"></i>
                    <div data-i18n="Kegiatan">Kegiatan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/pengumuman" class="menu-link">
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
                <a href="/saldoMusholla" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mail"></i>
                    <div data-i18n="Musholla">Musholla</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/saldoWakaf" class="menu-link">
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
        mb-4"><span class="text-muted fw-light">Layouts / </span>Kegiatan</h4>

        <div class="row">
            <!-- DataTable with Buttons -->
            <div class="card">
                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic-kegiatan table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>id</th>
                                <th>icon</th>
                                <th>title</th>
                                <th>place</th>
                                <th>date</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Modal to add new profile -->
            <div class="offcanvas offcanvas-end" id="add-new-kegiatan">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title label" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body flex-grow-1">
                    <form class="add-new-kegiatan pt-0 row g-2" id="formValidationExample" onsubmit="return false">
                        @csrf
                        <input type="hidden" id="form-id" name="id">
                        <div class="col-sm-12">
                            <label class="form-label" for="gambar">Icon</label>
                            <div class="input-group input-group-merge">
                                <span id="gambar2" class="input-group-text"><i class="ti ti-file-plus"></i></span>
                                <input type="file" id="gambar" class="form-control dt-gambar" name="gambar"
                                    aria-describedby="gambar2" accept="image/png, image/jpg, image/jpeg" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="keterangan">Title</label>
                            <div class="input-group input-group-merge">
                                <span id="keterangan2" class="input-group-text"><i class="ti ti-tags"></i></span>
                                <input type="text" id="keterangan" name="keterangan"
                                    class="form-control dt-keterangan" placeholder="Masukkan Title"
                                    aria-label="Masukkan Title" aria-describedby="keterangan2" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="tempat">Place</label>
                            <div class="input-group input-group-merge">
                                <span id="tempat2" class="input-group-text"><i class="ti ti-map-pin"></i></span>
                                <input type="text" id="tempat" name="tempat" class="form-control dt-tempat"
                                    placeholder="Masukkan Place" aria-label="Masukkan Place"
                                    aria-describedby="tempat2" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="tanggal">Date</label>
                            <div class="input-group input-group-merge">
                                <span id="tanggal2" class="input-group-text"><i class="ti ti-calendar"></i></span>
                                <input type="text" id="tanggal" name="tanggal" class="form-control dt-tanggal"
                                    placeholder="MM/DD/YY" aria-label="MM/DD/YY" aria-describedby="tanggal2" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1"
                                id="submit-button">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ DataTable with Buttons -->
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
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
@endsection

@section('pageJs')
    <script src="../../assets/js/extended-ui-sweetalert2.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../assets/js/tables-kegiatan-datatables-basic.js"></script>
@endsection
