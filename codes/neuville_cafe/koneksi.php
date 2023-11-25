<?php
$conn = new mysqli("localhost", "root", "pass123", "neuville_cafe");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
