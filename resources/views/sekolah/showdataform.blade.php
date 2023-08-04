@extends('layout.sekolah')

@section('title', 'Sekolah | Data Form Penilaian')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Form Penilaian Sebelumnya') }}</div>

                <div class="card-body">
                    @if($formPenilaian)
                    
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
                            @foreach (json_decode($formPenilaian->data_form, true) as $kriteria)
                            <tr>
                                <td>{{ $kriteria['kriteria'] }}</td>
                                <td>{{ $kriteria['tipe_kriteria'] }}</td>
                                <td>{{ $kriteria['min'] }}</td>
                                <td>{{ $kriteria['max'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Tambahkan tombol Edit Form Penilaian yang akan menuju halaman edit -->
                    <a href="{{ route('sekolah.editform', ['id' => $formPenilaian->id_form]) }}" class="btn btn-primary">Edit Form Penilaian</a>
                    @if($message = Session::get('success'))
                    <div class="alert alert-success mt-3 mb-2" role="alert">
                        {{ $message }}
                    </div>
                    @endif

                    
                    @else
                        <p>Belum ada data form penilaian yang diinputkan sebelumnya.</p>
                        <a href="/sekolah/form">Tambahkan data baru</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
