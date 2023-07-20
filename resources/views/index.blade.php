@if(session('role')=='karyawan')
<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('logo_favi.ico') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penilaian PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-image: url('img/bg_logo.jpg'); /* Ganti dengan path ke gambar background */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            max-width: 400px;
            padding: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body onload="noBack();">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center mb-4">Welcome {{ session('name') }}</h1>
            <h5 class='text-center'>Ini adalah sistem informasi untuk penilaian siswa pkl di Bankaltim. Silahkan lakukan penilaian pad mahasiswa dengan menekan tombol di bawah ini.</h5>
            <div class="center">
                <a href="/depan"><button type="button" class="btn btn-primary">Klik Untuk Lanjutkan</button></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        window.history.forward();
        function noBack() { window.history.forward(); }
    </script>
</body>
</html>
@endif

@if(session('role')=='admin')
<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('logo_favi.ico') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penilaian PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-image: url('img/bg_logo.jpg'); /* Ganti dengan path ke gambar background */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            max-width: 400px;
            padding: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body onload="noBack();">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center mb-4">Welcome {{ session('name') }}</h1>
            <h5 class="welcome-text">Ini adalah sistem informasi untuk penilaian siswa PKL di Bankaltim. Silahkan tambahkan, hapus, atau edit data mahasiswa yang melakukan PKL pada tombol di bawah ini.</h5>
            <div class="center">
                <a href="/index"><button type="button" class="btn btn-primary">Klik Untuk Lanjutkan</button></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        window.history.forward();
        function noBack() { window.history.forward(); }
    </script>
</body>
</html>
@endif

@if(session('role')=='mahasiswa')
<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('logo_favi.ico') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penilaian PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-image: url('img/bg_logo.jpg'); /* Ganti dengan path ke gambar background */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            max-width: 400px;
            padding: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body onload="noBack();">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center mb-4">Welcome {{ session('name') }}</h1>
            <h5 class='text-center'>Ini adalah sistem informasi untuk penilaian siswa pkl di Bankaltim. Silahkan klik tombol di bawah ini untuk melihat hasil penilaian karyawan Bankaltimtara terhadap anda</h5>
            <div class="center">
                <a href="/penilaian"><button type="button" class="btn btn-primary">Klik Untuk Lanjutkan</button></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        window.history.forward();
        function noBack() { window.history.forward(); }
    </script>
</body>
</html>
@endif