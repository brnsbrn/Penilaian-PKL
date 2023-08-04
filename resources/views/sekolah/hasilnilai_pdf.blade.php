<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siswa->nama_siswa }}_{{ $siswa->sekolah->nama_sekolah }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        text-align: center;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 2px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #0066cc;
        margin-bottom: 20px;
    }

    p {
        margin-bottom: 10px;
    }

    strong {
        font-weight: bold;
    }

    </style>
</head>
<body>
    <div class="container">
        <h1>SERTIFIKAT</h1>
        <p>
            Diberikan kepada:
            <br>
            <strong>{{ $siswa->nama_siswa }}</strong>
        </p>
        <p>
            Telah berhasil menyelesaikan Program PKL di <strong>Bankaltimtara</strong>
        </p>
        <p>
            Dalam kurun waktu
            <br>
            <strong>{{ $siswa->tanggal_mulai }}</strong>
            Hingga
            <strong>{{ $siswa->tanggal_berakhir }}</strong>
        </p>
        <p>Dengan predikat nilai</p>
        @if ($statusNilai === 'Sangat Baik')
            <strong style="color: green;">{{ $statusNilai }}</strong>
        @elseif ($statusNilai === 'Baik')
            <strong style="color: blue;">{{ $statusNilai }}</strong>
        @elseif ($statusNilai === 'Cukup')
            <strong style="color: yellow;">{{ $statusNilai }}</strong>
        @elseif ($statusNilai === 'Buruk')
            <strong style="color: orange;">{{ $statusNilai }}</strong>
        @else
            <strong style="color: red;">{{ $statusNilai }}</strong>
        @endif
                                
    </div>
</body>
</html>
