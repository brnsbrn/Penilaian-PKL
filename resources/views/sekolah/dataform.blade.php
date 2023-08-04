@extends('layout.sekolah')

@section('title', 'Sekolah | Data Form')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Penilaian') }}</div>

                <div class="card-body">
                    <form action="{{ route('sekolah.simpanForm') }}" method="POST">
                        @csrf

                        <!-- Tampilkan 2 kriteria awal -->
                        @for($i = 1; $i <= 2; $i++)
                        <div class="form-group">
                            <label for="kriteria{{ $i }}">Nama Kriteria:</label>
                            <input type="text" class="form-control" name="kriteria{{ $i }}" required>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria{{ $i }}" value="angka" required>
                                <label class="form-check-label">Angka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria{{ $i }}" value="huruf">
                                <label class="form-check-label">Huruf</label>
                            </div>
                            <!-- Tampilkan form min dan max hanya jika kriteria berupa angka -->
                            <div class="form-group">
                                <label for="min_kriteria{{ $i }}">Min:</label>
                                <input type="number" class="form-control" name="min_kriteria{{ $i }}">
                            </div>
                            <div class="form-group">
                                <label for="max_kriteria{{ $i }}">Max:</label>
                                <input type="number" class="form-control" name="max_kriteria{{ $i }}">
                            </div>

                            <!-- Tombol untuk menghapus kriteria -->
                            @if($i > 0)
                            <button type="button" class="btn btn-danger hapusKriteria">Hapus</button>
                            @endif
                        </div>
                        @endfor

                        <!-- Kolom selanjutnya akan ditambahkan melalui JavaScript -->

                        <!-- Tombol untuk menambah kriteria -->
                        <button type="button" class="btn btn-primary" id="tambahKriteria">Tambah +</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    var counter = 3; // Kriteria selanjutnya akan dimulai dari angka 3
    $('#tambahKriteria').click(function() {
        var html = `
            <div class="form-group">
                <label for="kriteria${counter}">Nama Kriteria:</label>
                <input type="text" class="form-control" name="kriteria${counter}" required>
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
                    <input type="number" class="form-control" name="min_kriteria${counter}">
                </div>
                <div class="form-group">
                    <label for="max_kriteria${counter}">Max:</label>
                    <input type="number" class="form-control" name="max_kriteria${counter}">
                </div>

                <!-- Tombol untuk menghapus kriteria -->
                <button type="button" class="btn btn-danger hapusKriteria">Hapus</button>
            </div>
        `;
        $('#tambahKriteria').before(html);
        counter++;
    });

    // Script untuk menghapus kriteria dengan tombol "Hapus"
    $('form').on('click', '.hapusKriteria', function() {
        $(this).closest('.form-group').remove();
    });
</script>
@endpush
