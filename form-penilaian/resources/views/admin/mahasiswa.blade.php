<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dummy Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1 class='text-center mb-4'>Data Siswa PKL</h1>
    <div class='container'>
        <a href='/tambahmahasiswa' class="btn btn-primary">Tambah +</a>
        <div class='row'>
        @if($message = Session::get('success'))
        <div class="alert alert-success mt-3 mb-2" role="alert">
            {{ $message }}
        </div>        
        @endif
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Asal Instansi</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($data as $row)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $row->nama_mahasiswa }}</td>
                        <td>{{ $row->asal_instansi }}</td>
                        <td>{{ $row->divisi_pkl }}</td>
                        <td>
                            <a href='/tampildata/{{ $row->id_mahasiswa }}' type="button" class="btn btn-warning">Edit</a>
                            <a href='/deletedata/{{ $row->id_mahasiswa }}' type="button" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>  
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>