@extends("peserta.main")
@section("content")
    <h3>Edit Akun Pembimbing</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div><br>
    @endif
    <form method="post" action="/presensi">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"> Hari / Tanggal </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="name"> Jam Masuk </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="name"> Jam Keluar </label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary"> Simpan </button>
    </form>
@endsection