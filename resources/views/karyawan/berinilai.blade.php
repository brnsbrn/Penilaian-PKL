@extends('layout.karyawan')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Pemberian Nilai Mahasiswa</h1>
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
                            <form action="/simpannilai/{{ $id }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="disiplin">Kedisiplinan :</label>
                                    <input type="number" class="form-control" id="disiplin" name="disiplin" placeholder="Masukkan Nilai Kedisiplinan (1-10)" min="1" max="10">
                                </div>
                                <div class="form-group">
                                    <label for="kinerja">Kinerja Kerja :</label>
                                    <input type="number" class="form-control" id="kinerja" name="kinerja" placeholder="Masukkan Nilai Kinerja Kerja (1-10)" min="1" max="10">
                                </div>
                                <div class="form-group">
                                    <label for="rapi">Kerapian :</label>
                                    <input type="number" class="form-control" id="rapi" name="rapi" placeholder="Masukkan Nilai Kerapian (1-10)" min="1" max="10">
                                </div>
                                <div class="form-group">
                                    <label for="sopansantun">Kesopanan :</label>
                                    <input type="number" class="form-control" id="sopansantun" name="sopansantun" placeholder="Masukkan Nilai Kesopanan (1-10)" min="1" max="10">
                                </div>
                                <div class="form-group">
                                    <label for="komentar">Berikan Komentar:</label>
                                    <textarea class="form-control" id="komentar" name="komentar" rows="3"></textarea>
                                </div>
                                @if($errors->has('komentar'))
                                <div class='alert alert-danger'>
                                    {{ $errors->first('komentar') }}
                                </div>
                                    
                                @endif
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    
@endsection
