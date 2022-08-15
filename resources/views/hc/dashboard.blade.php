@extends('layout.main')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    @include('layout.hc-sidebar')
@endsection

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pengajuan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $submissions }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Peserta aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participants }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pembimbing</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $mentors }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Divisi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $divisionCount }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list-alt fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-7">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sekolah/Kampus Dengan Peserta Terbanyak</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="40%">Nama</th>
                                    <th width="30%">Total Peserta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($school as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row['name'] }}</td>
                                        <td>{{ $row['totalPeserta'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-7">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Divisi Dengan Kuota Terbanyak</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="40%">Nama</th>
                                    <th width="30%">Kuota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($division as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row['name'] }}</td>
                                        <td>{{ $row['quota'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
