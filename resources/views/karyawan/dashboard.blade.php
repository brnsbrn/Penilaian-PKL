@extends('layout.karyawan')

@section('title', 'Karyawan | Data Siswa PKL')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class='text-center mb-4'>Data Siswa PKL</h1>
                @if ($errors->has('penilaian'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('penilaian') }}
                </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class='container'>
                    <div class="mb-3">
                        <form action="{{ route('karyawan.search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari nama siswa" value="{{ $search ?? '' }}">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Asal Instansi</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = ($data->currentPage() - 1) * $data->perPage() + 1;
                            @endphp
                            @foreach($data as $row)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#detailModal{{ $row->id_mahasiswa }}">
                                        {{ $row->nama_mahasiswa }}
                                    </a>
                                </td>
                                <td>{{ $row->asal_instansi }}</td>
                                <td>{{ $row->divisi_pkl }}</td>
                                <td class="{{ $studentStatus[$row->id_mahasiswa] === 'Sudah Dinilai' ? 'status-done' : 'status-pending' }}">
                                    {{ $studentStatus[$row->id_mahasiswa] }}
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="detailModal{{ $row->id_mahasiswa }}" tabindex="-1"
                                role="dialog" aria-labelledby="detailModalLabel{{ $row->id_mahasiswa }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="detailModalLabel{{ $row->id_mahasiswa }}">Detail Mahasiswa:
                                                {{ $row->nama_mahasiswa }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><strong>Nama Mahasiswa:</strong> {{ $row->nama_mahasiswa }}
                                                    </p>
                                                    <p><strong>Asal Instansi:</strong> {{ $row->asal_instansi }}</p>
                                                    <p><strong>Divisi PKL:</strong> {{ $row->divisi_pkl }}</p>
                                                    <p><strong>No. Telepon:</strong> {{ $row->no_telp }}</p>
                                                    <p><strong>Tanggal Mulai PKL:</strong> {{ $row->tanggal_mulai }}
                                                    </p>
                                                    <p><strong>Tanggal Berakhir PKL:</strong>
                                                        {{ $row->tanggal_berakhir }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/berinilai/{{ $row->id_mahasiswa }}" type="button"
                                                class="btn btn-success btn-sm">Nilai</a>
                                            <a href="/hasilpenilaian/{{ $row->id_mahasiswa }}" type="button"
                                                class="btn btn-secondary btn-sm">Lihat Nilai</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Teks "Status" dengan warna hijau */
        .status-done {
            color: green;
        }

        /* Teks "Status" dengan warna merah */
        .status-pending {
            color: red;
        }
    </style>
@endsection

@push('scripts')
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
@endpush
