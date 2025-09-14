
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kedibihi</title>
        <link rel="stylesheet" href="{{ asset('css/user.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <style>
            html {
            scroll-behavior: smooth;
            }
        </style>
    </head>

    <body>
        <!-- Navbar -->
        @include('user.header')

        <!-- Hero Section -->
        <section id="beranda" class="hero">
            <div class="hero-text">
            <h1>Kerajinan <br>Digital <br>Kayubihi Bhakti</h1>
            </div>
        </section>

        <!-- Carousel Promo -->
        <section class="carousel">
            <div class="carousel-banner">
            <!-- Isi banner di sini -->
            </div>
        </section>

        <!-- Produk Terpopuler -->

        <section id="kategori-produk" class="produk">
            <h2>Produk Terpopuler</h2>
            <div class="produk-container">
                <div class="produk-grid">
                    @forelse ($products as $product)
                        <div class="card" style="cursor:pointer;" onclick="window.location.href='{{ route('user.detail_product', $product->slug) }}'">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Tas Anyaman">
                            <h4>{{ $product->name }}</h4>
                            <p class="rating">{{ str_repeat('⭐', round($product->ratings_avg_rating)) }} ({{ round($product->ratings_avg_rating) }})</p>
                            <p><i class="fa fa-map-marker"></i> Desa Kayubihi, Bangli</p>
                        </div>
                    @empty
                        <h3 style="text-align: center; grid-column:1/-1;">Tidak ada produk yang ditampilkan</h3>
                    @endforelse
                    
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer" id="kontak-penjual">
        <div class="about-footer" id="about-us">
            <h3>ABOUT US</h3>
            <div class="about-info">
            <div class="info-item">
                <i class="fa fa-phone"></i>
                <a href="https://wa.me/6283114413177">0831-1441-3177</a>
            </div>
            <div class="info-item">
                <i class="fa fa-envelope"></i>
                <a href="mailto:kedibihi@gmail.com">kedibihi@gmail.com</a>
            </div>
            <div class="info-item">
                <i class="fab fa-tiktok"></i>
                <a href="https://www.tiktok.com/@kedibihi" target="_blank">@kedibihi</a>
            </div>
            </div>
        </div>
        <div class="copyright">
            <p><i class="fa fa-copyright"></i> 2025 Copyright Kedibihi.com. All Rights Reserved</p>
        </div>
        </footer>
        </body>
        </html>
        
        <!-- Script Search -->
        <script>
        const searchBar = document.querySelector(".search-bar");

        searchBar.addEventListener("keyup", function () {
            let keyword = searchBar.value.toLowerCase();
            let products = document.querySelectorAll(".card");

            products.forEach((card) => {
            let title = card.querySelector("h4").textContent.toLowerCase();
            if (title.includes(keyword)) {
                card.style.display = "block"; // tampilkan
            } else {
                card.style.display = "none"; // sembunyikan
            }
            });
        });
        </script>
    </body>
</html>
