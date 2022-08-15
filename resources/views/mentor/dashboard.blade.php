@extends('layout.main')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    @include('layout.mentor-sidebar')
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1">4 Januari</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">2022</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Peserta Aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participants->count() }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-primary"></i>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Tugas Belum Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tasks }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Kuota</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kuotas }}</div>
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
    <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Aktivitas Peserta Hari ini</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="40%">Nama Peserta</th>
                                    <th width="30%">Jumlah Waktu</th>
                                    <th width="30%">Aktivitas</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $participant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $participant['name'] }}</td>
                                        <td>{{ $participant['time'] }}</td>
                                        <td><button class="btn btn-sm btn-primary btn-detail-activity"
                                                data-date="{{ date('Y-m-d') }}" data-id="{{ $participant['id'] }}">Detail
                                                Aktivitas</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDetailActivity" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Detail Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-stripped">
                        <thead class="thead-light">
                            <tr>
                                <th>Deskripsi</th>
                                <th>Jumlah Waktu</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).on('click', '.btn-detail-activity', function() {
            $.get(`/activity/peserta/${$(this).attr('data-id')}/tanggal/${$(this).attr('data-date')}/all`, function(
                data) {
                $.each(data.activities, function(index) {
                    $('#table-body').append(`
                    <tr>
                        <td>${data.activities[index].description}</td>
                        <td>${data.activities[index].totalTime}</td>
                    </tr>
                `)
                })
            })
            $('#modalDetailActivity').modal('show');
        })

        $(document).on('hidden.bs.modal', '#modalDetailActivity', function() {
            $('#table-body').empty();
        })
    </script>
@endsection
