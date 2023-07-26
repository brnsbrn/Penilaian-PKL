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

                        <!-- Tampilkan 3 kriteria awal -->
                        <div class="form-group">
                            <label for="kriteria1">Kriteria 1:</label>
                            <input type="text" class="form-control" id="kriteria1" name="kriteria1" required>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria1" value="angka" required>
                                <label class="form-check-label">Angka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria1" value="huruf">
                                <label class="form-check-label">Huruf</label>
                            </div>
                            <!-- Tampilkan form min dan max hanya jika kriteria berupa angka -->
                            <div class="form-group">
                                <label for="min_kriteria1">Min:</label>
                                <input type="number" class="form-control" id="min_kriteria1" name="min_kriteria1">
                            </div>
                            <div class="form-group">
                                <label for="max_kriteria1">Max:</label>
                                <input type="number" class="form-control" id="max_kriteria1" name="max_kriteria1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kriteria2">Kriteria 2:</label>
                            <input type="text" class="form-control" id="kriteria2" name="kriteria2" required>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria2" value="angka" required>
                                <label class="form-check-label">Angka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria2" value="huruf">
                                <label class="form-check-label">Huruf</label>
                            </div>
                            <!-- Tampilkan form min dan max hanya jika kriteria berupa angka -->
                            <div class="form-group">
                                <label for="min_kriteria2">Min:</label>
                                <input type="number" class="form-control" id="min_kriteria2" name="min_kriteria2">
                            </div>
                            <div class="form-group">
                                <label for="max_kriteria2">Max:</label>
                                <input type="number" class="form-control" id="max_kriteria2" name="max_kriteria2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kriteria3">Kriteria 3:</label>
                            <input type="text" class="form-control" id="kriteria3" name="kriteria3" required>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria3" value="angka" required>
                                <label class="form-check-label">Angka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe_kriteria3" value="huruf">
                                <label class="form-check-label">Huruf</label>
                            </div>
                            <!-- Tampilkan form min dan max hanya jika kriteria berupa angka -->
                            <div class="form-group">
                                <label for="min_kriteria3">Min:</label>
                                <input type="number" class="form-control" id="min_kriteria3" name="min_kriteria3">
                            </div>
                            <div class="form-group">
                                <label for="max_kriteria3">Max:</label>
                                <input type="number" class="form-control" id="max_kriteria3" name="max_kriteria3">
                            </div>
                        </div>

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
    var counter = 4; // Kriteria selanjutnya akan dimulai dari angka 4
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
            </div>
        `;
        $('#tambahKriteria').before(html);
        counter++;
    });
</script>
@endpush
