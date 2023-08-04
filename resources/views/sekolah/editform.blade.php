@extends('layout.sekolah')

@section('title', 'Sekolah | Edit Form Penilaian')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Form Penilaian') }}</div>

                <div class="card-body">
                    <form action="{{ route('sekolah.updateform', ['id' => $formPenilaian->id_form]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Tampilkan form untuk mengedit kriteria yang sudah ada -->
                        @foreach (json_decode($formPenilaian->data_form, true) as $index => $kriteria)
                        <div class="form-group">
                            <label for="kriteria{{ $index + 1 }}">Kriteria {{ $index + 1 }}:</label>
                            <input type="text" class="form-control" id="kriteria{{ $index + 1 }}" name="kriteria{{ $index + 1 }}" value="{{ $kriteria['kriteria'] }}" required>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria{{ $index + 1 }}" value="angka" {{ $kriteria['tipe_kriteria'] === 'angka' ? 'checked' : '' }} required>
                                <label class="form-check-label">Angka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria{{ $index + 1 }}" value="huruf" {{ $kriteria['tipe_kriteria'] === 'huruf' ? 'checked' : '' }}>
                                <label class="form-check-label">Huruf</label>
                            </div>
                            <!-- Tampilkan form min dan max hanya jika kriteria berupa angka -->
                            @if ($kriteria['tipe_kriteria'] === 'angka')
                            <div class="form-group">
                                <label for="min_kriteria{{ $index + 1 }}">Min:</label>
                                <input type="number" class="form-control" id="min_kriteria{{ $index + 1 }}" name="min_kriteria{{ $index + 1 }}" value="{{ $kriteria['min'] }}">
                            </div>
                            <div class="form-group">
                                <label for="max_kriteria{{ $index + 1 }}">Max:</label>
                                <input type="number" class="form-control" id="max_kriteria{{ $index + 1 }}" name="max_kriteria{{ $index + 1 }}" value="{{ $kriteria['max'] }}">
                            </div>
                            @endif

                            <!-- Tombol hapus untuk menghapus kriteria -->
                            @if ($index > 2) <!-- Hanya tampilkan tombol hapus untuk kriteria ke-3 dan seterusnya -->
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapusKriteria({{ $index + 1 }})">Hapus</button>
                            @endif
                        </div>
                        @endforeach

                        <!-- Tombol untuk menambah kriteria -->
                        <button type="button" class="btn btn-primary" id="tambahKriteria">Tambah +</button>

                        <!-- Tombol untuk melakukan update -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk menambah kriteria dengan tombol "+"
    var counter = {{ count(json_decode($formPenilaian->data_form, true)) }} + 1;
    $('#tambahKriteria').click(function() {
        var html = `
            <div class="form-group">
                <label for="kriteria${counter}">Kriteria ${counter}:</label>
                <input type="text" class="form-control" id="kriteria${counter}" name="kriteria${counter}" required>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipe_kriteria${counter}" value="angka" required>
                    <label class="form-check-label">Angka</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipe_kriteria${counter}" value="huruf">
                    <label class="form-check-label">Huruf</label>
                </div>
                <!-- Tampilkan form min dan max hanya jika kriteria berupa angka -->
                <div class="form-group">
                    <label for="min_kriteria${counter}">Min:</label>
                    <input type="number" class="form-control" id="min_kriteria${counter}" name="min_kriteria${counter}">
                </div>
                <div class="form-group">
                    <label for="max_kriteria${counter}">Max:</label>
                    <input type="number" class="form-control" id="max_kriteria${counter}" name="max_kriteria${counter}">
                </div>
                <!-- Tombol hapus untuk menghapus kriteria -->
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusKriteria(${counter})">Hapus</button>
            </div>
        `;
        $('#tambahKriteria').before(html);
        counter++;
    });

    // Fungsi untuk menghapus kriteria
    function hapusKriteria(index) {
        if (confirm("Apakah Anda yakin ingin menghapus kriteria " + index + "?")) {
            var kriteriaDiv = $('#kriteria' + index).parent();
            kriteriaDiv.remove();
        }
    }
</script>
@endpush
