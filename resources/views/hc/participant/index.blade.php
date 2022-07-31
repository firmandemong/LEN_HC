@extends("layout.main")

@section('title')
Data Peserta
@endsection

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section('subheader')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Peserta</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Data Peserta</li>
    </ol>
</div>
@endsection

@section("content")
<div class="col-lg-12">
    <div class="card mb-4">

        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                <thead class="thead-light">
                    <th style="min-width:20px">No</th>
                    <th>No Peserta</th>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Divisi</th>
                    <th>Action</th>

                </thead>
                <tbody>

                </tbody>
            </table>
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