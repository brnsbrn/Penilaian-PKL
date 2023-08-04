@extends('layout.admin')

@section('title', 'Admin | Dashboard')
@section('content')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content-wrapper" style="margin-top: 70px">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content" >
                                <span class="info-box-text">Total Jumlah Pelajar PKL</span>
                                <span class="info-box-number">
                                    {{ $totaldata }}
                                    <small>Pelajar PKL</small>
                                </span>
                            </div>
                        </div>
                </div>
 
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-person-walking"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Siswa Selesai PKL</span>
                            <span class="info-box-number">{{ $jumlahSelesaiPKL }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-building-user"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Siswa Masih PKL</span>
                            <span class="info-box-number">{{ $jumlahMasihPKL }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-building"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Instansi</span>
                            <span class="info-box-number">{{ $totalsekolah }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel - Persebaran Asal Instansi -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Persebaran Jumlah Asal Instansi Mahasiswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Asal Instansi</th>
                                            <th>Jumlah Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataAsalInstansi as $instansi)
                                        <tr>
                                            <td>{{ $instansi->sekolah->nama_sekolah }}</td>
                                            <td>{{ $instansi->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $dataAsalInstansi->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel - Persebaran Divisi PKL -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Persebaran Jumlah Divisi Tempat Mahasiswa PKL</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Divisi PKL</th>
                                            <th>Jumlah Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($dataDivisiPKL as $divisi)
                                        <tr>
                                            <td>{{ $divisi->divisi_pkl }}</td>
                                            <td>{{ $divisi->total }}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $dataDivisiPKL->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>


</script>
@endpush

@endsection
