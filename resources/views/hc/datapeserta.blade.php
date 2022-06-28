@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-sm-12">
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="text-center mb-4"><b> Data Peserta</b> </h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="min-width:20px">No</th>
                                <th style="min-width:120px">No Peserta</th>
                                <th style="min-width:150px">Nama</th>
                                <th style="min-width:180px">Periode</th>
                                <th style="min-width:20px">Divisi</th>
                                <th style="min-width:20px">Pembimbing</th>
                                <th style="min-width:120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $participant)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$participant->participant_code}}</td>
                                <td>{{$participant->name}}</td>
                                <td>{{date('d F Y',strtotime($participant->start_date)). ' - ' . date('d F Y',strtotime($participant->end_date))}}</td>
                                <td>{{$participant->Division->name}}</td>
                                <td>{{$participant->Mentor->name}}</td>
                                <td> <a href="/editMentor" button type="submit" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/editMentor" button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="/editMentor" button type="submit" class="btn btn-success btn-sm">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="text-center mb-4">Data Pengajuan</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="min-width:20px">No</th>
                                <th style="min-width:120px">Nama</th>
                                <th style="min-width:120px">Universitas/Sekolah</th>
                                <th style="min-width:120px">Jurusan</th>
                                <th style="min-width:120px">Email</th>
                                <th style="min-width:120px">Surat PKL</th>
                                <th style="min-width:120px">CV</th>
                                <th style="min-width:140px">Transkrip Nilai</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $submission)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$submission->name}}</td>
                                <td>{{$submission->school_name}}</td>
                                <td>{{$submission->major}}</td>
                                <td>{{$submission->email}}</td>
                                <td><a href="{{asset('/file_submission/'.$submission->file_application_letter)}}">Download File</a></td>
                                <td><a href="{{asset('/file_submission/'.$submission->file_cv)}}">Download File</a></td>
                                <td><a href="{{asset('/file_submission/'.$submission->file_transcript)}}">Download File</a></td>
                                <td>
                                    <a href="javcasript:void(0)" button type="submit" class="btn btn-success btn-sm acceptSubmission" data-id="{{$submission->id}}" data-name="{{$submission->name}}">ACCEPT</a>
                                </td>
                                <td>
                                    <a href="javcasript:void(0)" class="btn btn-danger btn-sm rejectSubmission" data-id="{{$submission->id}}" data-name="{{$submission->name}}">DECLINE</a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Accept Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAccept" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group my-3">
                        <label>Nama Peserta</label>
                        <input type="text" class="form-control" readonly id="participantName">
                    </div>
                    <div class="form-group my-3">
                        <label>Divisi</label>
                        <select name="division" id="" class="form-select" required id="division">
                            <option value='' disabled selected>===Pilih===</option>
                            @foreach($divisions as $division)
                            <option value="{{$division->id}}">{{$division->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label>Pembimbing</label>
                        <select name="mentor" id="" class="form-select" required id="mentor">
                            <option value='' disabled selected>===Pilih===</option>
                            @foreach($mentors as $mentor)
                            <option value="{{$mentor->id}}">{{$mentor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required id="start_date"></input>
                    </div>
                    <div class="form-group my-3">
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="end_date" class="form-control" required id="end_date"></input>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalReject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formReject" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                   <p>Dengan ini, Pengajuan atas nama <span id="submitorName"></span> akan ditolak dan akan dihapus dari database. Lanjutkan Aksi?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Table End -->
@stop

@section('js')
<script>
    $('.acceptSubmission').on('click', function() {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        $('#participantName').val(name);
        $('#participantId').val(id);
        $('#formAccept').prop('action', `/data-peserta/${id}/accept`)
        $('#exampleModal').modal('show');
    });

    $('#exampleModal').on('hidden.bs.modal', function() {
        $('#formAccept').removeAttr('action');
        $('#participantName').val('');
        $('#participantId').val('');
        $('#mentor').val('');
        $('#division').val('');
        $('#start_date').val('');
        $('#end_date').val('');
    })

    $('.rejectSubmission').on('click', function() {
        let id = $(this).attr('data-id');
        let nama = $(this).attr('data-name');
        $('#submitorName').text(nama);
        $('#formReject').prop('action', `/data-peserta/${id}/reject`)
        $('#modalReject').modal('show');
    });

    $('#modalReject').on('hidden.bs.modal', function() {
        $('#formReject').removeAttr('action');
        $('#submitorName').text('');
    })
</script>
@endsection