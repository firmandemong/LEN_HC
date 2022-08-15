@extends('layout.main')

@section('title')
    Data Peserta
@endsection

@section('sidebar')
    @include('layout.mentor-sidebar')
@endsection

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Evaluasi Peserta</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Form Evaluasi</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Peserta</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Peserta</label>
                    <input type="text" class="form-control" readonly value="{{ $participant->name }}">
                </div>
                <div class="form-group">
                    <label for="">Asal Institusi/Sekolah</label>
                    <input type="text" class="form-control" readonly value="{{ $participant->getInstitute->name }}">
                </div>
                <div class="form-group">
                    <label for="">Jurusan</label>
                    <input type="text" class="form-control" readonly value="{{ $participant->getMajor->name }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Form Penilaian</h5>
            </div>
            <form action="" method="post">
                @csrf
                <div class="card-body">
                    <h6><b>A. Pengetahuan</b></h6>
                    @foreach ($subjectPengetahuan as $subject)
                        <div class="row mt-2">
                            <div class="col-md-8 pl-5">
                                <label for="">{{ $loop->iteration }}. {{ $subject->subject }}</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" required name="score[{{ $subject->id }}]" min=0 max=100
                                    class="form-control">
                            </div>
                        </div>
                    @endforeach
                    <h6><b>B. Keterampilan</b></h6>
                    @foreach ($subjectKeterampilan as $subject)
                        <div class="row mt-2">
                            <div class="col-md-8 pl-5">
                                <label for="">{{ $loop->iteration }}. {{ $subject->subject }}</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" required name="score[{{ $subject->id }}]" min=0 max=100
                                    class="form-control">
                            </div>
                        </div>
                    @endforeach
                    <h6><b>C. Sikap</b></h6>
                    @foreach ($subjectSikap as $subject)
                        <div class="row mt-2">
                            <div class="col-md-8 pl-5">
                                <label for="">{{ $loop->iteration }}. {{ $subject->subject }}</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" required name="score[{{ $subject->id }}]" min=0 max=100
                                    class="form-control">
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-5 mb-3" style="float:right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')

@endsection

@section('js')

@endsection
