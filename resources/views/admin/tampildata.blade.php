@extends('layout.admin')

@section('title', 'Admin | Edit Data')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Siswa PKL</h1>
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
                              <form action='/updatedata/{{ $data -> id_mahasiswa }}' method='POST'>
                                    @csrf
                                    <div class="form-group">
                                      <label for="nama_mahasiswa">Nama Mahasiswa:</label>
                                      <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $data->nama_mahasiswa }}" required>
                                  </div>
                
                                  <div class="form-group">
                                      <label for="asal_instansi">Asal Instansi:</label>
                                      <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" value="{{ $data->asal_instansi }}" required>
                                  </div>
                
                                  <div class="form-group">
                                      <label for="divisi_pkl">Divisi PKL:</label>
                                      <input type="text" class="form-control" id="divisi_pkl" name="divisi_pkl" value="{{ $data->divisi_pkl }}" required>
                                  </div>
                
                                  <div class="form-group">
                                      <label for="no_telp">Nomor Telepon:</label>
                                      <input type="tel" class="form-control" id="no_telp" name="no_telp" pattern="[0-9]+" value="{{ $data->no_telp }}" required>
                                      <small class="form-text text-muted">Masukkan hanya angka (0-9).</small>
                                  </div>
                
                                  <div class="form-group">
                                      <label for="tanggal_mulai">Tanggal Mulai PKL:</label>
                                      <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $data->tanggal_mulai }}" required>
                                  </div>
                
                                  <div class="form-group">
                                      <label for="tanggal_berakhir">Tanggal Berakhir PKL:</label>
                                      <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" value="{{ $data->tanggal_berakhir }}" required>
                                  </div>
                
                                  <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
