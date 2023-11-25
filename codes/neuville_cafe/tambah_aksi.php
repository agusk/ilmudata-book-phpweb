<?php
include 'koneksi.php';

$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

$stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, deskripsi) VALUES (?, ?, ?)");
$stmt->bind_param("sds", $nama_produk, $harga, $deskripsi); // 'sds' menandakan tipe data: string, double, string

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
