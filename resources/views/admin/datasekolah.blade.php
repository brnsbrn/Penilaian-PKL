@extends('layout.admin')

@section('title', 'Admin | Data Sekolah')
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
        <h1 class='text-center mb-4'>Data Sekolah</h1>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSekolah">Tambah +</a>
        <div class="row g-3 align-items-center mt-1">
            <div class="col-auto">
                <form action='' method="GET">
                    <input type="search" id="search" class="form-control" name="search" aria-labelledby="passwordHelpInline" value="{{ $request->search ?? '' }}" style="margin-top: 5px">
                </form>
            </div>
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
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp

                    @foreach ($sekolahan as $sekolah)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $sekolah->nama_sekolah }}</td>
                        <td>
                            <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditSekolah{{ $sekolah->id_sekolah }}">Edit</a>
                            <a href="#" data-toggle="modal" data-target="#modalHapusSekolah{{ $sekolah->id_sekolah }}" type="button" class="btn btn-danger delete">Hapus</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Sekolah -->
<div class="modal fade" id="modalTambahSekolah" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahUserLabel">Tambah Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.simpansekolah') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Sekolah:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($sekolahan as $sekolah)
<!-- Modal Edit Sekolah -->
<div class="modal fade" id="modalEditSekolah{{ $sekolah->id_sekolah }}" tabindex="-1" role="dialog" aria-labelledby="modalEditSekolahLabel{{ $sekolah->id_sekolah }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSekolahLabel{{ $sekolah->id_sekolah }}">Edit Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.updatesekolah', $sekolah->id_sekolah) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $sekolah->nama_sekolah }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Sekolah -->
<div class="modal fade" id="modalHapusSekolah{{ $sekolah->id_sekolah }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusUserLabel{{ $sekolah->id_sekolah }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusUserLabel{{ $sekolah->id_sekolah }}">Penghapusan Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Hapus dari daftar sekolah?</h6>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('admin.hapussekolah', $sekolah->id_sekolah) }}" type="button" class="btn btn-danger delete">Iya</a>
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
<!-- JavaScript code here -->
@endpush
