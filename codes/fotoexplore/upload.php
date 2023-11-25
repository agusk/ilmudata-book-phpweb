<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploads/";
    $file = $_FILES["foto"];
    $targetFile = $targetDir . uniqid() . "-" . basename($file["name"]);
    
    // Cek dan pindahkan file ke folder uploads
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        header("Location: index.php"); // Redirect kembali ke index.php
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}
?>