<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    exit;
}

$roomId = isset($_GET['room_id']) ? $_GET['room_id'] : '';
$userId = $_SESSION['user_id']; // Asumsikan user_id tersimpan di sesi setelah login

// Dapatkan harga kamar
$priceQuery = $conn->prepare("SELECT Price FROM Rooms WHERE RoomID = ?");
$priceQuery->bind_param("i", $roomId);
$priceQuery->execute();
$priceResult = $priceQuery->get_result();
$room = $priceResult->fetch_assoc();
$roomPrice = $room['Price'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkInDate = $_POST['check_in_date'];
    $checkOutDate = $_POST['check_out_date'];
    $paymentMethod = $_POST['payment_method'];

    // Hitung jumlah hari
    $date1 = new DateTime($checkInDate);
    $date2 = new DateTime($checkOutDate);
    $interval = $date1->diff($date2);
    $days = $interval->days;

    // Hitung total harga
    $amount = $days * $roomPrice;

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Insert ke tabel Bookings
        $stmtBooking = $conn->prepare("INSERT INTO Bookings (UserID, RoomID, CheckInDate, CheckOutDate, TotalPrice) VALUES (?, ?, ?, ?, ?)");
        $stmtBooking->bind_param("iissd", $userId, $roomId, $checkInDate, $checkOutDate, $amount);
        $stmtBooking->execute();
        $bookingId = $stmtBooking->insert_id;

        // Insert ke tabel Payments
        $stmtPayment = $conn->prepare("INSERT INTO Payments (BookingID, Amount, PaymentMethod) VALUES (?, ?, ?)");
        $stmtPayment->bind_param("ids", $bookingId, $amount, $paymentMethod);
        $stmtPayment->execute();

        // Update status ketersediaan kamar
        $updateRoom = $conn->prepare("UPDATE Rooms SET Availability = 0 WHERE RoomID = ?");
        $updateRoom->bind_param("i", $roomId);
        $updateRoom->execute();        

        // Jika tidak ada masalah, commit transaksi
        $conn->commit();

        echo "<script>alert('Pemesanan berhasil.'); window.location='index.php';</script>";
    } catch (Exception $e) {
        // Jika ada masalah, rollback transaksi
        $conn->rollback();
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }

    $stmtBooking->close();
    $stmtPayment->close();
    $updateRoom->close();
}

include 'includes/header.php';
?>

<div class="container mt-4">
    <h2>Booking Kamar Hotel</h2>
    <form action="booking.php?room_id=<?= $roomId ?>" method="post">
        <div class="mb-3">
            <label for="check_in_date" class="form-label">Tanggal Check-In:</label>
            <input type="date" class="form-control" id="check_in_date" 
            name="check_in_date" required onchange="updateAmount()" >
        </div>
        
        <div class="mb-3">
            <label for="check_out_date" class="form-label">Tanggal Check-Out:</label>
            <input type="date" class="form-control" id="check_out_date" 
            name="check_out_date" required onchange="updateAmount()" >
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Pembayaran:</label>
            <input type="number" class="form-control" id="amount" 
            name="amount" value="<?= $days * $roomPrice ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran:</label>
            <select class="form-control" id="payment_method" name="payment_method">
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
                <!-- Tambahkan metode pembayaran lain jika perlu -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

<script>
// Fungsi untuk menghitung dan memperbarui jumlah pembayaran
function updateAmount() {
    var checkInDate = new Date(document.getElementById('check_in_date').value);
    var checkOutDate = new Date(document.getElementById('check_out_date').value);
    var timeDiff = checkOutDate.getTime() - checkInDate.getTime();
    var daysDiff = timeDiff / (1000 * 3600 * 24);

    // Pastikan perhitungan tidak menghasilkan NaN atau nilai negatif
    if (!isNaN(daysDiff) && daysDiff > 0) {
        var pricePerNight = <?= $roomPrice ?>; // Harga per malam dari PHP
        document.getElementById('amount').value = daysDiff * pricePerNight;
    } else {
        document.getElementById('amount').value = '';
    }
}
</script>

<?php
include 'includes/footer.php';
?>
