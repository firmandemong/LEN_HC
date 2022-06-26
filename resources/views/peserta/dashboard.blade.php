@extends('peserta.main')

@section("content")
@include('sweetalert::alert')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Presensi Hari ini</h6>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item text-center">
                        <img class="img-fluid rounded-circle mx-auto mb-4" src="img/testimonial-1.jpg" style="width: 100px; height: 100px;">
                        <h5 class="mb-1">{{date('l, d F Y')}}</h5>
                        <button class="btn btn-primary my-2" data-bs-target="#modalClockIn" data-bs-toggle="modal" {{!empty($presensiToday->clockIn) ? 'disabled' : ''}}>Clock In</button>
                        <button class="btn btn-danger my-2" data-bs-target="#modalClockOut" data-bs-toggle="modal" {{!empty($presensiToday->clockOut) || empty($presensiToday->clockIn)  ? 'disabled' : ''}}>Clock Out</button>
                        <p class="mb-0">Presensi Hari ini : {{@$presensiToday->clockIn}} @if(!empty($presensiToday->clockOut)) - {{$presensiToday->clockOut}} @endif</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tugas belum selesai</h6>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered  mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Nama Tugas</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td><a class="btn btn-sm btn-primary" href="">Upload</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Presensi</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered  mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Pulang</th>
                        <th scope="col">Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listPresensi as $presensi)
                            <tr>
                                <td>{{date('d F Y',strtotime($presensi->date))}}</td>
                                <td>{{@$presensi->clockIn}}</td>
                                <td>{{@$presensi->clockOut}}</td>
                                <td><a class="showKegiatan" href="javascript:void(0)" data-kegiatan="{{$presensi->description}}">Lihat Kegiatan</a></td>
                            </tr>
                            @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Seluruh Tugas</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Nama Tugas</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Deadline</th>
                        <th>Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01 Jan 2045</td>
                        <td>INV-0123</td>
                        <td>Jhon Doe</td>
                        <td></td>
                        <td><a class="btn btn-sm btn-primary" href="">Upload</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Sertifikat</h6>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalClockIn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/clock-in" method="post">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Presensi Kehadiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>Submit Presensi Masuk Anda Sekarang?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalClockOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/clock-out" method="post">
                @csrf
                @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Presensi Kehadiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>Submit Presensi Pulang Anda Sekarang?</p>
                
                <div class="form-group">
                    <label for="">Kegiatan Hari ini</label>
                    <textarea class="form-control" name="activity" id="" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/clock-out" method="post">
                @csrf
                @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p id="kegiatan"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@stop

@section('js')
<script>
    $('.showKegiatan').on('click', function() {
        $('#kegiatan').text($(this).attr('data-kegiatan'));
        $('#modalKegiatan').modal('show');
    });

    $('#modalKegiatan').on('hidden.bs.modal', function() {
        $('#kegiatan').text("");
    });
</script>
@endsection