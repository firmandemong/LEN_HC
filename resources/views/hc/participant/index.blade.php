@extends('layout.main')

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
                        <th>Asal Instansi</th>
                        <th>Divisi</th>
                        <th>Mentor</th>
                        <th>Status</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $participant->participant_code }}</td>
                                <td>{{ $participant->name }}</td>
                                <td>{{ @$participant->getInstitute->name }}</td>
                                <td>{{ @$participant->division->name }}</td>
                                <td>{{ @$participant->mentor->name }}</td>
                                <td>{!! \App\Models\Participant::getLabelStatus($participant->status) !!}</td>
                                {{-- <td>{{date('d F Y',strtotime($participant->start_date)) .' - ' . date('d F Y',strtotime($participant->end_date))}}</td> --}}
                                <td>
                                    <a href="{{ route('participant.detail', $participant->id) }}"
                                        class="btn btn-primary btn-sm">Detail</a>
                                    <a href="{{ route('participant.edit', $participant->id) }}"
                                        class="btn btn-warning btn-sm edit-button">Edit</a>
                                    <button button id="delete-button" data-id="{{ $participant->id }}" data-toggle="modal"
                                        data-target="#delete-modal"
                                        class="btn btn-danger btn-sm delete-button">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

            $(document).on('click', "#delete-button", function() {
                var data_id = $(this).attr('data-id');
                var url = '/data-peserta/' + data_id + '/delete';
                $('#delete-form').attr('action', url);
            });
        });
    </script>
@endsection
