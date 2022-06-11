@extends("hc.main")
@section("content")
<div class="col-md-8 offset-md-2">
    <h3>Edit Akun Participant</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div><br>
    @endif
    <form method="post" action="/dataPengajuan">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"> Nama </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="name"> Email </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="name"> Divisi </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="name"> Password </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="name"> Konfirmasi Password </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary"> Simpan </button>
    </form>
</div>
@endsection