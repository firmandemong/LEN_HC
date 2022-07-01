@extends("layout.main")
@section('sidebar')
@include('layout.mentor-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="text-center"> TUGAS PESERTA </h6>
                <center><a href="/list-tugas/create" class="btn btn-primary btn-sm mb-4">Buat Tugas</a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="min-width:20px">No</th>
                                <th style="min-width:120px">Nama Tugas</th>
                                <th style="min-width:120px">Deskripsi Tugas</th>
                                <th style="min-width:120px">Peserta</th>
                                <th style="min-width:120px">Deadline</th>
                                <th style="min-width:120px">Status</th>
                                <th style="min-width:120px">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$task->name}}</td>
                                <td>Lihat Deskripsi</td>
                                <td>{{$task->getParticipant->name}}</td>
                                <td>{{date('d F Y',strtotime($task->deadline))}}</td>
                                <td>{!! $task->status == 0 ? '<p class="text-danger">Unsubmitted</p>' : '<p class="text-success">Submitted</p>' !!}</td>
                                <td>
                                    <a href="/editAccountMentor" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/" class="btn btn-danger btn-sm">Delete</a>
                                    @if($task->status == 1)<a href="/" class="btn btn-success btn-sm">Lihat File</a>@endif
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

@stop