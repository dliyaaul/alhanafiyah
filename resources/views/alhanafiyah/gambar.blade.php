@extends('home')

@section('topbar')
<a href="/gallery" class="btn btn-success"><i class="fa fa-arrow-left ms-3"></i>&nbsp;Kembali</a>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
            <img class="img-profile rounded-circle" src="{{ asset('template/img/logo.png')}}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>
@endsection

@section('content')
<!-- Page Heading-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <ol class="breadcrumb h3 mb-0 bg-light">
        <li class="breadcrumb-item"><a href="/gallery">Gallery</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gambar</li>
    </ol>
</div>


@if(count($errors) > 0)
<div class="d-block shadow mb-1">
    <div class="alert alert-danger alert-dismissible mt-3" role="alert">
        @foreach ($errors->all() as $item)
        <strong>{{ $item }}</strong>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

<div class="container-xxl py-2 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            @foreach($gambar as $i => $item)
            <div class="card shadow mr-3" style="width: 180px;">
                <img class="card-img-top" src="{{ asset('./admin/img/'.$item->gambar) }}" style="max-height:100px;" alt="Card image cap">
                <button type="button" class="btn btn-outline-danger p-0 m-0" data-toggle="modal" data-target="#deleteGambar{{ $item->id }}">
                    <i class="fas fa-solid fa-trash"></i>
                </button>

                <!--Delete Modal -->
                <div class="modal fade" id="deleteGambar{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success" id="exampleModalLabel">Delete Gambar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Yakin Ingin Menghapus Gambar Dengan Id {{$item->id}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm shadow-sm btn-secondary" data-dismiss="modal">Close</button>
                                <form action="{{ route('gambar.delete', $item->id) }}" method="GET">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection