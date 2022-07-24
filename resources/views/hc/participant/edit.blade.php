@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4 text-center">Edit Data Peserta</h5>
                <form action="{{route('participant.update', $participant->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Kode Peserta</label>
                            <input type="text" class="form-control" name="participant_code" value="{{$participant->participant_code}}">
                        </div>
                        <div class="col">
                            <label class="form-label">Nama Peserta</label>
                            <input type="text" class="form-control" name="name" value="{{$participant->name}}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label class="form-label">Alamat Email</label>
                            <input type="text" class="form-control" name="email" value="{{$participant->email}}">
                        </div>
                    </div>
                    
                    
                    <div class="row mt-3">
                        <div class="col">
                            <label class="form-label">Jenis Sekolah</label>
                            <input type="text" class="form-control" name="school_type" value="{{$participant->school_type}}">
                        </div>
                        <div class="col">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" class="form-control" name="school_name" value="{{$participant->school_name}}">
                        </div>
                        <div class="col">
                            <label class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="major" value="{{$participant->major}}">
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col">
                            <label class="form-label">Divisi</label>
                            <select class="form-select" name="division" >
                                @foreach ($divisions as $division)
                                    <option {{($division->id == $participant->division_id)? 'selected' : ''}} value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Pembimbing</label>
                            <select class="form-select" name="mentor" >
                                @foreach ($mentors as $mentor)
                                    <option {{($mentor->id == $participant->mentor_id)? 'selected' : ''}} value="{{$mentor->id}}">{{$mentor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" name="status" value="{{$participant->status}}">
                        </div>
                    </div>
                        
                    <button type="submit" class="btn btn-primary mt-3">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection