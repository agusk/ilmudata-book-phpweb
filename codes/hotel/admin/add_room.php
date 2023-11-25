<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

$hotelId = isset($_GET['hotelId']) ? $_GET['hotelId'] : '';

// Logika untuk menambah kamar baru
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $price = $_POST['price'];
    $availability = isset($_POST['availability']) ? 1 : 0;

    // Mempersiapkan statement untuk menambah kamar
    $stmt = $conn->prepare("INSERT INTO Rooms (HotelID, Type, Price, Availability) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isdi", $hotelId, $type, $price, $availability);

    if ($stmt->execute()) {
        echo "<script>alert('Kamar berhasil ditambahkan.'); window.location='manage_rooms.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

include '../includes/admin_header.php';
?>

<div class="container mt-4">
    <h2>Tambah Kamar Hotel</h2>
    <form action="" method="post">
        <input type="hidden" name="hotelId" value="<?= $hotelId ?>">
        <div class="mb-3">
            <label for="type" class="form-label">Tipe Kamar:</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" checked id="availability" name="availability">
            <label class="form-check-label" for="availability">Tersedia</label>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Kamar</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

