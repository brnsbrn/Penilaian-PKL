@extends('layout.sekolah')

@section('title', 'Sekolah | Data Siswa')
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
        <h1 class='text-center mb-4'>Data Siswa {{ session('nama')}}</h1>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSiswa">Tambah +</a>
        <div class="row g-3 align-items-center mt-1">
            <div class="col-auto">
                <form action='' method="GET">
                    <input type="search" id="search" class="form-control" name="search" aria-labelledby="passwordHelpInline" value="{{ $request->search ?? '' }}" style="margin-top: 5px" placeholder="Cari nama siswa...">
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
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Divisi PKL</th>
                        <th scope="col">Tanggal Berakhir PKL</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>                
                <tbody>
                    @php
                     $nomorUrutAwal = ($siswa->currentPage() - 1) * $siswa->perPage() + 1;
                    @endphp
            
                    @foreach ($siswa as $dataSiswa)
                    <tr>
                        <th>{{ $nomorUrutAwal + $loop->index }}</th>
                        <td>{{ $dataSiswa->nama_siswa }}</td>
                        <td>{{ $dataSiswa->divisi_pkl }}</td>
                        <td>{{ $dataSiswa->tanggal_berakhir }}</td>
                        <td>
                            @php
                            $today = date('Y-m-d');
                            $status = ($today <= $dataSiswa->tanggal_berakhir) ? 'Sedang Berlangsung' : 'Selesai';
                            $statusClass = ($status == 'Sedang Berlangsung') ? 'bg-warning' : 'bg-success';
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $status }}</span>
                        </td>
                        <td>
                            <!-- Tombol Edit, Hapus, dan Lihat Nilai Siswa -->
                            <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditSiswa{{ $dataSiswa->id_siswa }}">Edit</a>
                            <a href="#" data-toggle="modal" data-target="#modalHapusSiswa{{ $dataSiswa->id_siswa }}" type="button" class="btn btn-danger delete">Hapus</a>
                            <a href="{{ route('sekolah.hasil_penilaian', ['idSiswa' => $dataSiswa->id_siswa]) }}" class="btn btn-primary">Lihat Nilai</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Menampilkan tautan paginasi -->
            <div class="d-flex justify-content-center mt-4">
                {{ $siswa->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSiswaLabel">Tambah Siswa Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sekolah.simpanSiswa') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Siswa:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="divisi_pkl">Divisi PKL:</label>
                        <input type="text" class="form-control" id="divisi_pkl" name="divisi_pkl" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai PKL:</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_berakhir">Tanggal Berakhir PKL:</label>
                        <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


@foreach ($siswa as $data)
<!-- Modal Edit Data Siswa -->
<div class="modal fade" id="modalEditSiswa{{ $data->id_siswa }}" tabindex="-1" role="dialog" aria-labelledby="modalEditSiswaLabel{{ $data->id_siswa }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSiswaLabel{{ $data->id_siswa }}">Edit Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sekolah.updateSiswa', $data->id_siswa) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Siswa:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama_siswa }}" required>
                    </div>
                    <div class="form-group">
                        <label for="divisi_pkl">Divisi PKL:</label>
                        <input type="text" class="form-control" id="divisi_pkl" name="divisi_pkl" value="{{ $data->divisi_pkl }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai PKL:</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $data->tanggal_mulai }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_berakhir">Tanggal Berakhir PKL:</label>
                        <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" value="{{ $data->tanggal_berakhir }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@foreach ($siswa as $data)
<!-- Modal Hapus Siswa -->
<div class="modal fade" id="modalHapusSiswa{{ $data->id_siswa }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusSiswaLabel{{ $data->id_siswa }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusSiswaLabel{{ $data->id_siswa }}">Hapus Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Apakah Anda yakin ingin menghapus data siswa {{ $data->nama_siswa }}?</h6>
            </div>
            <div class="modal-footer">
                <form action="{{ route('sekolah.deletesiswa', $data->id_siswa) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection

@push('scripts')
<script>
</script>
@endpush
