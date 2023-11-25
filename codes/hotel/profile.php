<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    exit;
}

$userEmail = $_SESSION['login_user'];

$stmt = $conn->prepare("
    SELECT b.BookingID, b.CheckInDate, b.CheckOutDate, b.TotalPrice, r.Type, h.Name AS HotelName
    FROM Bookings b
    JOIN Rooms r ON b.RoomID = r.RoomID
    JOIN Hotels h ON r.HotelID = h.HotelID
    JOIN Payments p ON p.BookingID = b.BookingID
    JOIN Users u ON b.UserID = u.UserID
    WHERE u.Email = ? AND p.Status = 'paid'
");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

include 'includes/header.php';
?>

<div class="container mt-4">
    <h2>Profil Pengguna</h2>
    <p>Selamat datang, <?= htmlspecialchars($userEmail) ?></p>

    <h3>Riwayat Pemesanan Dibayar</h3>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Hotel</th>
                    <th>Tipe Kamar</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Total Harga</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['BookingID'] ?></td>
                        <td><?= htmlspecialchars($row['HotelName']) ?></td>
                        <td><?= htmlspecialchars($row['Type']) ?></td>
                        <td><?= $row['CheckInDate'] ?></td>
                        <td><?= $row['CheckOutDate'] ?></td>
                        <td><?= $row['TotalPrice'] ?></td>
                        <td>
                            <?php
                            $reviewCheck = $conn->prepare("SELECT * FROM Reviews WHERE BookingID = ?");
                            $reviewCheck->bind_param("i", $row['BookingID']);
                            $reviewCheck->execute();
                            if ($reviewCheck->get_result()->num_rows == 0) {
                                echo "<a href='review_hotel.php?booking_id=" . $row['BookingID'] . "'>Beri Review</a>";
                            } else {
                                echo "Review Submitted";
                            }
                            $reviewCheck->close();
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Anda belum memiliki riwayat pemesanan yang dibayar.</p>
    <?php endif; ?>
</div>

<?php
include 'includes/footer.php';
?>
