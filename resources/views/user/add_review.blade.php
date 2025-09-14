<?php
header('Content-Type: application/json');

// Koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kedibihi_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}

// Ambil data dari POST
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$nama       = isset($_POST['nama']) ? $conn->real_escape_string($_POST['nama']) : '';
$rating     = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
$komentar   = isset($_POST['komentar']) ? $conn->real_escape_string($_POST['komentar']) : '';

// Validasi sederhana
if ($product_id <= 0 || empty($nama) || $rating < 1 || $rating > 5 || empty($komentar)) {
    echo json_encode(["error" => "Data tidak valid"]);
    exit;
}

// Insert ke database
$sql = "INSERT INTO reviews (product_id, NAME, rating, COMMENT) 
        VALUES ($product_id, '$nama', $rating, '$komentar')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Review berhasil ditambahkan"]);
} else {
    echo json_encode(["error" => "Gagal menambahkan review: " . $conn->error]);
}

$conn->close();
?>
