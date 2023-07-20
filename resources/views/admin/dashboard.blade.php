@extends('layout.admin')

@section('title', 'Admin | Data Siswa PKL')
@section('content')

    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                </div>
                </div>
            </div><!-- /.container-fluid -->
            <div class='container'>
                <h1 class='text-center mb-4'>Data Siswa PKL</h1>
                <a href='/tambahmahasiswa' class="btn btn-primary">Tambah +</a>
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
                        @foreach($data as $index => $row)
                            <tr>
                                <th scope="row">{{ $index + $data->firstitem() }}</th>
                                <td><a href="#" data-toggle="modal" data-target="#detailModal{{ $row->id_mahasiswa }}">
                                        {{ $row->nama_mahasiswa }}
                                    </a>
                                </td>
                                <td>{{ $row->asal_instansi }}</td>
                                <td>{{ $row->divisi_pkl }}</td>
                                <td>
                                    <a href='/tampildata/{{ $row->id_mahasiswa }}' type="button" class="btn btn-warning">Edit</a>
                                    <a href="#" data-toggle="modal" data-target="#hapusModal{{ $row->id_mahasiswa }}" type="button" class="btn btn-danger delete">Hapus</a>
                                </td>
                            </tr> 
                            <!-- Modal -->
                            <div class="modal fade" id="detailModal{{ $row->id_mahasiswa }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $row->id_mahasiswa }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $row->id_mahasiswa }}">Detail Mahasiswa: {{ $row->nama_mahasiswa }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><strong>Nama Mahasiswa:</strong> {{ $row->nama_mahasiswa }}</p>
                                                    <p><strong>Asal Instansi:</strong> {{ $row->asal_instansi }}</p>
                                                    <p><strong>Divisi PKL:</strong> {{ $row->divisi_pkl }}</p>
                                                    <p><strong>No. Telepon:</strong> {{ $row->no_telp }}</p>
                                                    <p><strong>Tanggal Mulai PKL:</strong> {{ $row->tanggal_mulai }}</p>
                                                    <p><strong>Tanggal Berakhir PKL:</strong> {{ $row->tanggal_berakhir }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="modal fade" id="hapusModal{{ $row->id_mahasiswa }}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel{{ $row->id_mahasiswa }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel{{ $row->id_mahasiswa }}">Penghapusan Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Hapus {{$row->nama_mahasiswa}} dari daftar pekerja PKL?</h6>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href='/deletedata/ {{ $row->id_mahasiswa }}' type="button" class="btn btn-danger delete" data-id='{{ $row->id_mahasiswa }}' data-nama='{{ $row->nama_mahasiswa }}'>Iya</a>
                                                    <button type="button" class="btn btn-success" data-dismiss="modal" style="margin-left: 10px">Tidak</button>
                                                </div>
                                            
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                        </tbody>
                        
                            
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
  
@endsection
 @push('scripts')
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
 @endpush  