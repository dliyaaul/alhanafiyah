<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Musholla Al-Hanafiyah</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link class="rounded-circle" href="{{ asset('template/img/logo.png')}}" rel="icon">

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

    <style>
        @media (min-width: 768px) {
            .card .card-body .indent {
                font-size: 24px;
            }
        }

        @media (max-width: 768px) {
            .card {
                width: 50%;
            }

            .card img {
                height: 200px;
            }

            .card .card-body .indent {
                font-size: 18px;
            }
        }
    </style>
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
            <h2 class="m-0 text-success"><img class="rounded-circle p-2 mx-auto mb-3 mt-3" src="{{ asset('template/img/logo.png')}}" style="width: 80px; height: 80px;">
                Al-Hanafiyah
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link">Beranda</a>
                <a href="/#profile" class="nav-item nav-link">Profile</a>
                <a href="/#struktur" class="nav-item nav-link">Struktur</a>
                <a href="/#kegiatan" class="nav-item nav-link active">Kegiatan</a>
                <a href="/#pengumuman" class="nav-item nav-link">Pengumuman</a>
                <a href="/#kontak" class="nav-item nav-link">Contact</a>
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/home') }}" class="nav-item nav-link">Home</a>
                @else
                @endauth
                <a class="nav-item nav-link text-success" href="{{ route('login') }}">Login<i class="fa fa-arrow-right ms-3"></i></a>
                @endif
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-xxl mt-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="card shadow" style="width:100%;">
                <img class="card-img-top" src="{{ asset('./admin/img/'. $view->gambar)}}" style="max-height: 350px;" alt="Card image cap">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h1 mb-0 text-gray-800">{{$view->tempat}}</h1>
                        <button class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-calendar fa-sm text-white-50"></i>&nbsp;{{$view->tanggal}}</button>
                    </div>
                    <p class="indent">{{ $view->keterangan }}</p>
                </div>
            </div>
            <!-- <div class="d-flex align-items-center justify-content-center">
                <img class="img-fluid" src="{{ asset('./admin/img/'. $view->gambar)}}" style="width: 90%; height: 40vw;" alt="">
            </div> -->
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Footer Start -->
    <div class="container-fluid text-light footer mt-5 wow fadeIn" style="background-color: #696969;" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="text-center m-0">
                    &copy; <a class="border-bottom" href="/welcome">Al-Hanafiyah</a>, All Right Reserved.
                    Designed By <u>Pemuda Al-Hanafiyah</u><br>
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