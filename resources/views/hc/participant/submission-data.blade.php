    @extends('layout.main')

    @section('title')
        Dashboard
    @endsection

    @section('sidebar')
        @include('layout.hc-sidebar')
    @endsection

    @section('subheader')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pengajuan</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Data Pengajuan</li>
            </ol>
        </div>
    @endsection

    @section('content')
        @include('sweetalert::alert')
        @include('layout.notif')
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5>Pengajuan Awal</h5>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th rowspan="2" style="vertical-align: middle">Nama</th>
                                <th rowspan="2" style="vertical-align: middle">Asal Instansi</th>
                                <th rowspan="2" style="vertical-align: middle">Jurusan</th>
                                <th colspan="3">File Submission</th>
                                <th rowspan="2" style="vertical-align: middle">Keputusan</th>
                            </tr>
                            <tr class="text-center">
                                <th>Pengajuan</th>
                                <th>CV</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submissions as $submission)
                                <tr>
                                    <td>{{ $submission->name }}</td>
                                    <td>{{ @$submission->getInstitute->name }}<br><a href="javascript:void(0)"
                                            class="btnHistori" data-instansi="{{ $submission->school_id }}">Lihat
                                            Histori</a></td>
                                    <td>{{ @$submission->getMajor->name }}</td>
                                    <td><a href="{{ asset('/file_submission/' . $submission->file_application_letter) }}">Lihat
                                            File</a></td>
                                    <td><a href="{{ asset('/file_submission/' . $submission->file_cv) }}">Lihat File</a>
                                    </td>
                                    <td><a href="{{ asset('/file_submission/' . $submission->file_transcript) }}">Lihat
                                            File</a></td>
                                    <td><button class="btn btn-success btn-sm btnLanjut"
                                            data-id="{{ $submission->id }}">Lanjut</button><br><button
                                            class="btn btn-danger btn-sm mt-1">Tolak</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5>Pengajuan Lolos Tahap 1</h5>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                        <thead class="thead-light">
                            <tr class="">
                                <th style="vertical-align: middle">Nama</th>
                                <th style="vertical-align: middle">Asal Instansi</th>
                                <th style="vertical-align: middle">Jurusan</th>
                                <th>Jadwal Wawancara</th>
                                <th style="vertical-align: middle">Keputusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($acceptedSubmission as $submission)
                                <tr>
                                    <td>{{ $submission->name }}</td>
                                    <td>{{ @$submission->getInstitute->name }}</td>
                                    <td>{{ @$submission->getMajor->name }}</td>
                                    <td><a href="">Lihat Jadwal</a></td>
                                    <td><button class="btn btn-success btn-sm btnLanjut2"
                                            data-id="{{ $submission->id }}">Lanjut</button><br><button
                                            class="btn btn-danger btn-sm mt-1">Tolak</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5>Pengajuan Ditolak</h5>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover3">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th rowspan="2" style="vertical-align: middle">Nama</th>
                                <th rowspan="2" style="vertical-align: middle">Asal Instansi</th>
                                <th rowspan="2" style="vertical-align: middle">Jurusan</th>
                                <th colspan="3">File Submission</th>
                            </tr>
                            <tr class="text-center">
                                <th>Pengajuan</th>
                                <th>CV</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rejectedSubmission as $submission)
                                <tr>
                                    <td>{{ $submission->name }}</td>
                                    <td>{{ @$submission->getInstitute->name }}</td>
                                    <td>{{ @$submission->getMajor->name }}</td>
                                    <td><a href="{{ asset('/file_submission/' . $submission->file_application_letter) }}">Lihat
                                            File</a></td>
                                    <td><a href="{{ asset('/file_submission/' . $submission->file_cv) }}">Lihat File</a>
                                    </td>
                                    <td><a href="{{ asset('/file_submission/' . $submission->file_transcript) }}">Lihat
                                            File</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalHistori" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-label">History Instansi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-flush table-bordered">
                                <tr>
                                    <th>Nama Instansi</th>
                                    <td>LPKIA</td>
                                </tr>
                                <tr>
                                    <th>Histori Jumlah Peserta</th>
                                    <td><span id="countParticipant"></span></td>
                                </tr>
                                <tr>
                                    <th>Histori Divisi terbanyak</th>
                                    <td><span id="mostDivisionCount"></span></td>
                                </tr>
                                <tr>
                                    <th>Histori Rata-rata Nilai</th>
                                    <td>0</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLanjut" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-label">Lanjutkan Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="accept-submission-form" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="table-responsive">
                                <div class="form-group">
                                    <label for="">Rekomendasi Divisi</label>
                                    <table class="table table-flush table-bordered">
                                        <tr>
                                            <th>Berdasarkan Histori Jurusan</th>
                                            <td><span id="recomendByMajor"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Berdasarkan Histori Instansi</th>
                                            <td><span id="recomendByInstance"></span></span></td>
                                        </tr>
                                        <tr>
                                            <th>Berdasarkan Kebutuhan</th>
                                            <td><span id="recomendByNeed"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Pilih Divisi</label>
                                <select name="division" class="form-control" id="division" required>
                                    <option selected disabled>Pilih Divisi</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Pilih Mentor</label>
                                <select name="mentor" class="form-control" id="mentor" readonly required>
                                    <option selected disabled></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Tanggal Wawancara</label>
                                <input type="date" name="interviewDate" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">Jam Wawancara</label>
                                <input type="time" name="interviewTime" class="form-control" required>

                            </div>

                            <div class="form-group">
                                <label for="">Jenis Wawancara</label>
                                <select name="interviewType" id="" class="form-control" required>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Link/Tempat Wawancara</label>
                                <input type="text" name="interviewPlace" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLanjut2" tabindex="-1" aria-labelledby="update-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-label">Terima Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="accept-submission-form2" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Tanggal Mulai Magang/PKL</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">Tanggal Berakhir Magang/PKL</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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

            $(document).on('click', '.btnHistori', function() {
                $.get(`/school/${$(this).attr('data-instansi')}/history`, function(data) {
                    $('#countParticipant').text(data.countParticipant);
                    $('#mostDivisionCount').text(data.mostDivisionCount);
                });
                $('#modalHistori').modal('show');
            })

            $(document).on('click', '.btnLanjut', function() {
                $.get(`/submission/${$(this).attr('data-id')}/recomendation`, function(data) {
                    console.log(data);
                    $('#recomendByMajor').text(data.recomendationByMajor);
                    $('#recomendByNeed').text(data.recomendationByNeed);
                    $('#recomendByInstance').text(data.recomendationByInstance);

                })
                $('#accept-submission-form').prop('action', `/submission/${$(this).attr('data-id')}/acceptStepOne`)
                $('#modalLanjut').modal('show');
            })

            $(document).on('click', '.btnLanjut2', function() {
                $('#accept-submission-form2').prop('action', `/submission/${$(this).attr('data-id')}/acceptSubmission`)
                $('#modalLanjut2').modal('show');
            })

            $(document).on('change', '#division', function() {
                $("#mentor").empty();
                $("division").prop('readonly')
                $.get(`/division/${$(this).val()}/getMentor`, function(data) {
                    $.each(data.mentors, function(index) {
                        $("#mentor").append(new Option(data.mentors[index].name, data.mentors[index]
                            .id));
                    })
                });
                $('#mentor').removeAttr('readonly')
            });
        </script>
    @endsection
