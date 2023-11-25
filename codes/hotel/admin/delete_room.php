<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    // Mempersiapkan dan mengeksekusi query untuk menghapus kamar
    $stmt = $conn->prepare("DELETE FROM Rooms WHERE RoomID = ?");
    $stmt->bind_param("i", $roomId);

    if ($stmt->execute()) {
        header("location: manage_rooms.php");
        exit;
    } else {
        // Tampilkan pesan error jika penghapusan gagal
        echo "<script>alert('Error: " . $stmt->error . "'); window.location='manage_rooms.php';</script>";
    }
}

// Tidak ada tampilan HTML yang diperlukan untuk delete_room.php
?>
