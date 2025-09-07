// Data contoh, nanti bisa diambil dari database / API
const dataStatistik = {
  produk: 12,
  pesanan: 57,
  pendapatan: 12500000,
  rating: 4.5,
  ratingPerBulan: {
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
    values: [4.2, 4.4, 4.1, 4.6, 4.3, 4.5]
  }
};

// Helper set text if exists
function setText(id, val){
  const el = document.getElementById(id);
  if (el) el.innerText = val;
}

// --- Tampilkan angka ringkasan ---
setText("stat-produk", dataStatistik.produk);
setText("stat-pesanan", dataStatistik.pesanan);
setText("stat-pendapatan", "Rp " + dataStatistik.pendapatan.toLocaleString("id-ID"));
setText("stat-rating", dataStatistik.rating.toFixed(1));

// --- Render grafik rating ---
const chartCanvas = document.getElementById("chart-rating");
if (chartCanvas && typeof Chart !== "undefined") {
  const ctx = chartCanvas.getContext("2d");
  new Chart(ctx, {
    type: "line",
    data: {
      labels: dataStatistik.ratingPerBulan.labels,
      datasets: [{
        label: "Rating Rata-rata",
        data: dataStatistik.ratingPerBulan.values,
        borderColor: "blue",
        backgroundColor: "rgba(0,0,255,0.1)",
        tension: 0.3,
        fill: true,
        pointRadius: 5
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true, max: 5 } }
      
    }
    
  });
}
