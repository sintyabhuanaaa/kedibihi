<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kontak Bumdes Kayubihi | Kedibihi</title>
  <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <style>
    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;       
      display: flex;
      flex-direction: column;
      background: #fff;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      padding: 0 20px;
      flex: 1;
    }

    .contact-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #8B6A42;
      color: white;
      border-radius: 50px;
      padding: 15px 25px;
      margin-bottom: 20px;
      text-decoration: none;
      transition: 0.3s;
      font-weight: 500;
    }

    .contact-card:hover {
      background-color: #A1784C;
    }

    .contact-card span {
      display: flex;
      align-items: center;
    }

    .contact-card i {
      margin-right: 8px;
    }
  </style>
</head>
<body>

  <!-- Header -->
  @include('user.header')

  <!-- Kontak Bumdes -->
  <div class="container">
    <a href="https://wa.me/6282144796279" class="contact-card" target="_blank">
      <span>Bumdes Kayubihi</span>
      <span><i class="fab fa-whatsapp"></i> Hubungi Kami</span>
    </a>
  </div>

  <!-- Footer pakai include -->
  @include('user.footer')

  <!-- Script Search -->
  <script>
    const searchBar = document.querySelector(".search-bar");
    if (searchBar) {
      searchBar.addEventListener("keyup", function () {
        let keyword = searchBar.value.toLowerCase();
        let products = document.querySelectorAll(".card");
        products.forEach((card) => {
          let title = card.querySelector("h4").textContent.toLowerCase();
          card.style.display = title.includes(keyword) ? "block" : "none";
        });
      });
    }
  </script>
</body>
</html>
