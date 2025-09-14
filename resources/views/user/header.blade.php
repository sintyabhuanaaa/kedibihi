<!-- Header -->
<header>
    <div class="navbar">
        <img src="{{ asset('img/logo.png') }}" alt="Kedibihi Logo" class="logo" />
        <input type="text" placeholder="Cari di Kedibihi" class="search-bar" />
        <nav>
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ url('/semua-produk') }}">Semua Produk</a>
            <a href="{{ url('/kontak-penjual') }}">Kontak Penjual</a>
           <a href="{{ url('/#about-us') }}">About Us</a>

        </nav>
    </div>
</header>
