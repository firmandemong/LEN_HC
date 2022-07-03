@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-sm-12">
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded p-3">
                <center><h5 class="text-center"><b> Data Pembimbing </b></h5>
                <a href="{{route('mentor.create')}}" button type="submit" class="btn btn-primary btn-sm mb-4">Tambah</a></center>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="min-width:20px">
                                        No
                                    </th>
                                    <th style="min-width:120px">
                                        Nama
                                    </th>
                                   
                                    <th style="min-width:120px">
                                        Divisi
                                 
                                    <th style="min-width:120px">
                                        No. Telpon
                                    </th>
                                    
                                    <th style="min-width:120px">
                                        Gedung
                                    </th>

                                    <th style="min-width:120px">
                                        Lantai
                                    </th>

                                    <th colspan="2">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mentors as $mentor)
                                    <tr>
                                        <th scope="row">
                                            {{$loop->iteration}}
                                        </th>
                                        <td>
                                            {{$mentor->name}}
                                        </td>
                                    
                                        <td>
                                            {{$mentor->getDivision->name}}
                                        </td>
                                        <td>
                                            {{$mentor->no_hp}}
                                        </td>
                                        <td>
                                            {{$mentor->gedung}}
                                        </td>
                                        <td>
                                            {{$mentor->lantai}}
                                        </td>
                                        <td>
                                            <a href="{{route('mentor.edit', $mentor->id)}}" button class="btn btn-warning btn-sm">Edit</a>
                                            <button id="delete-button" data-id="{{$mentor->id}}" data-bs-toggle="modal" data-bs-target="#delete-modal" button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div>
                    </div>
            </div>
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

@section('js')
<script>
$(document).ready(function () {
    $(document).on('click', "#delete-button", function() {
        var data_id = $(this).attr('data-id');
        var url = '/data-pembimbing/' + data_id;
        $('#delete-form').attr('action', url);
    });
});
</script>
@endsection
