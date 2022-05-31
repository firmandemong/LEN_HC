@extends("hc.main")

@section("content")
<center><h3>Data Pengajuan</h3>
<center><a href="/dataPengajuan/create" class="btn btn-dark">Tambah Data Pengajuan</a>
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif
</div>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
              <td>No</td>
                <td>dataPengajuan</td>
                <td> Jumlah </td>
                <td colspan="2"><center>Aksi </td>
            </tr>
        </thead>
        <tbody>
            @foreach($dataPengajuans as $dataPengajuan)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$dataPengajuan->name}}</td>
                <td>{{$dataPengajuan->dataPengajuans->count(  )  }} Penyewa </td>
                <td>
                    <a href="/dataPengajuan/{{$dataPengajuan->id}}/edit/" class="btn btn-info">Edit</a>
                </td>
                <td>
                    <form action="/dataPengajuan/{{$dataPengajuan->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-dark" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop