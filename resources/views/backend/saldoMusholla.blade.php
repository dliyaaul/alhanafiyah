@extends('layouts/backend')

@section('vendorCSS')
    <link rel="stylesheet"
        href="../../assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('pageCSS')
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
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
            <div data-i18n="Layouts">Layouts</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item">
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

    <li class="menu-item active open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-cash"></i>
            <div data-i18n="Kas & Saldo">Kas &amp; Saldo</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item active">
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
        @if (session('success'))
        <div class="alert alert-success alert-dismissible d-flex align-items-center" id="alert" role="alert">
            <span class="alert-icon text-success me-2">
                <i class="ti ti-check ti-xs"></i>
            </span>

            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> @endif

        <h4 class="py-3
        mb-4">Saldo Musholla</h4>

    <div class="row">

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
    <script src="../../assets/js/form-validation.js"></script>
    <script src="../../assets/js/extended-ui-sweetalert2.js"></script>

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
