<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $paymentId = $_GET['id'];
    $action = $_GET['action'];

    $conn->begin_transaction(); // Mulai transaksi

    try {
        if ($action == 'approve') {
            $newStatus = 'paid';
        } elseif ($action == 'reject') {
            $newStatus = 'failed';

            // Jika status failed, ubah ketersediaan kamar
            // Dapatkan RoomID dari tabel Bookings terkait PaymentID
            $bookingQuery = $conn->prepare("SELECT RoomID FROM Bookings WHERE BookingID = (SELECT BookingID FROM Payments WHERE PaymentID = ?)");
            $bookingQuery->bind_param("i", $paymentId);
            $bookingQuery->execute();
            $bookingResult = $bookingQuery->get_result();
            $bookingData = $bookingResult->fetch_assoc();

            // Update ketersediaan kamar
            if ($bookingData) {
                $roomId = $bookingData['RoomID'];
                $updateRoom = $conn->prepare("UPDATE Rooms SET Availability = 1 WHERE RoomID = ?");
                $updateRoom->bind_param("i", $roomId);
                $updateRoom->execute();
                $updateRoom->close();
            }
        } else {
            exit('Aksi tidak dikenal');
        }

        // Update status pembayaran
        $stmt = $conn->prepare("UPDATE Payments SET Status = ? WHERE PaymentID = ?");
        $stmt->bind_param("si", $newStatus, $paymentId);
        $stmt->execute();
        $stmt->close();

        $conn->commit(); // Commit transaksi jika tidak ada error
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaksi jika ada error
        exit('Error: ' . $e->getMessage());
    }

    header("location: manage_payments.php");
    exit;
}

header("location: manage_payments.php");
exit;
?>
