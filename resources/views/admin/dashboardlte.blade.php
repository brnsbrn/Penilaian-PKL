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
                        <div class="info-box-content">
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
                            <span class="info-box-text">Pelajar PKL Baru</span>
                            <span class="info-box-number">{{ $jumlahMahasiswaBaru }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-building-user"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pelajar PKL Lama</span>
                            <span class="info-box-number">{{ $jumlahMahasiswaLama }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-building"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Instansi</span>
                            <span class="info-box-number">{{ $totalAsalInstansi }}</span>
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
                                            <th>Jumlah Mahasiswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataAsalInstansi as $instansi)
                                        <tr>
                                            <td>{{ $instansi->asal_instansi }}</td>
                                            <td>{{ $instansi->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $dataAsalInstansi->links('pagination::bootstrap-4', ['paginator' => $dataAsalInstansi]) }} <!-- Menampilkan link pagination -->
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
                                            <th>Jumlah Mahasiswa</th>
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
                                {{ $dataDivisiPKL->links('pagination::bootstrap-4', ['paginator' => $dataDivisiPKL]) }} <!-- Menampilkan link pagination -->
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
var dataAsalInstansi = {!! json_encode($dataAsalInstansi) !!};
var dataDivisiPKL = {!! json_encode($dataDivisiPKL) !!};
var colors = ['rgba(196, 36, 131, 0.5)', 'rgba(36, 131, 196, 0.5)', 'rgba(196, 181, 36, 0.5)', 'rgba(101, 36, 196, 0.5)', 'rgba(196, 101, 36, 0.5)'];

// Mengambil konteks canvas
var ctxAsalInstansi = document.getElementById('chartAsalInstansi').getContext('2d');
var ctxDivisiPKL = document.getElementById('chartDivisiPKL').getContext('2d');

// Membuat chart - Persebaran Asal Instansi
var chartAsalInstansi = new Chart(ctxAsalInstansi, {
    type: 'bar',
    data: {
        labels: Object.keys(dataAsalInstansi),
        datasets: [{
            label: 'Jumlah Mahasiswa',
            data: Object.values(dataAsalInstansi),
            backgroundColor: colors,
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                ticks: {
                    autoSkip: true,
                    maxRotation: 0,
                    padding: 10
                }
            },
            y: {
                beginAtZero: true,
                precision: 0
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Membuat chart - Persebaran Divisi PKL
var chartDivisiPKL = new Chart(ctxDivisiPKL, {
    type: 'bar',
    data: {
        labels: Object.keys(dataDivisiPKL),
        datasets: [{
            label: 'Jumlah Mahasiswa',
            data: Object.values(dataDivisiPKL),
            backgroundColor: colors,
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                ticks: {
                    autoSkip: false, // Mengubah menjadi false
                    maxRotation: 0,
                    padding: 10
                }
            },
            y: {
                beginAtZero: true,
                precision: 0
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});


</script>
@endpush

@endsection