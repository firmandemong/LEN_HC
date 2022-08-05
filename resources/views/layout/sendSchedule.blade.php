<!DOCTYPE html>

<html>

<head>

    <title>Len</title>

</head>

<body>
    @if($role == 'peserta')
    <h3>Halo {{$name}},</h3>
    <p>Selamat karena Anda telah lolos tahap 1 pengajuan program PKL/Magang di PT LEN. Untuk tahap berikutnya, Kami mengundang Anda untuk mengikuti Proses Wawancara yang diadakan pada: </p>
    <table>
        <tr>
            <td>Waktu</td>
            <td>:</td>
            <td>{{date('d F Y',strtotime($interviewDate)) . ', Pukul ' . date('H:i',strtotime($interviewTime)) }}</td>
        </tr>
        <tr>
            <td>Tipe Wawancara</td>
            <td>:</td>
            <td>{{$interviewType}}</td>
        </tr>
        <tr>
            <td>{{$interviewType == 'Online' ? 'Link' : 'Tempat'}}</td>
            <td>:</td>
            <td>{{$interviewPlace}}</td>
        </tr>
    </table>

    @elseif($role=='mentor')
    <h3>Halo Bapak/Ibu {{$name}},</h3>
    <p>Berkaitan dengan Program Magang/PKL di divisi {{$divisi}}, maka kami mengundang Bapak/Ibu untuk melakukan wawancara terhadap calon peserta yang akan dilaksanakan pada: </p>
    <table>
        <tr>
            <td>Waktu</td>
            <td>:</td>
            <td>{{date('d F Y',strtotime($interviewDate)) . ', Pukul ' . date('H:i',strtotime($interviewTime)) }}</td>
        </tr>
        <tr>
            <td>Tipe Wawancara</td>
            <td>:</td>
            <td>{{$interviewType}}</td>
        </tr>
        <tr>
            <td>{{$interviewType == 'Online' ? 'Link' : 'Tempat'}}</td>
            <td>:</td>
            <td>{{$interviewPlace}}</td>
        </tr>
    </table>
    @endif

    <p>Terimakasih</p>
</body>

</html>