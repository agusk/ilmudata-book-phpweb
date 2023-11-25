<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

// Logika untuk mengambil data hotel dari database
$stmt = $conn->prepare("SELECT * FROM Hotels");
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include '../includes/admin_header.php'; ?>

<div class="container mt-4">
    <h2>Kelola Hotel</h2>
    <a href="add_hotel.php" class="btn btn-success mb-3">Tambah Hotel Baru</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Jumlah Kamar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['HotelID']) ?></td>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= htmlspecialchars($row['Location']) ?></td>
                <td>
                        <?php
                        $reviewCheck = $conn->prepare("SELECT count(RoomID) FROM Rooms WHERE HotelID = ?");
                        $reviewCheck->bind_param("i", $row['HotelID']);
                        $reviewCheck->execute();
                        $totalRoom = $reviewCheck->get_result()->fetch_row()[0];
                        $reviewCheck->close();
                        ?>    
                
                        <?= htmlspecialchars($totalRoom) ?></td>
                <td>
                    <a href="edit_hotel.php?id=<?= $row['HotelID'] ?>" class="btn btn-primary">Edit</a>
                    <a href="delete_hotel.php?id=<?= $row['HotelID'] ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
$stmt->close();
include '../includes/footer.php';
?>
