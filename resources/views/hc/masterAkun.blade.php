@extends("hc.main")

@section("content")
<div class="col-sm-12">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Akun HC</p>
                        <h6 class="mb-0">10</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Akun Pembimbing</p>
                        <h6 class="mb-0"><center>10</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Akun Peserta</p>
                        <h6 class="mb-0"><center>10</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Akun</p>
                        <h6 class="mb-0"><center>20</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded">
                    <center><a><b> DATA AKUN PEMBIMBING </a></center></b><br>
                    <center><a href="/penilain" button type="submit" class="btn btn-primary">Tambah</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><center>No</th>         
                                    <th scope="col"><center>Nama</th>
                                    <th scope="col"><center>Email</th>
                                        <th colspan="2">
                                            <center>Aksi
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><center>1</th>
                                    <td><center>T1222</td>
                                    <td><center>Fauzi Ramdani</td>
                                    <td><center>
                                        <button type="button" class="btn btn-primary">EDIT</button>
                                        <button type="button" class="btn btn-secondary">DELETE</button>       
                                    </td>
                                    </tr>
                            </tbody>
                        </table>
                        
                    </div><div>
                </div>
                
                <div class="bg-light rounded">
                    <center><a><b> DATA AKUN PESERTA </a></center></b><br>
                    <center> <a href="/penilain" button type="submit" class="btn btn-primary">Tambah</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><center>No</th>         
                                    <th scope="col"><center>Nama</th>
                                    <th scope="col"><center>Email</th>
                                        <th colspan="2">
                                            <center>Aksi
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><center>1</th>
                                    <td><center>T1222</td>
                                    <td><center>Fauzi Ramdani</td>
                                    <td><center>
                                        <button type="button" class="btn btn-primary">EDIT</button>
                                        <button type="button" class="btn btn-secondary">DELETE</button>       
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