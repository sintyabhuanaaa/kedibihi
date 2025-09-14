<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manajemen Produk | Admin Kedibihi</title>
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Tambahan styling khusus untuk halaman produk */
            .app-header {
            display: flex;
            justify-content: center; /* Judul ke tengah */
            align-items: center;
            padding: 10px 20px;
            background: #8B6A42;
            position: relative;
            }
            .sidebar-toggle {
            position: absolute;
            right: 20px;
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
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
            <li class="active"><a href="{{ route('products.index') }}">Edit Produk</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content" id="content">
        <header class="app-header">
        <h2>Edit Produk</h2>
    </header>
        <a href="{{ route('products.index') }}">Kembali</a>
            <!-- Form Edit Produk -->
            <div class="card">
                <h3>Edit Produk Baru</h3>
                @if ($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="form-produk" action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="nama">Nama Produk</label>
                    <input type="text" id="nama" name="name" value="{{ old('name', $product->name) }}" required>

                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="price" value="{{ old('price', $product->price) }}"  required>

                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stock" value="{{ old('stock', $product->stock) }}" required>

                    <label for="description">Deskripsi Produk</label>
                    <textarea id="description" name="description" placeholder="Tulis deskripsi produk..." required>{{ old('description', $product->description) }}</textarea>

                    <label for="tiktok_link">Link TikTok Shop</label>
                    <input type="url" id="tiktok_link" name="tiktok_link" value="{{ old('tiktok_link', $product->tiktok_link) }}" placeholder="https://vt.tiktok.com/..." required>

                    <label for="image">Gambar Produk</label>
                    <input type="file" id="image" name="image" accept="image/*">

                    @if ($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" id="image-preview" class="preview" alt="Preview">
                    @else
                        <img src="{{ asset('img/no-image.png') }}" id="image-preview" class="preview" alt="Preview">
                    @endif

                    <button type="submit">Simpan Produk</button>
                </form>
            </div>
        </main>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
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
            });
        </script>
    </body>
</html>
