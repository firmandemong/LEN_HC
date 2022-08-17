@extends('layout.main')

@section('title')
    Data Sertifikat
@endsection

@section('sidebar')
    @include('layout.hc-sidebar')
@endsection

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Sertifikat</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data Sertifikat</li>
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
                        <th style="min-width:20px">No</th>
                        <th>No Peserta</th>
                        <th>Nama</th>
                        {{-- <th>Status</th> --}}
                        <th class="text-center">Action</th>

                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $participant->participant_code }}</td>
                                <td>{{ $participant->name }}</td>
                                {{-- <td>{!! \App\Models\Participant::getLabelStatus($participant->status) !!}</td> --}}
                                <td class="text-center">
                                    @if ($participant->getCertificate)
                                            <a href="{{ asset('/certificate/' . $participant->getCertificate->file) }}" class="btn btn-primary btn-sm download-btn">Download</a>
                                    @elseif ($participant->status==4)
                                        <button button class="btn btn-primary btn-sm upload-btn"  data-id="{{$participant->id}}" data-toggle="modal" data-target='#upload-modal'>Upload</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- upload --}}
    <div class="modal fade" id="upload-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detail-modal-label">Silahkan pilih file sertifikat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upload-form" method="POST"  enctype="multipart/form-data">
                        {{-- <form action="{{route('division.destroy', $division->id)}}" method="POST"> --}}
                        @csrf
                        <input type="file" class="form-control" name="file_cert" id="file_cert">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="upload-form-button" data-dismiss="modal">Upload</button>
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

            let upload_url;
            $(document).on('click', '.upload-btn', function(){
                var data_id = $(this).attr('data-id');
                upload_url = `/data-sertifikat/${data_id}/upload`;
            });

            $(document).on('click', '#upload-form-button', function(){
                $('#upload-form').attr('action', upload_url);
                $('#upload-form').submit();
            });

        });
    </script>
@endsection
