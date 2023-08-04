@extends('layout.penilai')

@section('title', 'Penilai | Form Penilaian')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('penilai.simpannilai', ['id' => $siswa->id_siswa]) }}" method="POST">
                                @csrf
                                @foreach($kriteriaPenilaian as $kriteria)
                                    <div class="form-group">
                                        <label for="{{ $kriteria->kriteria }}">{{ $kriteria->kriteria }}</label>
                                        @if($kriteria->tipe_kriteria == 'angka')
                                            <input type="number" class="form-control" id="{{ str_replace(' ', '', $kriteria->kriteria) }}" name="{{ str_replace(' ', '', $kriteria->kriteria) }}" min="{{ $kriteria->min }}" max="{{ $kriteria->max }}" required>
                                        @elseif($kriteria->tipe_kriteria == 'huruf')
                                            <input type="text" class="form-control" id="{{ str_replace(' ', '', $kriteria->kriteria) }}" name="{{ str_replace(' ', '', $kriteria->kriteria) }}" required>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control" id="komentar" name="komentar" rows="4"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</div>
@endsection
