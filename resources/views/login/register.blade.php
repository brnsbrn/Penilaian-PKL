<!DOCTYPE html>
    <html>
    <head>
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
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
            <h2>Registrasi Karyawan</h2>
            <form action="/regis" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Anda">
            </div>
            <div class="form-group">
                <label for="nama">Email :</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email Anda">
            </div>
            <div class="form-group">
                <label for="nama">Password :</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>