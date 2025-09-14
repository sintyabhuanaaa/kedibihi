<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin | Kedibihi</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background: linear-gradient(135deg, #d2b48c, #8b5e3c);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      background: #fffaf0;
      padding: 40px 35px;
      border-radius: 20px;
      box-shadow: 0 6px 25px rgba(0,0,0,0.25);
      width: 400px;
      text-align: center;
    }
    .login-box img {
      width: 100px;
      margin-bottom: 20px;
    }
    .login-box h2 {
      margin-bottom: 25px;
      color: #5c4033;
      font-size: 28px;
      font-weight: bold;
    }
    .login-box input {
      width: 100%;
      padding: 14px;
      margin-bottom: 18px;
      border: 2px solid #b5651d;
      border-radius: 10px;
      font-size: 16px;
    }
    .login-box button {
      width: 100%;
      padding: 14px;
      background-color: #8b5e3c;
      border: none;
      color: #fff;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      border-radius: 10px;
      transition: background 0.3s;
    }
    .login-box button:hover {
      background-color: #6f442a;
    }
    .error-msg {
      color: red;
      font-size: 15px;
      margin-bottom: 12px;
    }
    .login-box p {
      margin-top: 18px;
      font-size: 15px;
    }
    .login-box a {
      color: #8b5e3c;
      text-decoration: none;
      font-weight: bold;
    }
    .login-box a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <img src="{{ asset('img/logo.png') }}" alt="Logo Kedibihi">
    <h2>Login Admin</h2>

    @if(session('error'))
      <div class="error-msg">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <p>
      Belum punya akun? <a href="{{ route('admin.register') }}">Daftar</a>
    </p>
  </div>
</body>
</html>
