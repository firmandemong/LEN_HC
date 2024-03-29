@extends('layout.main')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    @include('layout.participant-sidebar')
@endsection

@section('subheader')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
@endsection

@section('content')
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">{{ date('d F') }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ date('Y') }}</div>
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
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Tugas Belum Selesai</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $notSubmittedTasks->count() }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard fa-2x text-info"></i>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jam Kerja Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTimeToday }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Jam Kerja</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTimeAll }}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kegiatan Hari ini</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="javascript:void(0)" data-toggle="modal"
                    data-target="#modalActivity">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="40%">Deskripsi</th>
                                    <th width="25%">Waktu</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayActivities as $activity)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration }}</td>
                                        <td width="40%">{{ $activity->description }} @if (!empty($activity->task_id))
                                                <b>(Tugas {{ $activity->Task->title }})</b>
                                            @endif
                                            </b></th>
                                        <td width="25%">{{ $activity->hour }} Jam {{ $activity->minute }} menit</th>
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-button"
                                                data-toggle="modal" data-target="#edit-modal"
                                                data-id='{{$activity->id}}' data-desc='{{$activity->description}}'
                                                data-task='{{$activity->task_id}}'
                                                data-hour='{{$activity->hour}}' data-minute='{{$activity->minute}}'
                                            >Edit</button>
                                            <button class="btn btn-sm btn-danger delete-button" data-id='{{$activity->id}}' data-toggle="modal" data-target="#delete-modal">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5 ">
        <div class="card">
            <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-light">Tugas Belum Selesai</h6>
            </div>
            <div>
                @if (empty($notSubmittedTasks))
                    <div class="customer-message align-items-center">
                        <p class="text-center text-muted">Data tidak ditemukan</p>
                    </div>
                @else
                    @foreach ($notSubmittedTasks as $task)
                        <div class="customer-message align-items-center">
                            <a class="font-weight-bold" href="/list-tugas/{{ $task->id }}/detail">
                                <div class="text-truncate message-title">{{ $task->description }}</div>
                                <div class="small text-gray-500 message-time font-weight-bold">Dibuat Tanggal :
                                    {{ date('d F Y', strtotime($task->created_at)) }}</div>
                            </a>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalActivity" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Tambah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/daily-activity">
                        @csrf
                        <div class="mb-3">
                            <label for="division_name" class="form-label">Deskripsi Kegiatan</label>
                            <input type="text" class="form-control" id="major_name" placeholder="Deskripsi"
                                name="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="division_name" class="form-label">Pilih Tugas </label>
                            <select name="task" id="" class="form-control">
                                <option selected disabled>Pilih Tugas</option>
                                @foreach ($tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->title }}</option>
                                @endforeach
                            </select>
                            <small>Kosongkan bila tidak berhubungan dengan tugas</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Jumlah Jam</label>
                                <input type="number" name="hour" class="form-control" min="0" value=0>
                            </div>
                            <div class="col-md-6">
                                <label for="">Jumlah Menit</label>
                                <input type="number" name="minute" class="form-control" min="0" max="59"
                                    value=0>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Edit Divisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update-quota-form" onkeydown="return event.key != 'Enter';" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="division_name" class="form-label">Deskripsi Kegiatan</label>
                            <input type="text" class="form-control" id="edit_desc" placeholder="Deskripsi"
                                name="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="division_name" class="form-label">Pilih Tugas </label>
                            <select name="task" id="edit_task" class="form-control">
                                <option value="0" selected disabled>Pilih Tugas</option>
                                @foreach ($tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->title }}</option>
                                @endforeach
                            </select>
                            <small>Kosongkan bila tidak berhubungan dengan tugas</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Jumlah Jam</label>
                                <input type="number" id="edit_hour" name="hour" class="form-control" min="0" value=0>
                            </div>
                            <div class="col-md-6">
                                <label for="">Jumlah Menit</label>
                                <input type="number" id="edit_minute" name="minute" class="form-control" min="0" max="59"
                                    value=0>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit-edit-button">Edit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Delete --> --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Apakah anda yakin ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data yang dihapus tidak dapat dikembalikan!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form id="delete-form" method="POST">
                        {{-- <form action="{{route('division.destroy', $division->id)}}" method="POST"> --}}
                        @method('delete')
                        @csrf
                        <button button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        let data_id;

        $(document).on('click', '.edit-button', function(){
            data_id = $(this).attr('data-id');
            
            $("#edit_desc").val($(this).attr('data-desc'));
            $("#edit_task").val(($(this).attr('data-task') == null || $(this).attr('data-task') == false) ? "0" : $(this).attr('data-task')).change();
            $("#edit_hour").val($(this).attr('data-hour'));
            $("#edit_minute").val($(this).attr('data-minute'));
            
        });
        
        $(document).on('click', '#submit-edit-button', function(){
            task_url = `/daily-activity/${data_id}/update`;
            $('#update-quota-form').attr('action', task_url);
            $('#update-quota-form').submit();
        });

        $(document).on('click', ".delete-button", function() {
                var data_id = $(this).attr('data-id');
                var url = '/daily-activity/' + data_id;
                $('#delete-form').attr('action', url);
        });

    });
</script>
@stop
