@extends("layout.main")

@section('sidebar')
@include('layout.mentor-sidebar')
@endsection

@section('subheader')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kuota Divisi {{\App\Models\Division::getDivisionById(Auth::User()->Mentor->division_id)}}</h1>
    <ol class="breadcrumb"> 
        <li class="breadcrumb-item active" aria-current="page">Kuota Divisi </li>
    </ol>
</div>
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <!-- <button class="btn btn-primary mb-3" id="add-button" data-toggle="modal" data-target="#add-modal">Tambah Kuota </button> -->
            <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Jurusan</th>
                        <th>Jumlah Kuota</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($majors as $major)
                    @php
                        $kuota = \App\Models\DetailDivisionQuota::where(['major_id'=>$major->id,'division_id'=>$division])->first();
                    @endphp
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <th>{{$major->name}}</th>
                        <th>{{empty($kuota) ? 0 : $kuota->quota}}</th>
                        <th><button class="btn btn-primary btn-sm btn-update" data-major-name="{{$major->name}}" data-division="{{$division}}" data-major="{{$major->id}}">Update</button></th>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- modal add --}}
<div class="modal fade" id="modalUpdateKuota" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Update Kuota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-division-form" action="{{route('division.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="division_name" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="major_name" name="division_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="division_name" class="form-label">Kuota</label>
                        <input type="text" class="form-control" id="quota" name="quota">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="add-division-form-button">Update</button>
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

    $(document).on('click','.btn-update',function(){
        $('#major_name').val($(this).attr('data-major-name'));
        $('#modalUpdateKuota').modal('show');
    })
</script>
@endsection