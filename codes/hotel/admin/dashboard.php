<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

include '../includes/admin_header.php'; // Header khusus admin
?>

<div class="container mt-4">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang di area admin!</p>
    <a href="manage_hotels.php" class="btn btn-primary">Kelola Hotel</a>
    <a href="manage_rooms.php" class="btn btn-primary">Kelola Kamar Hotel</a>
    <a href="manage_payments.php" class="btn btn-primary">Kelola Pembayaran</a>
</div>

<?php include '../includes/footer.php'; ?>