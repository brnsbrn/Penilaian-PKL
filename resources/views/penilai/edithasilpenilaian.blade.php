@extends('layout.penilai')

@section('title', 'Penilai | Edit Hasil Penilaian')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('penilai.updatehasilpenilaian', ['idHasilPenilaian' => $hasilPenilaian->id_hasil_penilaian]) }}" method="POST">
                                @csrf
                                @foreach($kriteriaPenilaian as $kriteria)
                                    <div class="form-group">
                                        <label for="{{ $kriteria->kriteria }}">{{ $kriteria->kriteria }}</label>
                                        @if($kriteria->tipe_kriteria == 'angka')
                                            <input type="number" class="form-control" id="{{ str_replace(' ', '', $kriteria->kriteria) }}" name="{{ str_replace(' ', '', $kriteria->kriteria) }}" min="{{ $kriteria->min }}" max="{{ $kriteria->max }}" value="{{ $dataPenilaian[$kriteria->kriteria] }}" required>
                                        @elseif($kriteria->tipe_kriteria == 'huruf')
                                            <input type="text" class="form-control" id="{{ str_replace(' ', '', $kriteria->kriteria) }}" name="{{ str_replace(' ', '', $kriteria->kriteria) }}" value="{{ $dataPenilaian[$kriteria->kriteria] }}" required>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control" id="komentar" name="komentar" rows="4">{{ $hasilPenilaian->komentar }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
