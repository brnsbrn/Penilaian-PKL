@extends('layout.penilai')

@section('title', 'Penilai | Data Siswa')
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
        <h1 class='text-center mb-4'>Data Siswa</h1>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSekolah">Tambah +</a>
        <div class="row g-3 align-items-center mt-1">
            <div class="col-auto">
                <form action='' method="GET">
                    <input type="search" id="search" class="form-control" name="search" aria-labelledby="passwordHelpInline" value="{{ $request->search ?? '' }}" style="margin-top: 5px" placeholder='Cari nama siswa...'>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Divisi PKL</th>
                        <th scope="col">Asal Sekolah</th>
                        <th scope="col">Status</th>
                        <th scope="col">Status Penilaian</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                     $nomorUrutAwal = ($data->currentPage() - 1) * $data->perPage() + 1;
                    @endphp

                    @foreach ($data as $siswa)
                    <tr>
                        <th>{{ $nomorUrutAwal + $loop->index }}</th>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#detailModal{{ $siswa->id_siswa }}">
                                {{ $siswa->nama_siswa }}
                            </a>
                        </td>
                        <td>{{ $siswa->divisi_pkl }}</td>
                        <td>{{ $siswa->sekolah->nama_sekolah }}</td>
                        <td>
                            @php
                            $today = date('Y-m-d');
                            $status = ($today <= $siswa->tanggal_berakhir) ? 'Sedang Berlangsung' : 'Selesai';
                            $statusClass = ($status == 'Sedang Berlangsung') ? 'bg-warning' : 'bg-success';
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $status }}</span>
                        </td>
                        <td>
                            @php
                            $isAssessed = \App\Models\HasilPenilaian::where('id_siswa', $siswa->id_siswa)
                                            ->where('id_user', \Illuminate\Support\Facades\Auth::id())
                                            ->exists();
                            $assessmentStatus = $isAssessed ? 'Sudah Dinilai' : 'Belum Dinilai';
                            $assessmentStatusClass = $isAssessed ? 'bg-success' : 'bg-danger';
                            @endphp
                            <span class="badge {{ $assessmentStatusClass }}">{{ $assessmentStatus }}</span>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="detailModal{{ $siswa->id_siswa }}" tabindex="-1"
                        role="dialog" aria-labelledby="detailModalLabel{{ $siswa->id_siswa }}"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="detailModalLabel{{ $siswa->id_siswa }}">Detail Mahasiswa:
                                        {{ $siswa->nama_siswa }}</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }}
                                            </p>
                                            <p><strong>Asal Instansi:</strong> {{ $siswa->sekolah->nama_sekolah }}</p>
                                            <p><strong>Divisi PKL:</strong> {{ $siswa->divisi_pkl }}</p>
                                            <p><strong>Tanggal Mulai PKL:</strong> {{ $siswa->tanggal_mulai }}
                                            </p>
                                            <p><strong>Tanggal Berakhir PKL:</strong>
                                                {{ $siswa->tanggal_berakhir }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    @if (!$siswa->hasilPenilaian)
                                        <a href="/penilai/formnilai/{{ $siswa->id_siswa }}" type="button" class="btn btn-success btn-sm">Nilai</a>
                                    @endif
                                    <a href="/penilai/hasilpenilaian/{{ $siswa->id_siswa }}" type="button" class="btn btn-secondary btn-sm">Lihat Nilai</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
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
{{-- 
@foreach ($sekolahan as $sekolah) --}}
<!-- Modal Edit Sekolah -->
{{-- <div class="modal fade" id="modalEditSekolah{{ $sekolah->id_sekolah }}" tabindex="-1" role="dialog" aria-labelledby="modalEditSekolahLabel{{ $sekolah->id_sekolah }}" aria-hidden="true">
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
</div> --}}

<!-- Modal Hapus Sekolah -->
{{-- <div class="modal fade" id="modalHapusSekolah{{ $sekolah->id_sekolah }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusUserLabel{{ $sekolah->id_sekolah }}" aria-hidden="true">
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
</div> --}}
{{-- @endforeach --}}


@endsection

@push('scripts')
<!-- JavaScript code here -->
@endpush
