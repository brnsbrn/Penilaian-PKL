<!DOCTYPE html>
<html>
<head>
    <title>Form Pemberian Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Form Pemberian Nilai Mahasiswa </h2>
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
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
