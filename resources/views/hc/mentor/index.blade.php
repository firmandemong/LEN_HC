@extends('layout.main')

@section('sidebar')
    @include('layout.hc-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pembimbing</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Pembimbing</li>
        </ol>
    </div>
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <a href="data-pembimbing/create" class="btn btn-primary mb-3">Tambah Data</a>
                <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                Nama
                            </th>

                            <th>
                                Divisi

                            <th>
                                No. Telpon
                            </th>

                            <th>
                                Gedung
                            </th>

                            <th>
                                Lantai
                            </th>

                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentors as $mentor)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    {{ $mentor->name }}
                                </td>

                                <td>
                                    {{ @$mentor->getDivision->name }}
                                </td>
                                <td>
                                    {{ $mentor->no_hp }}
                                </td>
                                <td>
                                    {{ $mentor->gedung }}
                                </td>
                                <td>
                                    {{ $mentor->lantai }}
                                </td>
                                <td>
                                    <a href="{{ route('mentor.edit', $mentor->id) }}" button
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <button id="delete-button" data-id="{{ $mentor->id }}" data-toggle="modal"
                                        data-target="#delete-modal" button class="btn btn-danger btn-sm">Delete</button>
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
@endsection


@section('css')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', "#delete-button", function() {
                var data_id = $(this).attr('data-id');
                var url = '/data-pembimbing/' + data_id;
                $('#delete-form').attr('action', url);
            });
        });

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
