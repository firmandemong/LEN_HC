@extends('layout.main')

@section('title')
    Profile
@endsection

@section('sidebar')
    @include('layout.mentor-sidebar')
@endsection

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
@endsection

@section('content')
@include('sweetalert::alert')
<div class="col-xl-8 col-lg-7">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="">Nama Pengguna</label>
                    <input class="form-control" value="{{$user->getUser()->name}}" type="text" readonly>
                </div>
                <div class="col">
                    <label for="">Role</label>
                    <input class="form-control" value="{{$user->role}}" type="text" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="">Email Pengguna</label>
                    <input class="form-control" value="{{$user->email}}" type="email" readonly>
                </div>
                <div class="col">
                    <label for="">Password</label>
                    <input class="form-control" value="**********" type="password" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" data-toggle="modal" data-target='#edit-modal'>
                Edit Pengguna
            </button>
        </div>
    </div>
</div>

  {{-- <div class="col-xl-4 col-lg-5">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Month <i class="fas fa-chevron-down"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Select Periode</div>
            <a class="dropdown-item" href="#">Today</a>
            <a class="dropdown-item" href="#">Week</a>
            <a class="dropdown-item active" href="#">Month</a>
            <a class="dropdown-item" href="#">This Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <div class="small text-gray-500">Oblong T-Shirt
            <div class="small float-right"><b>600 of 800 Items</b></div>
          </div>
          <div class="progress" style="height: 12px;">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="small text-gray-500">Gundam 90'Editions
            <div class="small float-right"><b>500 of 800 Items</b></div>
          </div>
          <div class="progress" style="height: 12px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="small text-gray-500">Rounded Hat
            <div class="small float-right"><b>455 of 800 Items</b></div>
          </div>
          <div class="progress" style="height: 12px;">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="small text-gray-500">Indomie Goreng
            <div class="small float-right"><b>400 of 800 Items</b></div>
          </div>
          <div class="progress" style="height: 12px;">
            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="small text-gray-500">Remote Control Car Racing
            <div class="small float-right"><b>200 of 800 Items</b></div>
          </div>
          <div class="progress" style="height: 12px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
      </div>
    </div>
  </div> --}}

    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Edit Akun Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/update-profile" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="">Email Pengguna</label>
                                <input class="form-control" value="{{$user->email}}" name="email" type="email" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label for="">Password Sebelumnya</label>
                                <input class="form-control" name="password1" type="password" required>
                            </div>
                            <div class="col">
                                <label for="">Ketik ulang password sebelumnya</label>
                                <input class="form-control" type="password" name="password2" required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="">Password baru</label>
                                <input class="form-control" name="new_password1" type="password" required>
                            </div>
                            <div class="col">
                                <label for="">Ketik ulang password baru</label>
                                <input class="form-control" type="password" name="new_password2" required>
                            </div>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>

    </script>
@endsection
