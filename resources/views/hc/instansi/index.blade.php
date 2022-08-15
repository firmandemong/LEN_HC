@extends('layout.main')

@section('title')
    Data Instansi
@endsection

@section('sidebar')
    @include('layout.hc-sidebar')
@endsection

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Instansi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Instansi</li>
        </ol>
    </div>
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Instansi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($institutes as $institute)
                            <tr>
                                <td>{{$institute->name}}</td>
                                <td>
                                    <button id="edit-button" data-id="{{ $institute->id }}" data-name='{{$institute->name}}' data-toggle='modal' data-target='#edit-modal' class="btn btn-warning btn-sm">Edit</button> 
                                    <button id="delete-button" data-id="{{ $institute->id }}" data-toggle="modal"
                                        data-target="#delete-modal" class="btn btn-danger btn-sm ml-2">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{-- modal edit --}}
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Edit Instansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-institute-form" onkeydown="return event.key != 'Enter';" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="institute_name" class="form-label">Nama Instansi</label>
                        <input type="text" class="form-control" id="edit_institute_name" name="institute_name"
                            required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit-institute-form-button">Edit</button>
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

            $(document).on('click', '#edit-button', function() {
                $('#edit_institute_name').val($(this).attr('data-name'));
                edit_id = $(this).attr('data-id');
            });

            $(document).on('click', '#edit-institute-form-button', function() {
                var data_id = edit_id;
                var url = '/data-instansi/' + data_id;
                $('#edit-institute-form').attr('action', url);
                $('#edit-institute-form').submit();
            });

            $(document).on('click', "#delete-button", function() {
                var data_id = $(this).attr('data-id');
                var url = '/data-instansi/' + data_id;
                $('#delete-form').attr('action', url);
            });
        });
    </script>
@endsection
