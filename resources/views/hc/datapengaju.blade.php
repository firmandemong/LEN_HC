@extends("hc.main")

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
                                    <th scope="col"><center>No</th>
                                    <th scope="col"><center>Nama</th>
                                    <th scope="col"><center>Universitas/Sekolah</th>
                                    <th scope="col"><center>Jurusan</th>
                                    <th scope="col"><center>Email</th>
                                    <th scope="col"><center>Surat PKL</th>
                                    <th scope="col"><center>CV</th>
                                    <th scope="col"><center>Transkrip Nilai</th>
                                        <th colspan="2">
                                            <center>Aksi
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><center>1</th>
                                    <td><center>Fauzi Ramdani</td>
                                    <td><center>Institud Digital Ekonomi LPKIA</td>
                                    <td><center>Teknik Informatika</td>
                                    <td><center>f@gmail.com</td>
                                    <td><center>File Hasil Upload</td>
                                    <td><center>File Hasil Upload</td>
                                    <td><center>File Hasil Upload</td>
                                    <td><center>
                                        <a href="/penerimaan" button type="submit" class="btn btn-primary py-3 w-100 mb-4">ACCEPT</a>
                                    </td>
                                    <td><center>
                                        <a href="/penolakan" button type="submit" class="btn btn-primary py-3 w-100 mb-4">DECLINE</a>
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