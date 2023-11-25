<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

$stmt = $conn->prepare("UPDATE produk SET nama_produk=?, harga=?, deskripsi=? WHERE id=?");
$stmt->bind_param("sdsi", $nama_produk, $harga, $deskripsi, $id); // 'sdsi' menandakan tipe data: string, double, string, integer

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
