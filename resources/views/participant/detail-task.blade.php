@extends('layout.main')

@section('title')
    Data Peserta
@endsection

@section('sidebar')
    @include('layout.participant-sidebar')
@endsection

@section('subheader')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Tugas</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/list-tugas">Data Tugas</a></li>
            <li class="breadcrumb-item" aria-current="page">Detail Tugas</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Judul Tugas</label>
                    <input type="text" class="form-control" value="{{ $task->title }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Tugas</label>
                    <textarea class="form-control" value="" readonly> {{ $task->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Dibuat</label>
                    <input name="task_title" type="date" value="{{ date('Y-m-d', strtotime($task->created_at)) }}"
                        class="form-control" readonly>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Upload File</h6>
            </div>
            <div class="card-body">
                @if (empty($task->getFileSubmission))
                    <form action="/task/{{ $task->id }}/upload" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control" name="file">
                        </div>
                        <button class="btn btn-primary" type="submit" style="float:right">Submit</button>
                    </form>
                @else
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a
                                        href="{{ asset('/file_submission/' . $task->getFileSubmission->file) }}">{{ $task->getFileSubmission->file }}</a>
                                </td>
                                <td>{!! \app\Models\Task::getStatusLabel($task->status) !!}</td>
                                <td><button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#konfirmasiDelete">Batalkan</button></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h5>History Pengerjaan</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Deskripsi Kegiatan</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d F Y', strtotime($history->date)) }}</td>
                                    <td>{{ $history->description }}</td>
                                    <td>{{ \App\Models\DailyTask::countTime($history->hour, $history->minute) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="konfirmasiDelete" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Batalkan Submission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/task/{{ $task->id }}/cancelUpload" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <p>Anda yakin akan membatalkan submission file?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable({
                "ordering": false,
            });

            $('#dataTableHover2').DataTable({
                "ordering": false,
            }); // I

            $('#dataTableHover3').DataTable({
                "ordering": false,
            }); // I// ID From dataTable with Hover
        });
    </script>
@endsection
