@extends('layout.karyawan')

@section('content')
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <h1 class='text-center mb-4'>Data Pekerja PKL</h1>
              <div class='container'>
                      <table class="table">
                          <thead>
                              <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Asal Instansi</th>
                              <th scope="col">Divisi</th>
                              </tr>
                          </thead>
                          <tbody>
                          @php
                              $no = 1;
                          @endphp
                          @foreach($data as $row)
                              <tr>
                                  <th scope="row">{{ $no++ }}</th>
                                  <td><a href="#" data-toggle="modal" data-target="#detailModal{{ $row->id_mahasiswa }}">
                                    {{ $row->nama_mahasiswa }}
                                  </a>
                                  <td>{{ $row->asal_instansi }}</td>
                                  <td>{{ $row->divisi_pkl }}</td>
                              </tr> 

                              
                              
                               <!-- Modal -->
                              <div class="modal fade" id="detailModal{{ $row->id_mahasiswa }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $row->id_mahasiswa }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $row->id_mahasiswa }}">Detail Mahasiswa: {{ $row->nama_mahasiswa }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><strong>Nama Mahasiswa:</strong> {{ $row->nama_mahasiswa }}</p>
                                                    <p><strong>Asal Instansi:</strong> {{ $row->asal_instansi }}</p>
                                                    <p><strong>Divisi PKL:</strong> {{ $row->divisi_pkl }}</p>
                                                    <p><strong>No. Telepon:</strong> {{ $row->no_telp }}</p>
                                                    <p><strong>Tanggal Mulai PKL:</strong> {{ $row->tanggal_mulai }}</p>
                                                    <p><strong>Tanggal Berakhir PKL:</strong> {{ $row->tanggal_berakhir }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <a href="/berinilai/{{ $row->id_mahasiswa }}" type="button" class="btn btn-success btn-sm">Nilai</a>
                                          <a href="/hasilpenilaian/ {{ $row->id_mahasiswa }}" type="button" class="btn btn-secondary btn-sm">Lihat Nilai</a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                          @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
@endpush
