<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="{{ asset('logo_favi.ico') }}" type="image/x-icon">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
          background-image: url({{ asset('img/bg_logo.jpg') }});
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
        }
        .login-form-container {
          width: 500px;
          margin: 100px; /* Perubahan pada margin-top */
          padding: 30px; /* Perubahan pada padding */
          background-color: white;
          border: 1px solid #ccc;
          border-radius: 3px;
        }
        .login-form h2 {
          text-align: center;
          margin-bottom: 30px;
        }
        .form-group {
          margin-bottom: 20px;
        }
        .form-group label {
          font-weight: bold;
        }
        .form-control {
          height: 40px;
        }
        .btn-primary {
          width: 100%;
          background-color: #5c7ebd;
          border-color: #5c7ebd;
        }
        .btn-primary:hover {
          background-color: #3A7EA9;
          border-color: #3A7EA9;
        }
        .error-message {
          color: red;
          margin-top: 10px;
        }
        .logo-container {
          text-align: center;
          margin-bottom: 20px;
        }
        .logo-container img {
          max-width: 200px;
        }
    </style>    
</head>
<body>
    <div class="login-form-container">
        <div class="logo-container">
            <img src="{{ asset('img/Logo_Bankaltimtara.png') }}" alt="Logo Perusahaan">
        </div>
        {{-- <h3 class="text-center">Halaman Login</h2> --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="username" class="form-control" id="username" placeholder="Masukkan username" name="username" value="{{ old('username') }}">                    
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password">
            </div>
            @error('gagal')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
