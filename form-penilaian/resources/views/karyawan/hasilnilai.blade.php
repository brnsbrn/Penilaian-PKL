<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karyawan | Hasil Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1 class='text-center mb-4'>Data Mahasiswa PKL</h1>
    <div class='container'>
            <table class="table">
                <thead>
                    <tr>
                        <th scope='col'>No</th>
                        <th scope='col'>Nama Mahasiswa</th>
                        <th scope='col'>Kedisiplinan</th>
                        <th scope='col'>Kinerja Kerja</th>
                        <th scope='col'>Kerapian</th>
                        <th scope='col'>Kesopanan</th>
                        <th scope='col'>Komentar</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($hasilPenilaian as $index => $penilaian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penilaian->nama_mahasiswa }}</td>
                        <td>{{ $penilaian->kedisiplinan }}</td>
                        <td>{{ $penilaian->kinerja_kerja }}</td>
                        <td>{{ $penilaian->kerapian }}</td>
                        <td>{{ $penilaian->kesopanan }}</td>
                        <td>{{ $penilaian->komentar }}</td>
                    </tr>  
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
