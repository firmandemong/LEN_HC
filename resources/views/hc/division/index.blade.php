@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section('subheader')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Divisi </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Divisi</li>
    </ol>
</div>
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <button class="btn btn-primary mb-3" id="add-button" data-toggle="modal" data-target="#add-modal">Tambah Data</button>
            <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Divisi</th>
                        <th>Jumlah Kuota</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisions as $division)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$division->name}}</td>
                        <td>{{$division->quota}}</td>
                        <td>
                            <button button id="" data-id="{{$division->id}}" data-toggle="modal" data-target="" class="btn btn-success btn-sm">Detail Kuota</button>
                            <button button id="edit-button" data-id="{{$division->id}}" data-name="{{$division->name}}" data-quota="{{$division->quota}}" data-toggle="modal" data-target="#edit-modal" class="btn btn-warning btn-sm">Edit</button>
                            <button button id="delete-button" data-id="{{$division->id}}" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- modal add --}}
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-division-form" action="{{route('division.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="division_name" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="division_name" name="division_name">
                    </div>
                    <div class="mb-3">
                        <label for="division_name" class="form-label">Kuota</label>
                        <input type="text" class="form-control" id="quota" name="quota">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="add-division-form-button">Tambah</button>
            </div>
        </div>
    </div>
</div>
{{-- modal edit --}}
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Edit Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-division-form" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="division_name" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="edit_division_name" name="division_name">
                    </div>
                    <div class="mb-3">
                        <label for="division_name" class="form-label">Kuota</label>
                        <input type="text" class="form-control" id="edit_quota" name="quota">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="edit-division-form-button">Edit</button>
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
@endsection

@section('css')
<link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('js')
<script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    
    $(document).ready(function() {
        let edit_id;
        $(document).on('click', '#add-division-form-button', function(){
            $('#add-division-form').submit();
        });

        $(document).on('click', '#edit-button', function(){
            $('#edit_division_name').val($(this).attr('data-name'));
            $('#edit_quota').val($(this).attr('data-quota'));
            edit_id = $(this).attr('data-id');
        });

        $(document).on('click', '#edit-division-form-button', function(){
            var data_id = edit_id;
            var url = '/data-divisi/' + data_id;
            $('#edit-division-form').attr('action', url);
            $('#edit-division-form').submit();
        });

        $(document).on('click', "#delete-button", function() {
            var data_id = $(this).attr('data-id');
            var url = '/data-divisi/' + data_id;
            $('#delete-form').attr('action', url);
        });
    });

    $(document).ready(function() {
        $('#dataTableHover').DataTable({
            "ordering": false,
        });
    });
</script>
@endsection