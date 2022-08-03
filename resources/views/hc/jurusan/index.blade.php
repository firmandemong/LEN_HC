@extends("layout.main")

@section('title')
Data Jurusan
@endsection

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section('subheader')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Jurusan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Data Jurusan</li>
    </ol>
</div>
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <button class="btn btn-primary mb-3" data-toggle='modal' data-target='#add-modal'>Tambah Data</button>
            <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($majors as $major)
                        <tr >
                            <td>{{$loop->iteration}}</td>
                            <td>{{$major->name}}</td>
                            <td>
                                <button button id="edit-button" data-id="{{$major->id}}" data-name="{{$major->name}}" data-toggle="modal" data-target="#edit-modal" class="btn btn-warning btn-sm">Edit</button>
                                <button button id="delete-button" data-id="{{$major->id}}" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-sm">Delete</button>
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
                <h5 class="modal-title" id="modal-label">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-major-form" action="{{route('major.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="add-major-form-button">Tambah</button>
            </div>
        </div>
    </div>
</div>
{{-- modal edit --}}
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Edit Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-major-form" onkeydown="return event.key != 'Enter';" action="" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="major_name" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="edit_major_name" name="major_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="edit-major-form-button">Edit</button>
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
                    {{-- <form action="{{route('major.destroy', $major->id)}}" method="POST"> --}}
                    @method('delete')
                    @csrf
                    <button button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
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
        let edit_id;
        $(document).on('click', '#add-major-form-button', function(){
            $('#add-major-form').submit();
        });

        $(document).on('click', '#edit-button', function(){
            $('#edit_major_name').val($(this).attr('data-name'));
            edit_id = $(this).attr('data-id');
        });
        
        $(document).on('click', '#edit-major-form-button', function(){
            var data_id = edit_id;
            var url = '/data-jurusan/' + data_id;
            $('#edit-major-form').attr('action', url);
            $('#edit-major-form').submit();
        });

        $(document).on('click', "#delete-button", function() {
            var data_id = $(this).attr('data-id');
            var url = '/data-jurusan/' + data_id;
            $('#delete-form').attr('action', url);
        });
        
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