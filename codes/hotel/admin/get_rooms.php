<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    echo "Akses ditolak: Anda tidak memiliki izin untuk melihat data ini.";
    exit;
}

if (isset($_GET['hotelId'])) {
    $hotelId = $_GET['hotelId'];

    // Mempersiapkan dan mengeksekusi query untuk mengambil kamar berdasarkan hotelId
    $stmt = $conn->prepare("SELECT RoomID, Type, Price,	Availability FROM Rooms WHERE HotelID = ?");
    $stmt->bind_param("i", $hotelId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Membuat tabel kamar
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>ID Kamar</th><th>Tipe Kamar</th><th>Harga</th><th>Ketersediaan</th><th>Aksi</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['RoomID'] . "</td>";
            echo "<td>" . htmlspecialchars($row['Type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Price']) . "</td>";
            echo "<td>";
            if ($row['Availability'] == 1) {
                echo "<span>&#10004;</span>"; // Centang hijau
            } else {
                echo "<span>&#10006;</span>"; // Silang merah
            }
            echo "</td>";
            echo "<td>";
            echo "<a href='edit_room.php?id=" . $row['RoomID'] . "' class='btn btn-primary btn-sm'>Edit</a> ";
            echo "<a href='delete_room.php?id=" . $row['RoomID'] . "' class='btn btn-danger btn-sm'>Hapus</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Tidak ada kamar yang tersedia untuk hotel ini.</p>";
    }

    $stmt->close();
}
?>
