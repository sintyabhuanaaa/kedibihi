<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kategori Produk | Kedibihi</title>
  <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: #fff;
    }

    .breadcrumb {
      font-size: 14px;
      color: #888;
      padding: 20px 40px 0;
    }

    .kategori-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      padding: 30px 40px;
      justify-items: center;
    }

    .kategori-card {
      border: 2px solid #8B6A42;
      border-radius: 10px;
      overflow: hidden;
      text-align: center;
      padding: 10px;
      transition: 0.3s;
      background-color: white;
      width: 100%;
      max-width: 200px;
    }

    .kategori-card img {
      width: 100%;
      height: 140px;
      object-fit: cover;
      border-radius: 5px;
    }

    .kategori-card:hover {
      background-color: #f3ece5;
      transform: scale(1.02);
    }

    .kategori-card h4 {
      margin: 10px 0 5px;
      font-size: 14px;
      font-weight: 600;
    }

    @media screen and (max-width: 768px) {
      .kategori-container {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media screen and (max-width: 480px) {
      .kategori-container {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
@include('user.header')

  <!-- Kategori Produk -->
  <div class="kategori-container">
    <div class="kategori-card">
      <a href="{{ url('produk/keben') }}">
        <img src="{{ asset('img/keben.png') }}" alt="Sok Asi / Keben">
        <h4>SOK ASI/KEBEN</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/wadahbunga') }}">
        <img src="{{ asset('img/wadah-bunga.png') }}" alt="Wadah Bunga">
        <h4>WADAH BUNGA</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/coverlampu') }}">
        <img src="{{ asset('img/cover-lampu.png') }}" alt="Cover Lampu">
        <h4>COVER LAMPU</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/asbak') }}">
        <img src="{{ asset('img/asbak.png') }}" alt="Asbak">
        <h4>ASBAK</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/astrak') }}">
        <img src="{{ asset('img/astrak.png') }}" alt="Astrak">
        <h4>ASTRAK</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/hiasan3d') }}">
        <img src="{{ asset('img/hiasan3d.png') }}" alt="Hiasan Dinding 3D">
        <h4>HIASAN DINDING 3D</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/kukusan') }}">
        <img src="{{ asset('img/kukusan.png') }}" alt="Kukusan Dimsum">
        <h4>KUKUSAN DIMSUM</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/tas') }}">
        <img src="{{ asset('img/tas.png') }}" alt="Tas">
        <h4>TAS</h4>
      </a>
    </div>
    <div class="kategori-card">
      <a href="{{ url('produk/keranjang') }}">
        <img src="{{ asset('img/keranjang.png') }}" alt="Keranjang">
        <h4>KERANJANG</h4>
      </a>
    </div>
  </div>
<!-- Footer -->
@include('user.footer')

<!-- Script Search -->
<script>
  const searchBar = document.querySelector(".search-bar");
  searchBar.addEventListener("keyup", function () {
    let keyword = searchBar.value.toLowerCase();
    let products = document.querySelectorAll(".card");
    products.forEach((card) => {
      let title = card.querySelector("h4").textContent.toLowerCase();
      card.style.display = title.includes(keyword) ? "block" : "none";
    });
  });
</script>
</body>
</html>