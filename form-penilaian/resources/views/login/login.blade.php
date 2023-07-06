<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .login-form {
          max-width: 400px;
          margin: 0 auto;
          margin-top: 100px;
          padding: 15px;
          background-color: #f7f7f7;
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
        }
        .error-message {
          color: red;
          margin-top: 10px;
        }
      </style>    
</head>
<body>
    <div class="container">
        <div class="login-form">
          <h2>Halaman Login</h2>
          @if ($errors->any())
            <div class="error-message">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form method="POST" action="">
            @csrf
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Masukkan email" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="error-message">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password">
              @error('password')
                <div class="error-message">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
      
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
