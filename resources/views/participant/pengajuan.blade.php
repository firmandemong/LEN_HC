<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('template/img/logo/logo.png') }}" rel="icon">
    <title>Sign In</title>
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body class="bg-gradient-login">
    @include('sweetalert::alert')
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    @include('layout.notif')
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Pengajuan Magang / PKL</h1>
                                    </div>
                                    <p>Silahkan Lengkapi Data Berikut Untuk Mengajukan Mangang / PKL</p>
                                    <form action="/submission" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nama Lengkap</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nama Lengkap" required name="name"
                                                        value="{{ old('name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email Aktif</label>
                                                    <input type="email" class="form-control"
                                                        placeholder="example@example.com" required name="email"
                                                        value="{{ old('email') }}">
                                                    <small class="text-info">Pastikan Email valid, karena informasi
                                                        selanjutnya akan dikirim melalui email</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Jenis Pendidikan</label>
                                                    <select name="school_type" id="" class="form-control"
                                                        required>
                                                        <option disabled selected>Pilih Jenis Pendidikan</option>
                                                        <option value="SMK"
                                                            {{ old('school_type') == 'SMK' ? 'selected' : '' }}>SMK
                                                        </option>
                                                        <option value="Universitas"
                                                            {{ old('school_type') == 'Universitas' ? 'selected' : '' }}>
                                                            Universitas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nama Universitas/Sekolah</label>
                                                    <input type="text" id="tags" name="school_name"
                                                        list="cityname" class="form-control"
                                                        value="{{ old('school_name') }}">

                                                    <small class="text-info">Pilih dari rekomendasi bila data
                                                        tersedia</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Jurusan</label>
                                                    <select id="" class="form-control" name="major" required>
                                                        <option disabled selected>Pilih Jurusan</option>
                                                        @foreach ($majors as $major)
                                                            <option value="{{ $major->id }}"
                                                                {{ old('major') == $major->id ? 'selected' : '' }}>
                                                                {{ $major->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Upload Surat Pengajuan PKL</label>
                                                    <input type="file" class="form-control"
                                                        name="file_application_letter" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Upload CV</label>
                                                    <input type="file" name="file_cv" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Upload Transkrip Nilai</label>
                                                    <input type="file" name="file_transcript" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="">Enter Captcha</label>
                                                    <input id="captcha" type="text" class="form-control "
                                                        placeholder="Enter Captcha" name="captcha">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="captcha" class="">Captcha</label>
                                                    <div class="captcha">
                                                        <span>{!! captcha_img() !!}</span>
                                                        <button type="button" class="btn btn-danger" class="reload"
                                                            id="reload">

                                                            &#x21bb;
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Kirim
                                                Berkas</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="/login">Kembali ke Halaman Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $('#reload').click(function() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>

<script>
    $(function() {
        var availableTags = <?php echo $schools; ?>;
        console.log(`aa ${availableTags}`);
        $("#tags").autocomplete({
            source: availableTags
        });
    });
</script>

</html>
