@extends('layout.mahasiswa')

@section('title', 'Mahasiswa | Dashboard')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class='text-center mb-4'>Hasil Penilaian Terhadap {{ session('name') }} </h1>
            <div class='container'>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Penilai</th>
                                <th>Kedisiplinan</th>
                                <th>Kinerja Kerja</th>
                                <th>Kerapian</th>
                                <th>Kesopanan</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($penilaian as $index => $item)
                            <tr>
                                <td>{{ $item->penilai->name }}</td>
                                <td>{{ $item->kedisiplinan }}</td>
                                <td>{{ $item->kinerja_kerja }}</td>
                                <td>{{ $item->kerapian }}</td>
                                <td>{{ $item->kesopanan }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#komenModal{{ $item->id_penilaian }}">
                                    Baca Komentar
                                <td>{{ $item->created_at }}</td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="komenModal{{ $item->id_penilaian }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $item->id_penilaian }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $item->id_penilaian }}">Detail Komentar: {{ $item->nama_mahasiswa }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><strong>Komentar:</strong> </p>
                                                    <p>{{ $item->komentar }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 class="text-center mb-4">Nilai Rata-rata</h2>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kedisiplinan</th>
                                <th>Kinerja Kerja</th>
                                <th>Kerapian</th>
                                <th>Kesopanan</th>
                                <th>Total</th>
                                <th>Kesimpulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>{{ $nilaiKedisiplinan }}</td>
                            <td>{{ $nilaiKinerja }}</td>
                            <td>{{ $nilaiKerapian }}</td>
                            <td>{{ $nilaiKesopanan }}</td>
                            <td>{{ $rata2 }}</td>
                            <td>
                                @if ($rata2 > 7)
                                    <span class="text-success">Sangat Baik</span>
                                @elseif ($rata2 > 5 && $rata2 <= 7)
                                    <span class="text-warning">Baik</span>
                                @else
                                    <span class="text-danger">Buruk</span>
                                @endif
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
    </div>
  </div>
@endsection
