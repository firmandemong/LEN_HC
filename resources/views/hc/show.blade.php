@extends("layout.main")

@section('sidebar')
@include('layout.hc-sidebar')
@endsection

@section("content")
<h3>Lihat Data dataPengajuan #{{$dataPengajuan->name}}</h3>
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
                <td>Nama</td>
                <td>dataPengajuan</td>
                <td colspan=2></td>
            </tr>
        </thead>
        <tbody>
            @if($dataPengajuan->jadwals)
            @foreach($dataPengajuan->jadwals as $jadwal)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$jadwal->code}}</td>
                <td>{{$jadwal->name}}</td>
                <td>
                    <a href="/dataPengajuan/{{$dataPengajuan->id}}/edit/" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="/dataPengajuan/{{$dataPengajuan->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
@stop