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
                            <form action="/simpanubahnilai/{{ $penilaian->id_penilaian }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                <label for="kedisiplinan" class="form-label">Kedisiplinan</label>
                                <input type="number" class="form-control" id="kedisiplinan" name="kedisiplinan" value="{{ $penilaian->kedisiplinan }}" required>
                                </div>
                                <div class="mb-3">
                                <label for="kinerja" class="form-label">Kinerja Kerja</label>
                                <input type="number" class="form-control" id="kinerja" name="kinerja" value="{{ $penilaian->kinerja_kerja }}" required>
                                </div>
                                <div class="mb-3">
                                <label for="rapi" class="form-label">Kerapian</label>
                                <input type="number" class="form-control" id="rapi" name="rapi" value="{{ $penilaian->kerapian }}" required>
                                </div>
                                <div class="mb-3">
                                <label for="sopansantun" class="form-label">Kesopanan</label>
                                <input type="number" class="form-control" id="sopansantun" name="sopansantun" value="{{ $penilaian->kesopanan }}" required>
                                </div>
                                <div class="mb-3">
                                <label for="komentar" class="form-label">Komentar</label>
                                <textarea class="form-control" id="komentar" name="komentar">{{ $penilaian->komentar }}</textarea>
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

