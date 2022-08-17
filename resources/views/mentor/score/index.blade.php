@extends('layout.main')

@section('title')
    Data Peserta
@endsection

@section('sidebar')
    @include('layout.mentor-sidebar')
@endsection

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penilaian</h1>
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
                        <th style="min-width:20px">#</th>
                        <th>No Peserta</th>
                        <th>Nama</th>
                        <th>Grade</th>
                        <th>Rata-rata</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $participant->participant_code }}</td>
                                <td>{{ $participant->name }}</td>
                                <td>{{ empty($participant->getEvaluation) ? '-' : $participant->getEvaluation->predicate }}
                                </td>
                                <td>{{ empty($participant->getEvaluation) ? '-' : $participant->getEvaluation->average }}
                                </td>
                                <td>
                                    @if (empty($participant->getEvaluation))
                                        <a class="btn-sm btn btn-primary"
                                            href="/nilai-peserta/{{ $participant->id }}/evaluasi">Evaluasi</a>
                                    @else
                                        <a class="bbtn-sm btn btn-success"
                                            href="/evaluation-result/{{ $participant->id }}">Lihat Hasil</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        });
    </script>
@endsection
