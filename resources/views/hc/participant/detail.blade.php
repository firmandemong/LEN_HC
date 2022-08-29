@extends('layout.main')

@section('sidebar')
    @include('layout.hc-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="card">
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h5 class="mb-4 text-center">Data Peserta {{$participant->name}}</h5>
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Kode Peserta</label>
                                        <input disabled type="text" class="form-control" name="participant_code"
                                            value="{{ $participant->participant_code }}">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Nama Peserta</label>
                                        <input disabled type="text" class="form-control" name="name" value="{{ $participant->name }}">
                                    </div>
                                </div>
        
                                <div class="row mt-3">
                                    <div class="col">
                                        <label class="form-label">Alamat Email</label>
                                        <input disabled type="text" class="form-control" name="email" value="{{ $participant->email }}">
                                    </div>
                                </div>
        
        
                                <div class="row mt-3">
                                    <div class="col">
                                        <label class="form-label">Jenis Sekolah</label>
                                        <input disabled type="text" class="form-control" name="school_type"
                                            value="{{ $participant->school_type }}">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Asal Sekolah</label>
                                        <select disabled class="form-control" name="school_id" id="school_id">
                                            @foreach ($institutes as $institute)
                                                <option {{($institute->id == $participant->school_id)?'selected':''}} value="{{$institute->id}}">{{$institute->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Jurusan</label>
                                        <select disabled class="form-control" name="major" id="major">
                                            @foreach ($majors as $major)
                                                <option {{($major->id == $participant->major_id)?'selected':''}} value="{{$major->id}}">{{$major->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
        
                                <div class="row mt-3">
                                    <div class="col">
                                        <label class="form-label">Divisi</label>
                                        <select disabled class="form-control" name="division">
                                            @foreach ($divisions as $division)
                                                <option {{ $division->id == $participant->division_id ? 'selected' : '' }}
                                                    value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Pembimbing</label>
                                        <select disabled class="form-control" name="mentor">
                                            @foreach ($mentors as $mentor)
                                                <option {{ $mentor->id == $participant->mentor_id ? 'selected' : '' }}
                                                    value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Status</label>
                                        <select disabled class="form-control" name="status" id="status">
                                            <option {{ 0 == $participant->status ? 'selected' : '' }} value="0">Pengajuan Belum dilakukan approval</option>
                                            <option {{ 1 == $participant->status ? 'selected' : '' }} value="1">Pengajuan Lolos Tahap 1</option>
                                            <option {{ 2 == $participant->status ? 'selected' : '' }} value="2">Lulus Seluruh Tahap</option>
                                            <option {{ 3 == $participant->status ? 'selected' : '' }} value="3">Ditolak</option>
                                            <option {{ 4 == $participant->status ? 'selected' : '' }} value="4">Lulus / PKL Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
