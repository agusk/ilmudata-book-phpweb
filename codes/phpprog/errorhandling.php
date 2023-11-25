<?php
function bagi($pembilang, $penyebut) {
    if ($penyebut == 0) {
        throw new Exception("Pembagian dengan nol.");
    }
    return $pembilang / $penyebut;
}

try {
    echo bagi(10, 2) . "<br>";  // Berhasil
    echo bagi(5, 0) . "<br>";   // Akan menimbulkan Exception
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage() . "<br>";
} finally {
    echo "Blok finally selalu dijalankan.<br>";
}

echo "Eksekusi program berlanjut.";
?>