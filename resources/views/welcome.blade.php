@extends('layouts/frontend')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5" id="home">
    <div class="owl-carousel header-carousel position-relative">
        @foreach($beranda as $i => $item)
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('./admin/img/'. $item->gambar)}}" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">
                            <h1 class="display-3 text-white animated slideInDown">{{$item->judul}}</h1>
                            <p class="fs-5 text-white mb-4 pb-2">{{$item->isi}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Carousel End -->


<!-- Service Start -->
<div class="container-xxl py-5" id="profile">
    <div class="container">
        <div class="row g-4">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success px-3">Profile</h6>
                <h1 class="mb-5">Musholla Al-Hanafiyah</h1>
            </div>
            @foreach($profile as $i => $item)
            <div class="col-lg-6 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <img class="rounded-circle mb-3" src="{{ asset('./admin/img/'.$item->logo) }}" style="width: 50px; height: 50px;">
                        <h5 class="mb-3">{{$item->judul}}</h5>
                        <p>{{$item->isi}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Struktur -->
<div class="container-xxl py-5 struktur" id="struktur">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-success px-3">Struktur</h6>
            <h1 class="mb-5">Musholla Al-Hanafiyah</h1>

            <div id="id-responsive" class="struktur">
                <img src="{{ asset('template/img/struktur-1.png')}}" style="width: 100%; height:auto; display:block; margin:auto;"></img>
            </div>
        </div>
    </div>
</div>
<!-- Struktur End -->

<!-- About Start -->
<div class="container-xxl py-2 wow fadeInUp" data-wow-delay="0.1s" id="kegiatan">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-success px-3">Kegiatan</h6>
            <h1 class="mb-5">Musholla Al-Hanafiyah</h1>
        </div>
        <div class="row g-5">
            @foreach($kegiatan as $item)
            <div class="d-flex col-lg-3 col-md-6 justify-content-center">

                <div class="card shadow " style="max-width: 14rem; width: 100%; height:100%; max-height: 23rem;">
                    <img class="card-img-top" src="{{ asset('./admin/img/'. $item->gambar) }}" style="max-height: 120px; height:100%;" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->tempat }}</h5>
                        <p class="card-text">{{ Str::limit($item->keterangan,42) }}</p>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('welcome.show', $item->id) }}">
                            <button class="btn btn-sm btn-success">Selengkapnya</button>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    <!-- About End -->

    <!-- Courses Start -->
    <div class="container-xxl py-5 mt-5" id="pengumuman">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-success  px-3">Pengumuman</h6>
                <h1 class="mb-5">Musholla Al-Hanafiyah</h1>
            </div>
            <div class="row g-5 justify-content-center">
                @foreach($pengumuman as $i => $item)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <div class="card">
                                <div class="card-header text-light bg-success">
                                    Pengumuman {{$item->tanggal}}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($item->judul,45) }}</h5>
                                    <p class="card-text">{{ Str::limit($item->isi,84) }}</p>

                                    <a href="whatsapp://send?text={{$item->tanggal}}%0A%0A{{$item->judul}}%0A%0A{{$item->isi}}"><i class="fa fa-whatsapp text-success pull-right" style="font-size: 38px; color:green"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-success px-3">Gallery</h6>
                <h1 class="mb-5">Musholla Al-Hanafiyah</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                @foreach($gambar as $item)
                <div class="testimonial-item text-center">
                    <img class="border p-2 mx-auto mb-3" src="{{ asset('./admin/img/'. $item->gambar)}}" style="width: 320px; height: 200px;">

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
    <!-- Testimonial End -->
@endsection
