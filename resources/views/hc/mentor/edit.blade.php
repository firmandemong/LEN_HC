@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
<div class="col-md-8 offset-md-2">
    <h3>Ubah Pembimbing</h3>
    <form method="post" action="{{route('mentor.update', $mentor->id)}}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name"> Nama </label>
            <input type="text" class="form-control" value="{{$mentor->name}}" name="name" required>
        </div>
        <div class="form-group">
            <label for="no_hp"> No. Telpon </label>
            <input type="text" class="form-control" value="{{$mentor->no_hp}}" name="no_hp" required>
        </div>
        <div class="form-group">
            <label for="gedung"> Gedung </label>
            <input type="text" class="form-control" value="{{$mentor->gedung}}" name="gedung" required>
        </div>
        <div class="form-group">
            <label for="lantai"> Lantai </label>
            <input type="text" class="form-control" value="{{$mentor->lantai}}" name="lantai" required>
        </div>
        <div class="form-group">
            <label for="divisi"> Divisi </label>
            <select class="form-select" name="divisi" id="divisi">
                @foreach ($divisions as $division)
                    <option value="{{$division->id}}" {{($mentor->division_id == $division->id) ? "selected" : ""}}>{{$division->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="mt-3 btn btn-primary"> Ubah </button>
    </form>
</div>
@endsection