<?php
header('Content-Type: application/json');

// Koneksi ke database
$host = "localhost";
$user = "root"; // default XAMPP user
$pass = "";     // default XAMPP password kosong
$db   = "kedibihi_db";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}

// Ambil semua ulasan terbaru (pakai alias supaya sesuai dengan frontend)
$sql = "SELECT NAME AS nama, rating, COMMENT AS komentar, created_at 
        FROM reviews 
        ORDER BY created_at DESC";
$result = $conn->query($sql);

$reviews = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

echo json_encode($reviews);
$conn->close();
?>
