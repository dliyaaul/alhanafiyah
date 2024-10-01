<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Musholla | Al-Hanafiyah An-Nahdliyah</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('template/img/logo-musholla.png')}}" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('template/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('template/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('template/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-success"><img class="rounded-circle p-2 mx-auto mb-3 mt-3" src="{{ asset('template/img/logo-musholla.png')}}" style="width: 80px; height: 80px;">
                Al-Hanafiyah
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#home" class="nav-item nav-link active">Beranda</a>
                <a href="#profile" class="nav-item nav-link">Profile</a>
                <a href="#struktur" class="nav-item nav-link">Struktur</a>
                <a href="#kegiatan" class="nav-item nav-link">Kegiatan</a>
                <a href="#pengumuman" class="nav-item nav-link">Pengumuman</a>
                <a href="#kontak" class="nav-item nav-link">Contact</a>
                {{-- @if (Route::has('login'))
                @auth
                <a href="{{ url('/home') }}" class="nav-item nav-link">Home</a>
                @else
                @endauth
                <a class="nav-item nav-link text-success" href="{{ route('login') }}">Login<i class="fa fa-arrow-right ms-3"></i></a>
                @endif --}}
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid text-light footer pt-1 mt-5 wow fadeIn" style="background-color: #696969;" data-wow-delay="0.1s"id="kontak">
        <div class="container py-5">
            <div class="row g-5 text-center">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <ul style="list-style-type: none;">
                        <li><i class="fa fa-map-marker me-3"></i>Jojoran 3A blok 7/B1, Mojo, Gubeng, Surabaya</li>
                        <li><i class="fa fa-phone me-3"></i>+62 812-3450-0858, +62 878-4970-2770</li>
                        <li><i class="fa fa-envelope me-3"></i>alhanafiyahjojoran@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Peta Lokasi</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.6847760759174!2d112.7671259144761!3d-7276663573526937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f131!3m3!1m2!1s0x2dd7fbf8dcea1257%3A0x7f8fddbcde74ded2!2sMusholla%20Al%20Hanafiah!5e0!3m2!1sid!2sid!4v1680194323036!5m2!1si!2sid" width="100%" height="100%" style="border:0; max-width:400px; max-height:300px" allowfullscreen="" loading="lazy"referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Rekening</h4>
                    <p>Belum Tersedia</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="text-center mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Al-Hanafiyah</a>, All Right Reserved.
                        Designed By <u>Pemuda Al-Hanafiyah</u><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('template/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('template/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('template/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('template/js/main.js')}}"></script>
</body>

</html>
