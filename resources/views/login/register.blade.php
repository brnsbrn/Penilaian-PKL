<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="{{ asset('logo_favi.ico') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Karyawan Penilai PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-image: url('img/bg_logo.jpg'); /* Ganti dengan path ke gambar background */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 700px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .center {
            display: flex;
            justify-content: center;
        }

        .h2 {
            text-align: center
        }

        .btn-primary {
            text-align: center;
        }

        .form-group {
            margin-bottom: 10px
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="container">
                <h2 class="h2">Registrasi</h2>
                <form action="/regis" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Anda">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email Anda">
                </div>
                <div class="form-group">
                    <label for="no_telp">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Telp Anda">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru">
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role">
                        <option value="karyawan">Karyawan</option>
                        <option value="mahasiswa">Mahasiswa</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>    
        </div>
    </div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
