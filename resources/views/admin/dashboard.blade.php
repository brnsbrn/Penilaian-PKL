@extends('layout.admin')

@section('content')


  
@endsection
 @push('scripts')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Mahasiswa PKL</h1>
            </div><!-- /.col -->
            {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v2</li>
                </ol>
            </div><!-- /.col --> --}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class='container'>
            <a href='/tambahmahasiswa' class="btn btn-primary" style="margin-top: 10px">Tambah +</a>
            <div class="row g-3 align-items-center mt-1">
                <div class="col-auto">
                <form action='/homeadmin' method="GET">
                    <input type="search" id="search" class="form-control" name="search" aria-labelledby="passwordHelpInline" value="{{ $request->search ?? '' }}" style="margin-top: 5px">

                </form>
                </div>
                <a href='/tambahmahasiswa' class="btn btn-success">Export Excel</a>
            </div>
            <div class='row'>
            @if($message = Session::get('success'))
            <div class="alert alert-success mt-3 mb-2" role="alert">
                {{ $message }}
            </div>        
            @endif
                <table class="table" style="margin-top: 10px">
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
                </table>
            </div>
        </div>
    </div>
 @endpush  