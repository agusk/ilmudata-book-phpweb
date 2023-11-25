<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

// Logika untuk menambah hotel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Mempersiapkan statement untuk menambah hotel
    $stmt = $conn->prepare("INSERT INTO Hotels (Name, Location, Description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $location, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Hotel berhasil ditambahkan.'); window.location='manage_hotels.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

include '../includes/admin_header.php';
?>

<div class="container mt-4">
    <h2>Tambah Hotel</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Hotel:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi:</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Hotel</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

