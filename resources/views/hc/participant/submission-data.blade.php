    @extends("layout.main")

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

    @section("content")
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
                        @foreach($submissions as $submission)
                        <tr>
                            <td>{{$submission->name}}</td>
                            <td>{{@$submission->getInstitute->name}}<br><a href="">Lihat Histori</a></td>
                            <td>{{@$submission->getMajor->name}}</td>
                            <td><a href="">Lihat File</a></td>
                            <td><a href="">Lihat File</a></td>
                            <td><a href="">Lihat File</a></td>
                            <td><button class="btn btn-success btn-sm">Lanjut</button><br><button class="btn btn-danger btn-sm mt-1">Tolak</button></td>
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
                        @foreach($acceptedSubmission as $submission)
                        <tr>
                            <td>{{$submission->name}}</td>
                            <td>{{@$submission->getInstitute->name}}</td>
                            <td>{{@$submission->getMajor->name}}</td>
                            <td><a href="">Lihat Jadwal</a></td>
                            <td><button class="btn btn-success btn-sm">Lanjut</button><br><button class="btn btn-danger btn-sm mt-1">Tolak</button></td>
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
                        @foreach($rejectedSubmission as $submission)
                        <tr>
                            <td>{{$submission->name}}</td>
                            <td>{{@$submission->getInstitute->name}}</td>
                            <td>{{@$submission->getMajor->name}}</td>
                            <td><a href="">Lihat File</a></td>
                            <td><a href="">Lihat File</a></td>
                            <td><a href="">Lihat File</a></td>
                        </tr>
                        @endforeach
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