@extends('layout.admin')

@section('title', 'Admin | Data User')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class='container'>
        <h1 class='text-center mb-4'>Data User</h1>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahUser">Tambah +</a>
        <div class="row g-3 align-items-center mt-1">
            <div class="col-auto">
                <form action="{{ route('admin.datauser') }}" method="GET">
                    <input type="search" id="search" class="form-control" name="search" aria-labelledby="passwordHelpInline" value="{{ $request->search ?? '' }}" style="margin-top: 5px" placeholder="Search by Username">
                </form>
            </div>
        </div>
        <div class='row'>
            @if($message = Session::get('success'))
            <div class="alert alert-success mt-3 mb-2" role="alert">
                {{ $message }}
            </div>
            @endif
            @if($message = Session::get('error'))
            <div class="alert alert-danger mt-3 mb-2" role="alert">
                {{ $message }}
            </div>
            @endif
            <table class="table" style="margin-top: 10px">
                <thead>
                <tr
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Peran</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp

                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $users->perPage() * ($users->currentPage() - 1) + $loop->iteration }}</th>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->peran }}</td>
                        <td>
                            <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditUser{{ $user->id }}">Edit</a>
                            <a href="#" data-toggle="modal" data-target="#modalHapusUser{{ $user->id }}" type="button" class="btn btn-danger delete">Hapus</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahUserLabel">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.simpanuser') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="peran">Peran:</label>
                        <select class="form-control" id="peran" name="peran" required>
                            <option value="sekolah">Sekolah</option>
                            <option value="penilai">Penilai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($users as $user)
<!-- Modal Edit User -->
<div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditUserLabel{{ $user->id }}">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.updateuser', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="peran">Peran:</label>
                        <select class="form-control" id="peran" name="peran" required>
                            <option value="sekolah" {{ $user->peran == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                            <option value="penilai" {{ $user->peran == 'penilai' ? 'selected' : '' }}>Penilai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus User -->
<div class="modal fade" id="modalHapusUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusUserLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusUserLabel{{ $user->id }}">Penghapusan Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Hapus dari daftar user?</h6>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('admin.hapususer', $user->id) }}" type="button" class="btn btn-danger delete">Iya</a>
                        <button type="button" class="btn btn-success" data-dismiss="modal" style="margin-left: 10px">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

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
