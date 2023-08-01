@extends('layout.sekolah')

@section('title', 'Sekolah | Hasil Penilaian')

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
                                                <th scope="col">Tanggal Penilaian</th>
                                                @foreach ($kriteriaPenilaian as $kriteria)
                                                    <th scope="col">{{ $kriteria['kriteria'] }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hasilPenilaian as $index => $hasil)
                                                <tr>
                                                    <td>{{ $hasil->created_at }}</td>
                                                    @foreach ($dataPenilaian[$index] as $nilai)
                                                        <td>{{ $nilai }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h4>Nilai Rata-Rata</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kriteria</th>
                                                <th scope="col">Rata-Rata</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($nilaiRataRata as $kriteria => $rataRata)
                                                <tr>
                                                    <td>{{ $kriteria }}</td>
                                                    <td>{{ $rataRata }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h4>Nilai Total</h4>
                                    <p>{{ $nilaiTotal }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
