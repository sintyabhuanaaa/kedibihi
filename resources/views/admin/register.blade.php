<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Admin</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #f5f0eb; /* background coklat muda */
      font-family: Arial, sans-serif;
      margin: 0;
    }
    .auth-container {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      width: 420px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
      text-align: center;
    }
    .auth-container img.logo {
      width: 110px;
      margin-bottom: 15px;
    }
    .auth-container h2 {
      margin-bottom: 25px;
      font-size: 28px;
      color: #5c4033; /* coklat tua */
    }
    .form-group {
      margin-bottom: 18px;
      text-align: left;
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-size: 15px;
      color: #4e342e; /* coklat gelap */
    }
    input {
      width: 100%;
      padding: 14px;
      font-size: 16px;
      border: 1px solid #a1887f; /* coklat soft */
      border-radius: 10px;
      box-sizing: border-box;
    }
    input:focus {
      outline: none;
      border-color: #8d6e63; /* coklat medium */
      box-shadow: 0 0 6px rgba(141,110,99,0.5);
    }
    .btn {
      width: 100%;
      padding: 14px;
      background: #8d6e63; /* coklat medium */
      color: #fff;
      font-size: 18px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .btn:hover {
      background: #5d4037; /* coklat tua */
    }
    .text-center {
      text-align: center;
      margin-top: 18px;
      font-size: 14px;
    }
    .text-center a {
      color: #8d6e63;
      text-decoration: none;
      font-weight: bold;
    }
    .text-center a:hover {
      text-decoration: underline;
      color: #5d4037;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <!-- Logo -->
    <img src="{{ asset('img/logo.png') }}" alt="Logo Admin" class="logo">
    <h2>Daftar Admin</h2>
    <form action="{{ route('admin.register.submit') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
      </div>
      <div class="form-group">
        <label for="email">Alamat Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email" required>
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
      </div>
      <div class="form-group">
        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
      </div>
      <button type="submit" class="btn">Daftar</button>
    </form>
    <div class="text-center">
      <p>Sudah punya akun? <a href="{{ route('admin.login') }}">Login di sini</a></p>
    </div>
  </div>
</body>
</html>
