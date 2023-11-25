<?php
include 'includes/db.php';
session_start();

include 'includes/header.php';

// Query untuk mengambil data kamar dan rata-rata ratingnya
$sql = "
SELECT h.Name, r.RoomID, r.Type, r.Price, r.Availability, COALESCE(AVG(rev.Rating), 0) as AvgRating
FROM Rooms r
LEFT JOIN Hotels h ON r.HotelID = h.HotelID
LEFT JOIN Bookings b ON r.RoomID = b.RoomID
LEFT JOIN Reviews rev ON b.BookingID = rev.BookingID
GROUP BY r.RoomID
";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h2>Daftar Kamar Tersedia</h2>
    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['Name']) ?> - <?= htmlspecialchars($row['Type']) ?></h5>
                        <p class="card-text">
                            Harga: <?= htmlspecialchars($row['Price']) ?><br>
                            Status: <?= $row['Availability'] ? 'Tersedia' : 'Tidak Tersedia' ?><br>
                            Rating: <?= round($row['AvgRating'], 1) ?> / 5
                            <!-- Tampilkan bintang berdasarkan rating -->
                            <?= str_repeat('&#9733;', round($row['AvgRating'])) ?>
                            <?= str_repeat('&#9734;', 5 - round($row['AvgRating'])) ?>
                        </p>
                        <?php if ($row['Availability']): ?>
                            <a href="booking.php?room_id=<?= $row['RoomID'] ?>" class="btn btn-primary">Booking</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
$conn->close(); // Menutup koneksi database
include 'includes/footer.php'; // Footer halaman
?>

