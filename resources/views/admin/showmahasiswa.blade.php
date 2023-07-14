@extends('layout.admin')

@section('content')
    
@endsection

@push('scripts')
  <body>
    <h1 class='text-center mb-4'>Data Siswa PKL</h1>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p class="card-text"><strong>Nama Mahasiswa:</strong> {{ $data->nama_mahasiswa }}</p>
              <p class="card-text"><strong>Asal Instansi:</strong> {{ $data->asal_instansi }}</p>
              <p class="card-text"><strong>Divisi PKL:</strong> {{ $data->divisi_pkl }}</p>
            </div>
            <div class="col-md-6">
              <p class="card-text"><strong>No. Telepon:</strong> {{ $data->no_telp }}</p>
              <p class="card-text"><strong>Tanggal Mulai PKL:</strong> {{ $data->tanggal_mulai }}</p>
              <p class="card-text"><strong>Tanggal Berakhir PKL:</strong> {{ $data->tanggal_berakhir }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
@endpush
  