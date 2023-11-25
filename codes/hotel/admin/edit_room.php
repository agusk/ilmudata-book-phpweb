<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

$roomId = isset($_GET['id']) ? $_GET['id'] : '';

// Mengambil data kamar
if ($roomId) {
    $stmt = $conn->prepare("SELECT Type, Price, Availability FROM Rooms WHERE RoomID = ?");
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();
}

// Logika untuk update data kamar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $price = $_POST['price'];
    $availability = isset($_POST['availability']) ? 1 : 0;

    // Mempersiapkan statement untuk update kamar
    $updateStmt = $conn->prepare("UPDATE Rooms SET Type = ?, Price = ?, Availability = ? WHERE RoomID = ?");
    $updateStmt->bind_param("siii", $type, $price, $availability, $roomId);

    if ($updateStmt->execute()) {
        echo "<script>alert('Kamar berhasil diperbarui.'); window.location='manage_rooms.php';</script>";
    } else {
        echo "<script>alert('Error: " . $updateStmt->error . "');</script>";
    }
    $updateStmt->close();
}

include '../includes/admin_header.php';
?>

<div class="container mt-4">
    <h2>Edit Kamar</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="type" class="form-label">Tipe Kamar:</label>
            <input type="text" class="form-control" id="type" name="type" value="<?= htmlspecialchars($room['Type']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($room['Price']) ?>" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="availability" name="availability" <?= $room['Availability'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="availability">Tersedia</label>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Kamar</button>
        <a href="manage_rooms.php" class="btn btn-primary">Kembali</a>
    </form>
</div>


<?php include '../includes/footer.php'; ?>
