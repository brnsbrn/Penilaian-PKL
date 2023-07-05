<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dummy Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1 class='text-center mb-4'>Tambah Data Siswa PKL</h1>
    <div class='container'>
        <div class='row'>
          <div class='card'>
            <div class='card-body'>
              <form action='/insertmahasiswa' method='POST'>
                @csrf
                  <div class="form-group">
                      <label for="nama_mahasiswa">Nama Mahasiswa:</label>
                      <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required>
                  </div>

                  <div class="form-group">
                      <label for="asal_instansi">Asal Instansi:</label>
                      <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" required>
                  </div>

                  <div class="form-group">
                      <label for="divisi_pkl">Divisi PKL:</label>
                      <input type="text" class="form-control" id="divisi_pkl" name="divisi_pkl" required>
                  </div>

                  <div class="form-group">
                      <label for="no_telp">Nomor Telepon:</label>
                      <input type="tel" class="form-control" id="no_telp" name="no_telp" pattern="[0-9]+" required>
                      <small class="form-text text-muted">Masukkan hanya angka (0-9).</small>
                  </div>

                  <div class="form-group">
                      <label for="tanggal_mulai">Tanggal Mulai PKL:</label>
                      <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                  </div>

                  <div class="form-group">
                      <label for="tanggal_berakhir">Tanggal Berakhir PKL:</label>
                      <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" required>
                  </div>

                  <button type="submit" class="btn btn-primary mt-4">Submit</button>
              </form>
            </div>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>