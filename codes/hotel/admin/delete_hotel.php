<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

// Mendapatkan ID hotel dari URL
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];

    // Mempersiapkan statement untuk menghapus hotel
    $stmt = $conn->prepare("DELETE FROM Hotels WHERE HotelID = ?");
    $stmt->bind_param("i", $hotelId);

    if ($stmt->execute()) {
        // Setelah menghapus, arahkan kembali ke halaman manage hotels
        header("location: manage_hotels.php");
        exit;
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location='manage_hotels.php';</script>";
    }
    $stmt->close();
} else {
    // Jika ID hotel tidak ditemukan, arahkan kembali ke halaman manage hotels
    header("location: manage_hotels.php");
    exit;
}
?>
