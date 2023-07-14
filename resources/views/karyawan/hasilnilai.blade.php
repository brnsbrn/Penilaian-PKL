@extends('layout.karyawan')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mahasiswa PKL</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th scope='col'>No</th>
                                    <th scope='col'>Nama Mahasiswa</th>
                                    <th scope='col'>Kedisiplinan</th>
                                    <th scope='col'>Kinerja Kerja</th>
                                    <th scope='col'>Kerapian</th>
                                    <th scope='col'>Kesopanan</th>
                                    <th scope='col'>Komentar</th>
                                    <th scope='col'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($hasilPenilaian as $index => $penilaian)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $penilaian->nama_mahasiswa }}</td>
                                    <td>{{ $penilaian->kedisiplinan }}</td>
                                    <td>{{ $penilaian->kinerja_kerja }}</td>
                                    <td>{{ $penilaian->kerapian }}</td>
                                    <td>{{ $penilaian->kesopanan }}</td>
                                    <td>{{ $penilaian->komentar }}</td>
                                    <td><a href="/ubahnilai/{{ $penilaian->id_penilaian }}" class="btn btn-primary btn-sm">Ubah Nilai</a></td>
                                </tr>  
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    
@endsection