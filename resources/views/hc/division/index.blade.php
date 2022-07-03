@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="text-dark text-center"> Data Divisi </h5>
                <center><a href="{{route('division.create')}}" class="btn btn-primary btn-sm mb-4">Tambah</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
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
    </div>
</div>
<!-- Table End -->
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

@section('js')
<script>
$(document).ready(function () {
    $(document).on('click', "#delete-button", function() {
        var data_id = $(this).attr('data-id');
        var url = '/data-divisi/' + data_id;
        console.log(url);
        $('#delete-form').attr('action', url);
    });
});
</script>
@endsection