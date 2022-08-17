@extends('layout.main')

@section('title')
    Data Peserta
@endsection

@section('sidebar')
    @include('layout.mentor-sidebar')
@endsection

@section('subheader')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penugasan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data Penugasan</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive p-3">
                <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#create-task-modal">Buat
                    Penugasan</a>
                <table class="table align-items-center table-flush table-hover table-stripped" id="dataTableHover">
                    <thead class="thead-light">
                        <th style="min-width:20px">#</th>
                        <th>Judul Tugas</th>
                        <th>Nama Peserta</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->getParticipant->name }}</td>
                                <td>{!! \app\Models\Task::getStatusLabel($task->status) !!}</td>
                                <td>
                                    <a href="/tugas-peserta/{{ $task->id }}/detail"
                                        class="btn-sm btn btn-success">Detail</a>
                                    <button class="btn-sm btn btn-warning edit-button" data-toggle="modal" data-target="#edit-task-modal"
                                        data-id='{{$task->id}}' data-participant='{{$task->participant_id}}' 
                                        data-title='{{$task->title}}' data-desc='{{$task->description}}'
                                    >Edit</button>
                                    <button class="btn-sm btn btn-danger delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{$task->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create-task-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Buat Penugasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/task" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Peserta</label>
                            <select name="participant" id="" class="form-control" required>
                                <option disabled selected>Pilih Peserta</option>
                                @foreach ($participants as $participant)
                                    <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Judul Tugas</label>
                            <input name="task_title" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Tugas</label>
                            <textarea name="task_description" class="form-control" id="" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- update --}}
    <div class="modal fade" id="edit-task-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Ubah Penugasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-task-form" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Peserta</label>
                            {{-- <select name="participant" id="edit_participant" class="form-control" required>
                                <option value="0" disabled selected>Pilih Peserta</option>
                                @foreach ($participants as $participant)
                                    <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                        <div class="form-group">
                            <label for="">Judul Tugas</label>
                            <input name="task_title" id="edit_task_title" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Tugas</label>
                            <textarea name="task_description" id="edit_task_description" class="form-control" id="" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submit-edit-button">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Delete --> --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Apakah anda yakin ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data yang dihapus tidak dapat dikembalikan!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form id="delete-form" method="POST">
                        {{-- <form action="{{route('division.destroy', $division->id)}}" method="POST"> --}}
                        @method('delete')
                        @csrf
                        <button button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable({
                "ordering": false,
            });

            $('#dataTableHover2').DataTable({
                "ordering": false,
            }); // I

            $('#dataTableHover3').DataTable({
                "ordering": false,
            }); // I// ID From dataTable with Hover


            let data_id;
            $(document).on('click', '.edit-button', function(){
                data_id = $(this).attr('data-id');
                
                // $("#edit_participant").val(($(this).attr('data-participant') == null || $(this).attr('data-participant') == false) ? "0" : $(this).attr('data-participant')).change();
                $("#edit_task_title").val($(this).attr('data-title'));
                $("#edit_task_description").val($(this).attr('data-desc'));
                
            });

            $(document).on('click', '#submit-edit-button', function(){
                var url = `/task/${data_id}/update`;
                $('#edit-task-form').attr('action', url);
                $('#edit-task-form').submit();
            });

            $(document).on('click', ".delete-button", function() {
                    var data_id = $(this).attr('data-id');
                    var url = '/task/' + data_id;
                    $('#delete-form').attr('action', url);
            });
        });
    </script>
@endsection
