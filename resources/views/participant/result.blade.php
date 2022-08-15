@extends('layout.main')

@section('title')
    Data Peserta
@endsection

@section('sidebar')
    @include('layout.participant-sidebar')
@endsection

@section('subheader')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hasil Evaluasi & Sertifikat</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/list-tugas">Data Tugas</a></li>
            <li class="breadcrumb-item" aria-current="page">Detail Tugas</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5>Evaluasi</h5>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                    <thead class="thead-light">
                        <th width="10%">#</th>
                        <th width="70%">Deskripsi</th>
                        <th width="20%">Nilai</th>
                    </thead>
                    @if (!empty($evaluation))
                        <tbody>
                            <tr>
                                <td class="bg-light" colspan="3"><b>A. Pengetahuan</b></td>
                            </tr>
                            @foreach ($subjectPengetahuan as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subject->subject }}</td>
                                    <td>{{ $evaluation->getDetail->where('subject_id', $subject->id)->first()->point }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="bg-light" colspan="3"><b>B. Keterampilan</b></td>
                            </tr>
                            @foreach ($subjectKeterampilan as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subject->subject }}</td>
                                    <td>{{ $evaluation->getDetail->where('subject_id', $subject->id)->first()->point }}</td>

                                </tr>
                            @endforeach
                            <tr>
                                <td class="bg-light" colspan="3"><b>C. Sikap</b></td>
                            </tr>
                            @foreach ($subjectSikap as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subject->subject }}</td>
                                    <td>{{ $evaluation->getDetail->where('subject_id', $subject->id)->first()->point }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
                @if (!empty($evaluation))
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Rata-Rata Nilai</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $evaluation->average }}
                                            </div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Predikat</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $evaluation->predicate }}
                                            </div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 ">
        <div class="card">
            <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-light">Sertifikat</h6>
            </div>
            <div>
                <div class="customer-message align-items-center">
                    <p class="text-center text-muted">Sertifikat belum dikirim</p>
                </div>
                {{-- <div class="customer-message align-items-center">
          <a class="font-weight-bold" href="#">
            <div class="text-truncate message-title">  <i class="fa fa-download"></i> Dwonload Sertifikat</div>
            <div class="small text-gray-500 message-time font-weight-bold">Uploaded at ..</div>
          </a>
        </div> --}}
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
                "searching": false,
                "paging": false,
                "info": false,
            });


        });
    </script>
@endsection
