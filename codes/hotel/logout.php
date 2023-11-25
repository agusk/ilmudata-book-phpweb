<?php
session_start();

// Menghapus semua variabel sesi
session_unset();

// Mengakhiri sesi
session_destroy();

// Arahkan kembali ke halaman utama
header("location: index.php");
exit;
?>
