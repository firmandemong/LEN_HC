@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
<div class="col-sm-12">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="text-dark text-center"> Data Divisi </h5>
                <center><a href="{{route('division.create')}}" class="btn btn-primary btn-sm mb-4">Tambah</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Divisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisions as $division)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$division->name}}</td>
                                    <td>
                                    <a href="{{route('division.edit', $division->id)}}" button type="submit" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{route('division.destroy', $division->id)}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
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
<!-- Table End -->
@stop