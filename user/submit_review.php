<?php
$servername = "localhost";
$username = "root"; // default XAMPP
$password = "";
$dbname = "kedibihi_db";

// Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$product_id = $_POST['product_id']; // biar tahu ini ulasan produk mana

// Simpan ke database
$sql = "INSERT INTO reviews (product_id, name, rating, comment) 
        VALUES ('$product_id', '$name', '$rating', '$comment')";

if ($conn->query($sql) === TRUE) {
  echo "Ulasan berhasil disimpan!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
