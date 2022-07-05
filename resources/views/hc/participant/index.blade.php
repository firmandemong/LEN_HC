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
                                <td>{{$participant->Division->name ?? "-"}}</td>
                                <td>{{$participant->Mentor->name}}</td>
                                <td> <a href="/editMentor" button type="submit" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/editMentor" button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                    <button button class="btn btn-success btn-sm btn-modal-detail" id="btn-modal-detail" 
                                        data-bs-toggle="modal" data-bs-target="#modal-detail-peserta" 
                                        data-participant-code="{{$participant->participant_code}}" 
                                        data-name="{{$participant->name}}" data-school-type="{{$participant->school_type}}"
                                        data-school-name="{{$participant->school_name}}" data-major="{{$participant->major}}" 
                                        data-email="{{$participant->email}}"
                                        data-file-application-letter="{{asset('file_submission/'.$participant->file_application_letter)}}"
                                        data-file-cv="{{asset('file_submission/'.$participant->file_cv)}}"
                                        data-file-transcript="{{asset('file_submission/'.$participant->file_transcript)}}"
                                        data-division="{{$participant->Division->name ?? "-"}}" data-mentor="{{$participant->Mentor->name}}"
                                        data-status="{{$participant->status}}"
                                        >Detail
                                    </button>
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

{{-- modal detail peserta --}}
<div class="modal fade" id="modal-detail-peserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-detail-header">Detail Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-light rounded h-100 p-4">
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Kode Peserta</label>
                                            <input type="text" class="form-control" id="d-participant-code" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Nama Peserta</label>
                                            <input type="text" class="form-control" id="d-name" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <label class="form-label">Alamat Email</label>
                                            <input type="text" class="form-control" id="d-email" readonly>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label class="form-label">Jenis Sekolah</label>
                                            <input type="text" class="form-control" id="d-school-type" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Asal Sekolah</label>
                                            <input type="text" class="form-control" id="d-school-name" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Jurusan</label>
                                            <input type="text" class="form-control" id="d-major" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label class="form-label">Divisi</label>
                                            <input type="text" class="form-control" id="d-division" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Pembimbing</label>
                                            <input type="text" class="form-control" id="d-mentor" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Status</label>
                                            <input type="text" class="form-control" id="d-status" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <button button class="btn btn-success" id="d-btn-file-application-letter" data-bs-toggle="modal" data-bs-target="#modal-file">File Surat Pengajuan</button>
                                        </div>
                                        <div class="col">
                                            <button button class="btn btn-success" id="d-btn-file-cv" data-bs-toggle="modal" data-bs-target="#modal-file">File CV</button>
                                        </div>
                                        <div class="col">
                                            <button button class="btn btn-success" id="d-btn-file-transcript" data-bs-toggle="modal" data-bs-target="#modal-file">File Transkrip</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal file --}}
<div class="modal fade" id="modal-file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-file">
            </div>
        </div>
    </div>
</div>

{{-- modal pengajuan --}}
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

{{-- modal reject --}}
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
    });

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
    });

    let d_participant_code;
    let d_name;
    let d_school_type;
    let d_school_name;
    let d_major;
    let d_email;
    let d_file_application_letter;
    let d_file_cv;
    let d_file_transcript;
    let d_division;
    let d_mentor;
    let d_status;
    
    $('.btn-modal-detail').on('click', function() {

        d_participant_code = $(this).attr('data-participant-code');
        d_name = $(this).attr('data-name');
        d_school_type = $(this).attr('data-school-type');
        d_school_name = $(this).attr('data-school-name');
        d_major = $(this).attr('data-major');
        d_email = $(this).attr('data-email');
        d_file_application_letter = $(this).attr('data-file-application-letter');
        d_file_cv = $(this).attr('data-file-cv');
        d_file_transcript = $(this).attr('data-file-transcript');
        d_division = $(this).attr('data-division');
        d_mentor = $(this).attr('data-mentor');
        d_status = $(this).attr('data-status');
        
        $("#d-participant-code").val(d_participant_code);
        $("#d-name").val(d_name);
        $("#d-school-type").val(d_school_type);
        $("#d-school-name").val(d_school_name);
        $("#d-major").val(d_major);
        $("#d-email").val(d_email);
        // $("#d-file-application-letter").val(d_file_application_letter);
        // $("#d-file-cv").val(d_file_cv);
        // $("#d-file-transcript").val(d_file_transcript);
        $("#d-division").val(d_division);
        $("#d-mentor").val(d_mentor);
        $("#d-status").val(d_status);
    });

    // files
    $("#d-btn-file-application-letter").on('click', function() {
        title.innerText = "File Surat Pengajuan"
        // set sumber
        $(`#pdf-hasil`).remove();
        $(`#modal-body-file`).append(`<embed class="embed-responsive" id="pdf-hasil" src="" type="application/pdf" style="height: 45vw!important; width:60vw!important">`);
        document.getElementById("pdf-hasil").src = d_file_application_letter;
    });
    $("#d-btn-file-cv").on('click', function() {
        title.innerText = "File CV"
        // set sumber
        $(`#pdf-hasil`).remove();
        $(`#modal-body-file`).append(`<embed class="embed-responsive" id="pdf-hasil" src="" type="application/pdf" style="height: 45vw!important; width:60vw!important">`);
        document.getElementById("pdf-hasil").src = d_file_cv;
    });
    $("#d-btn-file-transcript").on('click', function() {
        title.innerText = "File Transkrip"
        // set sumber
        $(`#pdf-hasil`).remove();
        $(`#modal-body-file`).append(`<embed class="embed-responsive" id="pdf-hasil" src="" type="application/pdf" style="height: 45vw!important; width:60vw!important">`);
        document.getElementById("pdf-hasil").src = d_file_transcript;
    });

</script>
@endsection