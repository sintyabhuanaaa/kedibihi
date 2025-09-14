
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/x-icon" href="/favicon.ico">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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

    .product-detail {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: flex-start;
      gap: 40px;
      padding: 40px 20px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .product-detail img {
      width: 280px;
      height: auto;
      border-radius: 10px;
    }

    .product-info {
      flex: 1;
      max-width: 500px;
    }

    .product-info h2 {
      font-size: 24px;
      margin-bottom: 15px;
    }

    .product-info table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .product-info table td {
      padding: 8px;
      border-bottom: 1px solid #ccc;
      vertical-align: top;
    }

    .product-info td:first-child {
      font-weight: 500;
      width: 150px;
    }

    .product-description {
      border-top: 1px solid #ccc;
      padding-top: 15px;
      font-size: 14px;
      line-height: 1.6;
    }

        /* ======== ULASAN ======== */
    .ulasan-produk {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      border-top: 2px solid #ddd;
    }

    .ulasan-item {
      background: #f9f9f9;
      border: 1px solid #ddd;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .ulasan-item strong {
      color: #333;
    }

    .form-ulasan {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .form-ulasan input,
    .form-ulasan select,
    .form-ulasan textarea {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-family: 'Poppins', sans-serif;
    }

    .form-ulasan button {
      padding: 10px;
      background: #ff0050;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.2s;
    }

    .form-ulasan button:hover {
      background: #e60046;
    }


    @media screen and (max-width: 768px) {
      .product-detail {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .product-info {
        max-width: 100%;
      }

      .product-info table td:first-child {
        width: 100px;
      }

      .product-info h2 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  @include('user.header')

  <!-- Detail Produk -->
  <div class="product-detail">
    <img src="{{ asset('img/asbak.png') }}" alt="Asbak">
    <div class="product-info">
      <h2>ASBAK</h2>
      <table>
        <tr>
          <td>Harga Produk</td>
          <td><strong>Rp50.000,00</strong></td>
        </tr>
        <tr>
          <td>Stock</td>
          <td><strong>Tersedia</strong></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td><strong>Bali</strong></td>
        </tr>
        <tr>
          <td>Kota/Kabupaten</td>
          <td><strong>Bangli</strong></td>
        </tr>
        <tr>
          <td>Link Pembelian</td>
          <td>
            <a href="https://vt.tiktok.com/XXXXXXXXX/" target="_blank" style="color: #ff0050; font-weight: bold; text-decoration: none;">
              Beli di TikTok Shop
            </a>
          </td>
        </tr>
      </table>
      <div class="product-description">
        Produk asbak berbahan baku dari bambu yang dibuat dengan kualitas terbaik.
      </div>
    </div>
  </div>

  <!-- Komentar dan Rating -->
  <section class="ulasan-produk">
    <h3>Ulasan Produk</h3>
    <div class="daftar-ulasan" id="daftarUlasan">
      <div class="ulasan-item">
        <p><strong>Dewi</strong> ⭐⭐⭐⭐⭐</p>
        <p>Produk sangat bagus, rapi dan cepat sampai. Suka sekali!</p>
      </div>
    </div>
    <form class="form-ulasan">
      <label for="nama">Nama Anda</label>
      <input type="text" id="nama" placeholder="Nama Anda" required>
      <label for="rating">Rating</label>
      <select id="rating" required>
        <option value="">Pilih rating</option>
        <option value="⭐">⭐</option>
        <option value="⭐⭐">⭐⭐</option>
        <option value="⭐⭐⭐">⭐⭐⭐</option>
        <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
        <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
      </select>
      <label for="komentar">Komentar</label>
      <textarea id="komentar" rows="4" placeholder="Tulis komentar Anda..." required></textarea>
      <button type="submit">Kirim Ulasan</button>
    </form>
  </section>

  <!-- Footer -->
  @include('user.footer')

  <script>
    const form = document.querySelector(".form-ulasan");
    const daftarUlasan = document.getElementById("daftarUlasan");

    form.addEventListener("submit", function(e) {
      e.preventDefault();
      const nama = document.getElementById("nama").value;
      const rating = document.getElementById("rating").value;
      const komentar = document.getElementById("komentar").value;
      if (nama && rating && komentar) {
        const div = document.createElement("div");
        div.classList.add("ulasan-item");
        div.innerHTML = `
          <p><strong>${nama}</strong> ${rating}</p>
          <p>${komentar}</p>
        `;
        daftarUlasan.prepend(div);
        form.reset();
      }
    });
  </script>
</body>
</html>