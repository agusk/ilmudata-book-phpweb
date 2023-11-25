<?php
$peserta = [];

function tambahPeserta($nama, $usia, $email) {
    global $peserta;

    if (empty($nama) || empty($usia) || empty($email)) {
        throw new Exception("Semua field harus diisi.");
    }
    if (!is_numeric($usia)) {
        throw new Exception("Usia harus berupa angka.");
    }

    $peserta[] = ["nama" => $nama, "usia" => $usia, "email" => $email];
}

function tampilkanPeserta() {
    global $peserta;
    echo "Daftar Peserta Acara di Kafe Neuville:<br>";
    foreach ($peserta as $p) {
        echo "Nama: " . $p['nama'] . ", Usia: " . $p['usia'] . ", Email: " . $p['email'] . "<br>";
    }
}

try {
    tambahPeserta("Andi", 22, "andi@example.com");
    tambahPeserta("Budi", 27, "budi@example.com");
    tambahPeserta("Citra", 20, "citra@example.com");
    tambahPeserta("Dewi", 25, "dewi@example.com");
    tambahPeserta("Eko", 30, "eko@example.com");
    tambahPeserta("Bob", "dua puluh lima", "bob@example.com"); // Akan menimbulkan Exception
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage() . "<br>";
}

tampilkanPeserta();
?>