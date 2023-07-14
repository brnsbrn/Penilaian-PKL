@if(session('role')=='karyawan')

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penilaian PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    
    <div class='container'>
        <div class='row'>
            <div class='card'>
                <div class='card-body'>
                    <h1 class='text-center mb-4'>Welkam {{ session('name') }}</h1>
                    <h5 class='text-center'>Ini adalah sistem informasi untuk penilaian siswa pkl di Bankaltim. Silahkan lakukan penilaian pad mahasiswa dengan menekan tombol di bawah ini.</h5>
                    <a href='/depan'><button type="button" class="btn btn-primary">Klik Untuk Lanjutkan</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
@endif

@if(session('role')=='admin')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penilaian PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <<body onload="noBack();">    >
    <div class='container'>
        <div class='row'>
            <div class='card'>
                <div class='card-body'>
                    <h1 class='text-center mb-4'>Welkam {{ session('name') }}</h1>
                    <h5 class='text-center'>Ini adalah sistem informasi untuk penilaian siswa pkl di Bankaltim. Silahkan Tambahkan, hapus, atau edit data mahasiswa yang melakukan pkl pada tombol di bawah ini.</h5>
                    <a href='/index'><button type="button" class="btn btn-primary center">Klik Untuk Lanjutkan</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
  <script>
    window.history.forward();
    function noBack() { window.history.forward(); }
  </script>
</html>
@endif