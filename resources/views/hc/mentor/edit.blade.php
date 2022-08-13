@extends('layout.main')

@section('sidebar')
    @include('layout.hc-sidebar')
@endsection

@section('subheader')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Pembimbing</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('mentor.index') }}">Data Pembimbing</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Pembimbing</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">

                <form method="post" action="{{ route('mentor.update', $mentor->id) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name"> Nama </label>
                        <input type="text" class="form-control" value="{{ $mentor->name }}" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp"> No. Telpon </label>
                        <input type="text" class="form-control" value="{{ $mentor->no_hp }}" name="no_hp" required>
                    </div>
                    <div class="form-group">
                        <label for="gedung"> Gedung </label>
                        <input type="text" class="form-control" value="{{ $mentor->gedung }}" name="gedung" required>
                    </div>
                    <div class="form-group">
                        <label for="lantai"> Lantai </label>
                        <input type="text" class="form-control" value="{{ $mentor->lantai }}" name="lantai" required>
                    </div>
                    <div class="form-group">
                        <label for="divisi"> Divisi </label>
                        <select class="form-control" name="divisi" id="divisi">
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ $mentor->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary"> Ubah </button>
                </form>
            </div>
        </div>
    </div>
@endsection
