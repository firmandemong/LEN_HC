@extends("layout.main")
@section('sidebar')
@include('layout.mentor-sidebar')
@endsection


@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4 text-center">Buat Tugas</h5>
                <form action="/list-tugas/store" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="task_name" class="form-label">Nama Tugas</label>
                        <input type="text" class="form-control @error('task_name') is-invalid @enderror" id="task_name" name="task_name" placeholder="Nama Tugas" required>
                        @error('task_name') <div class="invalid-feedback">{{$message}}</div> @enderror

                    </div>

                    <div class="mb-3">
                        <label for="task_description" class="form-label">Deskripsi Tugas</label>
                        <textarea class="form-control @error('task_description') is-invalid @enderror" id="task_description" name="task_description" placeholder="Deskripsi Tugas" required></textarea>
                        @error('task_description') <div class="invalid-feedback">{{$message}}</div> @enderror

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="participant" class="form-label">Nama Peserta</label>
                                <select name="participant" id="" class="form-select @error('participant') is-invalid @enderror" required>
                                    <option value="">Pilih Peserta</option>
                                    @foreach($participants as $participant)
                                    <option value="{{$participant->id}}">{{$participant->name}}</option>
                                    @endforeach
                                </select>
                                @error('participant') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" required>
                                @error('deadline') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="float: right; margin-bottom:20px">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection