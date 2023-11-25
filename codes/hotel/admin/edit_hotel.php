<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

// Mendapatkan ID hotel dari URL
$hotelId = isset($_GET['id']) ? $_GET['id'] : '';

// Mengambil data hotel dari database
$stmt = $conn->prepare("SELECT Name, Location, Description FROM Hotels WHERE HotelID = ?");
$stmt->bind_param("i", $hotelId);
$stmt->execute();
$result = $stmt->get_result();
$hotel = $result->fetch_assoc();

// Logika untuk mengupdate hotel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Mempersiapkan statement untuk mengupdate hotel
    $updateStmt = $conn->prepare("UPDATE Hotels SET Name = ?, Location = ?, Description = ? WHERE HotelID = ?");
    $updateStmt->bind_param("sssi", $name, $location, $description, $hotelId);

    if ($updateStmt->execute()) {
        echo "<script>alert('Hotel berhasil diperbarui.'); window.location='manage_hotels.php';</script>";
    } else {
        echo "<script>alert('Error: " . $updateStmt->error . "');</script>";
    }
    $updateStmt->close();
}

include '../includes/admin_header.php';
?>

<div class="container mt-4">
    <h2>Edit Hotel</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Hotel:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($hotel['Name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi:</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($hotel['Location']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($hotel['Description']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Hotel</button> 
        <a href="manage_hotels.php" class="btn btn-primary">Kembali</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

