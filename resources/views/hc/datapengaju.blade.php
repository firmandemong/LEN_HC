@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
<div class="col-sm-12">
</div>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <center><a><b> DATA PENGAJUAN </a></center></b>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="50%"><center>No</th>
                                    <th><center>Nama</th>
                                    <th><center>Universitas/Sekolah</th>
                                    <th><center>Jurusan</th>
                                    <th><center>Email</th>
                                    <th><center>Surat PKL</th>
                                    <th><center>CV</th>
                                    <th><center>Transkrip Nilai</th>
                                        <th colspan="2">
                                            <center>Aksi
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$submission->name}}</td>
                                    <td>{{$submission->univ}}</td>
                                    <td>{{$submission->major}}</td>
                                    <td>{{$submission->email}}</td>
                                    <td><a href="{{asset('/file_submission/'.$submission->file_application_letter)}}">Download File</a></td>
                                    <td><a href="{{asset('/file_submission/'.$submission->file_cv)}}">Download File</a></td>
                                    <td><a href="{{asset('/file_submission/'.$submission->file_transcript)}}">Download File</a></td>
                                    <td>
                                        <a href="/penerimaan" button type="submit" class="btn btn-primary py-3 w-100 mb-4 btn-sm">ACCEPT</a>
                                    </td>
                                    <td>
                                        <a href="/penolakan" button type="submit" class="btn btn-primary py-3 w-100 mb-4 btn-sm">DECLINE</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@stop