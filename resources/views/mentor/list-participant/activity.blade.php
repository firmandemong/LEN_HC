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
        <h1 class="h3 mb-0 text-gray-800">Report Harian</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data Tugas</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6>Peserta : {{ $participant->name }} ({{ $participant->participant_code }})</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th style="min-width:20px">#</th>
                            <th>Tanggal</th>
                            <th>Jumlah Waktu Kerja</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d F Y', strtotime($activity['date'])) }}</td>
                                <td>{{ $activity['workTime'] }}</td>
                                <td><button class="btn btn-sm btn-primary btn-detail-activity"
                                        data-date="{{ $activity['date'] }}" data-id="{{ $participant->id }}">Lihat
                                        Kegiatan</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
