<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

// Tampilkan semua pembayaran dengan status 'pending'
$sql = "SELECT PaymentID, BookingID, Amount, Status FROM Payments WHERE Status = 'pending'";
$result = $conn->query($sql);

include '../includes/admin_header.php';
?>

<div class="container mt-4">
    <h2>Manajemen Pembayaran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Pembayaran</th>
                <th>ID Pemesanan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['PaymentID'] ?></td>
                <td><?= $row['BookingID'] ?></td>
                <td><?= $row['Amount'] ?></td>
                <td><?= $row['Status'] ?></td>
                <td>
                    <a href="process_payment.php?action=approve&id=<?= $row['PaymentID'] ?>" class="btn btn-success btn-sm">Setujui</a>
                    <a href="process_payment.php?action=reject&id=<?= $row['PaymentID'] ?>" class="btn btn-danger btn-sm">Tolak</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
