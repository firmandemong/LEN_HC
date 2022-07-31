@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h3>Tambah Pembimbing</h3>
                <form method="post" action="{{route('mentor.store')}}">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="name"> Nama </label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="no_hp"> No. Telpon </label>
                                <input type="text" class="form-control" name="no_hp" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email"> Email </label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gedung"> Gedung </label>
                        <input type="text" class="form-control" name="gedung" required>
                    </div>
                    <div class="form-group">
                        <label for="lantai"> Lantai </label>
                        <input type="text" class="form-control" name="lantai" required>
                    </div>
                    <div class="form-group">
                        <label for="divisi"> Divisi </label>
                        <select class="form-select" name="divisi" id="divisi">
                            @foreach ($divisions as $division)
                            <option value="{{$division->id}}">{{$division->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary"> Simpan </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection