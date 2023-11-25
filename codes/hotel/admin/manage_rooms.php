<?php
include '../includes/db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("location: ../login.php");
    exit;
}

// Mengambil daftar hotel untuk dropdown
$hotelsQuery = "SELECT HotelID, Name FROM Hotels";
$hotelsResult = $conn->query($hotelsQuery);

include '../includes/admin_header.php';
?>

<div class="container mt-4">
    <h2>Kelola Kamar Hotel</h2>
    
    <!-- Dropdown untuk memilih hotel -->
    <select class="form-select mb-3" id="hotelSelect" onchange="showRooms(this.value)">
        <option value="">Pilih Hotel...</option>
        <?php while($hotel = $hotelsResult->fetch_assoc()): ?>
            <option value="<?= $hotel['HotelID'] ?>"><?= htmlspecialchars($hotel['Name']) ?></option>
        <?php endwhile; ?>
    </select>

    <!-- Tombol untuk menambah kamar baru, dengan parameter hotelID -->
    <button class="btn btn-primary mb-3" onclick="addRoom()">Tambah Kamar</button>

    <!-- Tempat untuk menampilkan kamar hotel -->
    <div id="roomsDisplay"></div>
</div>

<script>
function showRooms(hotelId) {
    if (hotelId == "") {
        document.getElementById("roomsDisplay").innerHTML = "";
        return;
    } else {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("roomsDisplay").innerHTML = this.responseText;
        }
        xhttp.open("GET", "get_rooms.php?hotelId=" + hotelId, true);
        xhttp.send();
    }
}

function addRoom() {
    var hotelId = document.getElementById("hotelSelect").value;
    if (hotelId) {
        window.location.href = 'add_room.php?hotelId=' + hotelId;
    } else {
        alert("Silakan pilih hotel terlebih dahulu.");
    }
}
</script>


<?php include '../includes/footer.php'; ?>

