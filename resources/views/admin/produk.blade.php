<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk | Admin Kedibihi</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .app-header {
            display: flex;
            justify-content: center; /* Judul ke tengah */
            align-items: center;
            padding: 10px 20px;
            background: #8B6A42;
            position: relative;
        }
        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--text-light);
            display:;
    }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
        }
        form input, form textarea, form button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        form textarea {
            resize: vertical;
            min-height: 60px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        /* Tabel */
        table th {
            background: #A47C48; /* coklat lebih muda */
            color: #fff;
            font-weight: bold;
        }

        table td {
            background: #fff;
            color: #333;
        }

        .btn-edit{
            display: block;
            padding: 10px;
            background: #F8DE22;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 5px;
            transition: all .3s ease-out;
        }

        .btn-hapus{
            display: block;
            padding: 10px;
            background: #E52020;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px;
            transition: all .3s ease-out;
        }

        .btn-edit:hover{
            background: #f3d600;
        }
        .btn-hapus:hover{
            background: #cf0e0e;
        }

        #image-preview {
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
            max-width: 200px;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 4px;
            background: #fafafa;
        }

        .error-box {
            background-color: #ffe0e0;
            border: 1px solid #ff5c5c;
            color: #a10000;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-box li {
            font-size: 14px;
        }

        .success-box {
            background-color: #e0ffe0;
            border: 1px solid #5cff5c;
            color: #006600;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Kedibihi">
        </div>
        <ul>
            <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="active"><a href="{{ route('products.index') }}">Manajemen Produk</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="content">
    <header class="app-header">
    <h2>Manajemen Produk</h2>
    </header>

    <!-- Form Tambah Produk -->
    <div class="card">
        <h3>Tambah Produk Baru</h3>
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="form-produk" action="{{ route('products.index') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="nama">Nama Produk</label>
            <input type="text" id="nama" name="name" required>

            <label for="harga">Harga</label>
            <input type="number" id="harga" name="price"  required>

            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stock" required>

            <label for="description">Deskripsi Produk</label>
            <textarea id="description" name="description" placeholder="Tulis deskripsi produk..." required></textarea>

            <label for="tiktok_link">Link TikTok Shop</label>
            <input type="url" id="tiktok_link" name="tiktok_link" placeholder="https://vt.tiktok.com/..." required>

            <label for="image">Gambar Produk</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <img id="image-preview" class="preview" src="{{ asset('img/no-image.png') }}" alt="Preview Gambar">
            <button type="submit">Tambah Produk</button>
        </form>
    </div>

        <!-- Tabel Produk -->
    <div class="card">
        <h3>Daftar Produk</h3>
        <div class="table-responsive">
            <table id="tabel-produk">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th style="width: 200px;">Nama Produk</th>
                        <th style="width: 150px;">Harga</th>
                        <th style="width: 100px;">Stok</th>
                        <th style="width: 300px;">Deskripsi</th>
                        <th style="width: 200px;">Link TikTok Shop</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product )
                    <tr>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('img/no-image.png') }}" alt="No Image">
                            @endif
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td>
                            {{ $product->stock }}
                        </td>
                        <td>
                            {{ $product->description }}
                        </td>
                        <td>
                            {{ $product->tiktok_link }}
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7"><h3>Tidak ada data produk yang ditampilkan</h3></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </main>

    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @if(session('success'))
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            @endif

            document.getElementById("image").addEventListener("change", function(event) {
                const preview = document.getElementById("image-preview");
                const file = event.target.files[0];
    
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result; 
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "{{ asset('img/no-image.png') }}"; 
                }
            });

            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Produk akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });
        });
    </script>

    <script>
        // Toggle Sidebar
        document.getElementById("sidebarToggle").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("active");
            document.getElementById("content").classList.toggle("shift");
        });
    </script>
</body>
</html>
