@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section('subheader')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Divisi</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Data Pembimbing</li>
    </ol>
</div>
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <button class="btn btn-primary mb-3">Tambah Data</button>
            <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Divisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisions as $division)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$division->name}}</td>
                        <td>
                            <a href="{{route('division.edit', $division->id)}}" button type="submit" class="btn btn-warning btn-sm">Edit</a>
                            <button button id="delete-button" data-id="{{$division->id}}" data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modal-label">Apakah anda yakin ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data yang dihapus tidak dapat dikembalikan!!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        $(document).on('click', "#delete-button", function() {
            var data_id = $(this).attr('data-id');
            var url = '/data-divisi/' + data_id;
            console.log(url);
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