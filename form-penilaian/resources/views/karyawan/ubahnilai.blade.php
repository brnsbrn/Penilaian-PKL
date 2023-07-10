<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karyawan | Ubah Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1 class='text-center mb-4'>Ubah Nilai</h1>
    <div class="container">
      <form method="POST" action="/simpanubahnilai/{{ $penilaian->id_penilaian }}">
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
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
