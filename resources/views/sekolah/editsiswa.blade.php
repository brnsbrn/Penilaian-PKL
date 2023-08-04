@extends('layout.sekolah')

@section('title', 'Sekolah | Edit Form Penilaian')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Data Form Penilaian') }}</div>

                <div class="card-body">
                    <form action="{{ route('sekolah.updateform', $formPenilaian->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Kriteria</td>
                                    <td>Tipe Kriteria</td>
                                    <td>Min</td>
                                    <td>Max</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataForm as $index => $kriteria)
                                <tr>
                                    <td>
                                        <input type="text" name="kriteria{{ $index + 1 }}" value="{{ $kriteria['kriteria'] }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="tipe_kriteria{{ $index + 1 }}" value="{{ $kriteria['tipe_kriteria'] }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="min_kriteria{{ $index + 1 }}" value="{{ $kriteria['min'] }}">
                                    </td>
                                    <td>
                                        <input type="text" name="max_kriteria{{ $index + 1 }}" value="{{ $kriteria['max'] }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
