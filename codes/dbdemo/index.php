<?php
include 'koneksi.php';

$sql = "SELECT id, nama, jurusan FROM mahasiswa";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nama: " . $row["nama"]. " - Jurusan: " . $row["jurusan"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>