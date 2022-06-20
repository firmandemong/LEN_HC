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
                <div class="bg-light rounded">
                    <center><a><b> DATA PEMBIMBING </a></center></b><br>
                    <center><a href="/createMentor" button type="submit" class="btn btn-primary">Tambah</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><center>No</th>         
                                    <th scope="col"><center>Nama</th>
                                        <th scope="col"><center>Gedung</th>
                                            <th scope="col"><center>Lantai</th>
                                    <th scope="col"><center>Divisi</th>
                                        <th scope="col"><center>Email</th>
                                        <th scope="col"><center>No. Telpon</th>
                                            <th scope="col"><center>Peserta</th>
                                        <th colspan="2">
                                            <center>Aksi
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><center>1</th>
                                    <td><center>T1222</td>
                                    <td><center>T1222</td>
                                    <td><center>T1222</td>
                                    <td><center>T1222</td>
                                        <td><center>T1222</td>
                                            <td><center>T1222</td>
                                    <td><center>Fauzi Ramdani</td>
                                    <td><center>
                                        <a href="/editMentor" button type="submit" class="btn btn-primary">Edit</a>
                                        <a href="/editMentor" button type="submit" class="btn btn-secondary">Delete</a>
                                    </td>
                                    </tr>
                            </tbody>
                        </table>
                        
                    </div><div>
                </div>
            </div>
        </div>
    </div>
@stop