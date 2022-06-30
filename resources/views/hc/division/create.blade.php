@extends('layout.main')

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4 text-center">Tambah Data Divisi</h5>
                <form action="{{route('division.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="division_name" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="division_name" name="division_name">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection