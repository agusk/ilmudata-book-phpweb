<?php
include 'koneksi.php';
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM produk WHERE id=?");
$stmt->bind_param("i", $id); // 'i' menandakan tipe data integer

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
