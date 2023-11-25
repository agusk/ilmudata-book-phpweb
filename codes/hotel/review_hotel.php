<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    exit;
}

$bookingId = isset($_GET['booking_id']) ? $_GET['booking_id'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingId = $_POST['booking_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    // Cek apakah sudah ada review untuk booking ini
    $checkStmt = $conn->prepare("SELECT * FROM Reviews WHERE BookingID = ?");
    $checkStmt->bind_param("i", $bookingId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows == 0) {
        // Simpan review
        $stmt = $conn->prepare("INSERT INTO Reviews (BookingID, Rating, Comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $bookingId, $rating, $review);
        $stmt->execute();
        $stmt->close();
    }
    $checkStmt->close();

    header("location: profile.php");
    exit;
}

include 'includes/header.php';
?>

<div class="container mt-4">
    <h2>Beri Review untuk Booking ID: <?= htmlspecialchars($bookingId) ?></h2>
    <form action="review_hotel.php" method="post">
        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($bookingId) ?>">

        <div class="mb-3">
            <label for="rating" class="form-label">Rating:</label>
            <select class="form-control" id="rating" name="rating">
                <option value="1">1 - Buruk</option>
                <option value="2">2 - Cukup</option>
                <option value="3">3 - Baik</option>
                <option value="4">4 - Sangat Baik</option>
                <option value="5">5 - Luar Biasa</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="review" class="form-label">Komentar:</label>
            <textarea class="form-control" id="review" name="review" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Review</button>
    </form>
</div>

<?php
include 'includes/footer.php';
?>
