@extends('layout.penilai')

@section('title', 'Penilai | Hasil Penilaian')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center mb-4">Hasil Penilaian Siswa</h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }}</p>
                                    <p><strong>Asal Instansi:</strong> {{ $siswa->sekolah->nama_sekolah }}</p>
                                    <p><strong>Divisi PKL:</strong> {{ $siswa->divisi_pkl }}</p>
                                    <p><strong>Tanggal Mulai PKL:</strong> {{ $siswa->tanggal_mulai }}</p>
                                    <p><strong>Tanggal Berakhir PKL:</strong> {{ $siswa->tanggal_berakhir }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h4>Hasil Penilaian</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kriteria</th>
                                                <th scope="col">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kriteriaPenilaian as $kriteria)
                                            <tr>
                                                <td>{{ $kriteria['kriteria'] }}</td>
                                                <td>
                                                    @if (isset($dataPenilaian[$kriteria['kriteria']]))
                                                        {{ $dataPenilaian[$kriteria['kriteria']] }}
                                                    @else
                                                        Belum dinilai
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h4>Komentar</h4>
                                    <p>
                                        @if (!empty($hasilPenilaian->komentar))
                                            {{ $hasilPenilaian->komentar }}
                                        @else
                                            Tidak ada komentar
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('penilai.edithasilpenilaian', ['idHasilPenilaian' => $hasilPenilaian->id_hasil_penilaian]) }}" class="btn btn-info">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
