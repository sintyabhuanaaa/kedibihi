<!DOCTYPE html>
<html lang="id">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Semua Produk | Kedibihi</title>
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

        /* .kategori-container {
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
        } */

        .produk-container{
            min-height: 100vh;
            padding: 60px 40px;
            background: #fff;
        }

        .produk-container h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 40px;
        }

        .produk-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, auto);
            gap: 20px;
            padding: 40px 20px;
            justify-content: center;
            align-items: stretch;
        }

        .card {
            border: 2px solid #5E9C32;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s;
            height: 100%;        
            max-width: 250px; 

        }

        .card:hover {
            transform: scale(1.03);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
        }

        .card h4 {
            margin: 10px 0 5px;
            font-size: 18px;
        }

        .card .harga {
            color: #4e9100;
            font-weight: bold;
            margin: 5px 0;
        }

        .card .rating {
            color: #f39c12;
            margin: 5px 0;
        }

        .card i {
            margin-right: 5px;
            color: #222;
        }

        @media screen and (max-width: 768px) {
        .produk-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        }

        @media screen and (max-width: 480px) {
        .produk-grid {
            grid-template-columns: 1fr;
        }
        }
    </style>
    </head>
    <body>

    <!-- Header -->
    @include('user.header')

    <!-- Kategori Produk -->
        <div class="produk-container">
            <h2>Semua Produk Kerajinan Kayubihi Bhakti</h2>
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