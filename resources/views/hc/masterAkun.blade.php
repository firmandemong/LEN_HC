@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
<div class="col-sm-12">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-2x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Akun HC</p>
                        <h6 class="mb-0">10</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-2x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Akun Mentor</p>
                        <h6 class="mb-0">10</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-2x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Akun Peserta</p>
                        <h6 class="mb-0">10</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user-plus fa-2x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Akun</p>
                        <h6 class="mb-0">
                            20
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded  p-3">
                <center><h5 class="text-dark"><b> Data Akun Pembimbing </h6></b>
                <a href="/createAccountMentor" class="btn btn-primary mb-4 btn-sm">Tambah</a></center>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    No
                                </th>
                                <th scope="col">
                                    Nama
                                </th>
                                <th scope="col">
                                    Email
                                </th>
                                <th scope="col">
                                    Divisi
                                </th>
                                <th colspan="2">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    1
                                </th>
                                <td>
                                    T1222
                                </td>
                                <td>
                                    Fauzi Ramdani
                                </td>
                                <th scope="col">
                                    Divisi
                                </th>
                                <td>
                                    <a href="/editAccountMentor" button type="submit" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/" button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="bg-light rounded p-3">
                <h5 class="text-center">Data Akun Peserta</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    No
                                </th>
                                <th scope="col">
                                    Nama
                                </th>
                                <th scope="col">
                                    Email
                                </th>
                                <th colspan="2">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    1
                                </th>
                                <td>
                                    T1222
                                </td>
                                <td>
                                    Fauzi Ramdani
                                </td>
                                <td>

                                    <a href="/editAccountParticipants" button type="submit" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/" button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop