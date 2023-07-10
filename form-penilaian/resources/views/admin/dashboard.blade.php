<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Daftar Mahasiswa PKL</title>
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
                        <td><a href='/showmahasiswa/{{ $row->id_mahasiswa }}'>{{ $row->nama_mahasiswa }}</a></td>
                        <td>{{ $row->asal_instansi }}</td>
                        <td>{{ $row->divisi_pkl }}</td>
                        <td>
                            <a href='/tampildata/{{ $row->id_mahasiswa }}' type="button" class="btn btn-warning">Edit</a>
                            <a href='' type="button" class="btn btn-danger delete" data-id='{{ $row->id_mahasiswa }}' data-nama='{{ $row->nama_mahasiswa }}'>Hapus</a>
                        </td>
                    </tr>  
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
  </body>
  <script>
  $('.delete').click(function(){
    var idmahasiswa = $(this).attr('data-id');
    var namamahasiswa = $(this).attr('data-nama');
    swal({
        title: "Yakin?",
        text: "Anda akan menghapus "+namamahasiswa+" dari daftar",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/deletedata/"+idmahasiswa+""
            swal("Data Berhasil Dihapus", {
            icon: "success",
            });
        } else {
            swal("Penghapusan Data Dibatalkan");
        }
        });
  });
  </script>
</html>