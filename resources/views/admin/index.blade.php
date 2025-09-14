<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin | Kedibihi</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* Tambahan agar judul di tengah */
    .app-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      background: #8B6A42;
      color: #fff;
      position: relative;
    }
    .app-header h2 {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      margin: 0;
    }
    .header-right {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
      z-index: 2; /* supaya dropdown tidak ketiban */
    }
    .profile-icon {
      width: 32px;
      height: 32px;
      cursor: pointer;
      border-radius: 50%;
    }
    .dropdown {
      display: none;
      flex-direction: column;
      position: absolute;
      top: 40px;
      right: 0;
      background: #fff;
      border: 1px solid #ccc;
      padding: 10px;
      z-index: 100;
    }
    .dropdown-item, .submenu-items button {
      background: none;
      border: none;
      padding: 5px 0;
      text-align: left;
      cursor: pointer;
    }
    .submenu-items {
      display: none;
      flex-direction: column;
      margin-left: 10px;
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
      <li class="active"><a href="{{ route('admin.index') }}">Dashboard</a></li>
      <li><a href="{{ route('products.index') }}">Manajemen Produk</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <header class="app-header">
      <h2>Dashboard Admin</h2>
      <div class="header-right">
        <img src="{{ asset('img/profil.png') }}" alt="Profil Admin" class="profile-icon" id="profile-icon">
        <div class="dropdown" id="profile-dropdown">
          <button class="dropdown-item" onclick="toggleSubmenu()">Pengaturan Akun ▸</button>
          <div class="submenu-items" id="submenu-items">
            <button onclick="gantiAkun()">Ganti Akun</button>
            <button onclick="bukaModalPassword()">Ganti Kata Sandi</button>
            <button onclick="hapusAkun()">Hapus Akun</button>
          </div>
          <button class="dropdown-item" onclick="logoutAdmin()">Logout</button>
        </div>
      </div>
    </header>

    <!-- KPI Cards -->
    <section class="grid-kpi">
      <div class="kpi-card">
        <div class="kpi-title">Total Produk Aktif</div>
        <div class="kpi-value" id="kpi-total-produk">0</div>
      </div>
      <div class="kpi-card">
        <div class="kpi-title">Produk Stok Habis</div>
        <div class="kpi-value" id="kpi-stok-habis">0</div>
      </div>
      <div class="kpi-card">
        <div class="kpi-title">Rata-rata Rating (bulan ini)</div>
        <div class="kpi-value" id="kpi-rating-bulan-ini">0.0</div>
      </div>
    </section>

    <!-- Grafik Rating Per Bulan -->
    <div class="card">
      <div class="card-title">Rata-rata Rating Per Bulan</div>
      <div style="height:400px;">
        <canvas id="ratingChart"></canvas>
      </div>
    </div>

    <!-- Stok Rendah -->
    <div class="card">
      <div class="card-title">Stok Terendah (Top 3)</div>
      <ul class="low-stock-list" id="low-stock-list"></ul>
    </div>
  </main>

  <!-- Modal Ganti Password -->
  <div id="password-overlay" 
       style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
              background:rgba(0,0,0,0.5);justify-content:center;align-items:center;z-index:1000;">
    <div style="background:#fff;padding:20px;border-radius:10px;width:320px;">
      <h3>Ganti Kata Sandi</h3>
      <form id="form-password">
        <input type="password" id="password-lama" placeholder="Password Lama" required style="width:100%;margin-bottom:10px;padding:8px;">
        <input type="password" id="password-baru" placeholder="Password Baru" required style="width:100%;margin-bottom:10px;padding:8px;">
        <input type="password" id="password-konfirmasi" placeholder="Konfirmasi Password Baru" required style="width:100%;margin-bottom:10px;padding:8px;">
        <button type="submit" style="width:100%;margin-bottom:8px;">Simpan</button>
        <button type="button" onclick="tutupModalPassword()" style="width:100%;">Batal</button>
      </form>
    </div>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
  <script>
const ctx = document.getElementById('ratingChart').getContext('2d');
const ratingChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Rata-rata Rating',
            data: [4.2, 4.0, 4.5, 4.1, 4.3, 4.6, 4.4, 4.7, 4.5, 4.6, 4.8, 4.9], // contoh dummy data
            borderColor: '#8B6A42',
            backgroundColor: 'rgba(139,106,66,0.2)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
  <script>
function toggleSubmenu() {
  const submenu = document.getElementById("submenu-items");
  submenu.style.display = (submenu.style.display === "flex") ? "none" : "flex";
}

// fungsi dummy biar tidak error
function gantiAkun() {
  alert("Fitur ganti akun belum tersedia.");
}

function hapusAkun() {
  if(confirm("Apakah Anda yakin ingin menghapus akun ini?")) {
    alert("Akun berhasil dihapus (dummy).");
  }
}
  </script>
</body>
</html>
