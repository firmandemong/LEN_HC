@extends("hc.main")

@section("content")
<div class="col-sm-12">
</div>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <center><a><b> DATA PESERTA </a></center></b>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><center>No</th>
                                    <th scope="col"><center>No Peserta</th>
                                    <th scope="col"><center>Nama</th>
                                    <th scope="col"><center>Universitas/Sekolah</th>
                                    <th scope="col"><center>Jurusan</th>
                                    <th scope="col"><center>Email</th>
                                    <th scope="col"><center>Surat PKL</th>
                                    <th scope="col"><center>CV</th>
                                    <th scope="col"><center>Transkrip Nilai</th>
                                    <th scope="col"><center>Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><center>1</th>
                                    <td><center>T1222</td>
                                    <td><center>Fauzi Ramdani</td>
                                    <td><center>Institud Digital Ekonomi LPKIA</td>
                                    <td><center>Teknik Informatika</td>
                                    <td><center>f@gmail.com</td>
                                    <td><center>File Hasil Upload</td>
                                    <td><center>File Hasil Upload</td>
                                    <td><center>File Hasil Upload</td>
                                    <td>
                                        <button type="button" data-target="#tambahTipe" data-toggle="modal" class="btn btn-info my-2" style="float: right;">Tambah</button>
                                    </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@stop