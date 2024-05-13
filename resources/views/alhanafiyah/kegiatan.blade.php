@extends('home')

@section('topbar')
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <form action="profile" method="get">
            <input type="text" id="search" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </form>
    </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <form action="profile" method="get">
                        <input type="text" id="search" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </li>

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

@section('navbar')
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3" href="/home">
        <div class="sidebar-brand-icon wow fadeInUp" data-wow-delay="0.1s">
            <img class="rounded-circle" src="{{ asset('template/img/logo.png')}}" style="width: 60px; height: 60px;">
        </div>
        <div class="sidebar-brand-text mx-2">Al-Hanafiyah</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Musholla
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Al-Hanafiyah </span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Tabel :</h6>
                <a class="collapse-item" href="/profile">Profile</a>
                <a class="collapse-item active" href="/kegiatan">Kegiatan</a>
                <a class="collapse-item" href="/pengumuman">Pengumuman</a>
                <a class="collapse-item" href="/gallery">Gallery</a>
            </div>
        </div>
    </li>

    {{-- <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Madrasah Diniyah
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Madrasah Diniyah</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Account
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Account</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
@endsection

@section('content')
<!-- Page Heading-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kegiatan</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- DataTales Example -->
@if(count($kegiatan)>0)

@else
<div class="d-block shadow mb-1">
    <div class="alert alert-danger alert-dismissible mt-3" role="alert">
        <strong>Maaf Data Tidak Tersedia</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if($create = Session::get('createKegiatan'))
<div class="d-block shadow mb-1">
    <div class="alert alert-success alert-dismissible mt-3" role="alert">
        <strong>{{ $create }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@elseif($edit = Session::get('editKegiatan'))
<div class="d-block shadow mb-1">
    <div class="alert alert-success alert-dismissible mt-3" role="alert">
        <strong>{{ $edit }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@elseif($delete = Session::get('deleteKegiatan'))
<div class="d-block shadow mb-1">
    <div class="alert alert-success alert-dismissible mt-3" role="alert">
        <strong>{{ $delete }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@elseif(count($errors) > 0)
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

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-success">
            Data Table Kegiatan
        </h6>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#createModal">
            Create
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 2%;">No</th>
                        <th style="width: 10%;">Gambar</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 15%;">Tempat</th>
                        <th style="width: 43%;">Keterangan</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan as $i => $item)
                    <tr>
                        <th class="text-center" scope="row">{{ $i + $kegiatan->firstItem() }}</th>
                        <td><img src="{{ asset('./admin/img/'.$item->gambar) }}" alt="user-avatar" class="d-block rounded" height="40" width="40"></td>
                        <td><strong>{{ Str::limit($item->tanggal,30) }}</strong></td>
                        <td><strong>{{ Str::limit($item->tempat,30) }}</strong></td>
                        <td><strong>{{ Str::limit($item->keterangan,40) }}</strong></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                Edit
                            </button>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-success" id="exampleModalLongTitle">Edit Data Kegiatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kegiatan.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label for="gambar" class="form-label">Gambar</label>
                                                    <input type="file" class="form-control" id="gambar" name="gambar" required autocomplete="gambar" value="{{ $item->gambar }}" autofocus accept="image/png, image/jpg, image/jpeg">
                                                    <i class="text-danger mb-0">!Format Harus JPG, JPEG or PNG.</i>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required autocomplete="tanggal" autofocus value="{{ $item -> tanggal }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempat" class="form-label">Tempat</label>
                                                    <input type="text" class="form-control" id="tempat" name="tempat" required autocomplete="tempat" autofocus value="{{ $item -> tempat }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan" class="form-label">Keterangan</label>
                                                    <textarea name="keterangan" id="keterangan" class="form-control" required autocomplete="keterangan" autofocus cols="30" rows="10" style="height:100px;">{{ $item -> keterangan }}</textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                Delete
                            </button>

                            <!--Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-success" id="exampleModalLabel">Delete Data Kegiatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin Ingin Menghapus Data Dengan Id {{$item->id}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm shadow-sm btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="{{ route('kegiatan.delete', $item->id) }}" method="GET">
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

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer d-flex justify-content">
                {{ $kegiatan->links() }}
            </div>
        </div>
    </div>
</div>

<!--Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLongTitle">Create Data Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required autocomplete="gambar" autofocus accept="image/png, image/jpg, image/jpeg">
                        <i class="text-danger mb-0">!Format Harus JPG, JPEG or PNG.</i>
                    </div>
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required autocomplete="tanggal" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="tempat" class="form-label">Tempat</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" required autocomplete="tempat" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" required autocomplete="keterangan" autofocus cols="30" rows="10" style="height:100px;"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Musholla Al-Hanafiyah 2023</span>
        </div>
    </div>
</footer>
@endsection
