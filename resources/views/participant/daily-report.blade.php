@extends("layout.main")

@section('title')
Data Peserta
@endsection

@section('sidebar')
@include('layout.participant-sidebar')
@endsection

@section('subheader')
@include('sweetalert::alert')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Tugas</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Data Tugas</li>
    </ol>
</div>
@endsection

@section("content")
<div class="col-lg-12">
    <div class="card">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                <thead class="thead-light">
                    <th style="min-width:20px">#</th>
                    <th>Tanggal</th>
                    <th>Jumlah Waktu Kerja</th>
                    <th>Activity</th>
                </thead>
                <tbody>
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
@stop

@section('css')
<link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
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