@extends('layout.main')

@section('title')
    Data Peserta
@endsection

@section('sidebar')
    @include('layout.mentor-sidebar')
@endsection

@section('subheader')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Tugas</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/tugas-peserta">Data Tugas</a></li>
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
            <div class="card-body">
                <div class="card-title">
                    <h6 class="m-0 font-weight-bold text-primary">Upload File</h6>
                </div>
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
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Waktu</th>
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


    <div class="modal fade" id="create-task-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Buat Penugasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/task" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Judul Tugas</label>
                            <input name="task_title" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Tugas</label>
                            <textarea name="task_description" class="form-control" id="" required></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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
