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
            <div class="bg-light rounded p-3">
                <center><h5 class="text-center"><b> Data Pembimbing </b></h5>
                <a href="/createMentor" button type="submit" class="btn btn-primary btn-sm mb-4">Tambah</a></center>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="min-width:20px">
                                        No
                                    </th>
                                    <th style="min-width:120px">
                                        Nama
                                    </th>
                                   
                                    <th style="min-width:120px">
                                        Divisi
                                 
                                    <th style="min-width:120px">
                                        No. Telpon
                                    </th>
                                    
                                    <th style="min-width:120px">
                                        Gedung
                                    </th>

                                    <th style="min-width:120px">
                                        Lantai
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
                                        T1222
                                    </td>
                                    <td>
                                        T1222
                                    </td>
                                    <td>
                                        T1222
                                    </td>
                                    <td>
                                        T1222
                                    </td>
                                    <td>
                                        <a href="/editMentor" button type="submit" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="/editMentor" button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                        <a href="/editMentor" button type="submit" class="btn btn-success btn-sm">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div>
                    </div>
            </div>
        </div>
    </div>
</div>
@stop