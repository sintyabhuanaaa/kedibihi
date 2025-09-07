/* script.js
   Manajemen produk (localStorage), profil, modal, sidebar toggle, helper render dashboard
*/

/* ---------------------------
   Helper localStorage: adminUser
----------------------------*/
function getAdmin() {
  try {
    return JSON.parse(localStorage.getItem('adminUser')) || null;
  } catch (e) { return null; }
}
function saveAdmin(obj) {
  localStorage.setItem('adminUser', JSON.stringify(obj));
}

/* ---------------------------
   Produk: CRUD + persist
   localStorage key: produkList (array produk)
   produk object: {id, nama, harga, stok, link, gambarDataUrl}
----------------------------*/
function getProdukList() {
  try {
    return JSON.parse(localStorage.getItem('produkList')) || [];
  } catch (e) { return []; }
}
function saveProdukList(list) {
  localStorage.setItem('produkList', JSON.stringify(list));
}

/* ---------------------------
   Render tabel produk (dipakai di produk.html)
----------------------------*/
function renderProdukTable() {
  const tbody = document.querySelector('#tabel-produk tbody');
  if (!tbody) return;
  const list = getProdukList();
  tbody.innerHTML = '';
  list.forEach(p => {
    const tr = document.createElement('tr');
    tr.dataset.id = p.id;
    tr.innerHTML = `
      <td><img src="${p.gambarDataUrl}" alt="${p.nama}"></td>
      <td>${p.nama}</td>
      <td>Rp ${parseInt(p.harga).toLocaleString('id-ID')}</td>
      <td>${p.stok}</td>
      <td><a href="${p.link}" target="_blank" rel="noopener">Lihat</a></td>
      <td>
        <button type="button" class="btn-edit" data-id="${p.id}">Edit</button>
        <button type="button" class="btn-delete" data-id="${p.id}">Hapus</button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  // attach events
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = e.currentTarget.dataset.id;
      hapusProdukById(id);
    });
  });
  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = e.currentTarget.dataset.id;
      bukaEditById(id);
    });
  });
}

/* ---------------------------
   Tambah produk (form-produk)
----------------------------*/
const formProduk = document.getElementById('form-produk');
if (formProduk) {
  formProduk.addEventListener('submit', function(e){
    e.preventDefault();
    const nama = document.getElementById('nama').value.trim();
    const harga = document.getElementById('harga').value;
    const stok = document.getElementById('stok').value;
    const link = document.getElementById('link').value;
    const gambarFile = document.getElementById('gambar').files[0];

    if (!gambarFile) { alert('Pilih gambar produk'); return; }

    const reader = new FileReader();
    reader.onload = function(evt) {
      const list = getProdukList();
      const newProduk = {
        id: 'p' + Date.now(),
        nama, harga: Number(harga) || 0, stok: Number(stok) || 0,
        link, gambarDataUrl: evt.target.result
      };
      list.push(newProduk);
      saveProdukList(list);
      renderProdukTable();
      formProduk.reset();
      document.getElementById('gambar').value = ''; // reset file input
      // jika di dashboard juga, update KPI
      renderDashboard();
    };
    reader.readAsDataURL(gambarFile);
  });
}

/* ---------------------------
   Hapus produk by id
----------------------------*/
function hapusProdukById(id) {
  if (!confirm('Yakin ingin menghapus produk ini?')) return;
  const list = getProdukList().filter(p => p.id !== id);
  saveProdukList(list);
  renderProdukTable();
  renderDashboard();
}

/* ---------------------------
   Edit produk: buka modal edit (mengisi form-edit)
----------------------------*/
let currentEditId = null;
const editOverlay = document.getElementById('edit-overlay');
const formEdit = document.getElementById('form-edit');

function bukaEditById(id) {
  const list = getProdukList();
  const p = list.find(x => x.id === id);
  if (!p) return;
  currentEditId = id;
  document.getElementById('edit-nama').value = p.nama;
  document.getElementById('edit-harga').value = p.harga;
  document.getElementById('edit-stok').value = p.stok;
  document.getElementById('edit-link').value = p.link;
  if (editOverlay) editOverlay.style.display = 'flex';
}

function tutupEdit() {
  if (editOverlay) editOverlay.style.display = 'none';
  if (formEdit) formEdit.reset();
  currentEditId = null;
}
if (editOverlay) {
  editOverlay.addEventListener('click', function(e){
    if (e.target === editOverlay) tutupEdit();
  });
}
if (formEdit) {
  formEdit.addEventListener('submit', function(e){
    e.preventDefault();
    if (!currentEditId) return;
    const nama = document.getElementById('edit-nama').value.trim();
    const harga = Number(document.getElementById('edit-harga').value) || 0;
    const stok = Number(document.getElementById('edit-stok').value) || 0;
    const link = document.getElementById('edit-link').value;
    const gambarFile = document.getElementById('edit-gambar').files[0];

    const list = getProdukList();
    const idx = list.findIndex(p => p.id === currentEditId);
    if (idx === -1) return;

    list[idx].nama = nama;
    list[idx].harga = harga;
    list[idx].stok = stok;
    list[idx].link = link;

    if (gambarFile) {
      const reader = new FileReader();
      reader.onload = function(evt) {
        list[idx].gambarDataUrl = evt.target.result;
        saveProdukList(list);
        renderProdukTable();
        tutupEdit();
        renderDashboard();
      };
      reader.readAsDataURL(gambarFile);
    } else {
      saveProdukList(list);
      renderProdukTable();
      tutupEdit();
      renderDashboard();
    }
  });
}

/* ---------------------------
   Render dashboard (dipakai oleh index.html)
   - update KPI
   - update low-stock list
----------------------------*/
function renderDashboard() {
  const produk = getProdukList();
  const total = produk.length;
  const stokHabis = produk.filter(p => Number(p.stok) === 0).length;

  const elTotal = document.getElementById('kpi-total-produk');
  const elStokHabis = document.getElementById('kpi-stok-habis');

  if (elTotal) elTotal.textContent = total;
  if (elStokHabis) elStokHabis.textContent = stokHabis;

  // low stock top3
  const low = [...produk].sort((a,b) => Number(a.stok) - Number(b.stok)).slice(0,3);
  const container = document.getElementById('low-stock-list');
  if (container) {
    container.innerHTML = low.length ? low.map(p => `
      <li class="low-stock-item">
        <img class="low-stock-thumb" src="${p.gambarDataUrl}" alt="${p.nama}">
        <div>
          <div class="low-stock-name">${p.nama}</div>
          <div class="low-stock-stock">Stok: ${p.stok}</div>
        </div>
      </li>`).join('') : '<li>Tidak ada produk</li>';
  }
}

/* ---------------------------
   Profil / password
----------------------------*/
const profileIcon = document.getElementById('profile-icon');
const profileDropdown = document.getElementById('profile-dropdown');

if (profileIcon) {
  profileIcon.addEventListener('click', (e)=> {
    e.stopPropagation();
    if (profileDropdown) {
      profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
    }
  });
  window.addEventListener('click', (e)=> {
    if (!e.target.closest('.header-right') && profileDropdown) profileDropdown.style.display = 'none';
  });
}

// Modal ganti password (index.html)
function bukaModalPassword() {
  const overlay = document.getElementById('password-overlay');
  if (overlay) overlay.style.display = 'flex';
  if (profileDropdown) profileDropdown.style.display = 'none';
}
function tutupModalPassword() {
  const overlay = document.getElementById('password-overlay');
  if (overlay) overlay.style.display = 'none';
}
const formPassword = document.getElementById('form-password');
if (formPassword) {
  formPassword.addEventListener('submit', function(e){
    e.preventDefault();
    const lama = document.getElementById('password-lama').value;
    const baru = document.getElementById('password-baru').value;
    const konf = document.getElementById('password-konfirmasi').value;
    const admin = getAdmin();
    if (!admin) { alert('Akun admin belum terdaftar. Silakan daftar terlebih dahulu.'); return; }
    if (lama !== (admin.password || '')) { alert('Password lama salah!'); return; }
    if (baru !== konf) { alert('Konfirmasi password tidak sama!'); return; }
    admin.password = baru;
    saveAdmin(admin);
    alert('Password berhasil diperbarui!');
    tutupModalPassword();
  });
}

// Modal pengaturan akun (produk.html)
function bukaModalProfil() {
  const overlay = document.getElementById('profil-overlay');
  const admin = getAdmin();
  if (overlay) overlay.style.display = 'flex';
  if (admin) {
    const u = document.getElementById('profil-username');
    const e = document.getElementById('profil-email');
    if (u) u.value = admin.username || '';
    if (e) e.value = admin.email || '';
  }
  if (profileDropdown) profileDropdown.style.display = 'none';
}
function tutupModalProfil() {
  const overlay = document.getElementById('profil-overlay');
  if (overlay) overlay.style.display = 'none';
}

/* ---------------------------
   Sidebar toggle (mobile)
----------------------------*/
const sidebarToggle = document.getElementById('sidebarToggle');
if (sidebarToggle) {
  sidebarToggle.addEventListener('click', () => {
    const sidebar = document.getElementById('sidebar');
    if (sidebar) sidebar.classList.toggle('open');
  });
}

/* ---------------------------
   Inisialisasi di load
----------------------------*/
document.addEventListener('DOMContentLoaded', () => {
  renderProdukTable();
  renderDashboard();
});
