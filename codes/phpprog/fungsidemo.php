<?php
function tambah($angka1, $angka2) {
    $hasil = $angka1 + $angka2;
    return $hasil;
}

$hasilLuar = tambah(5, 3);
echo "Hasil penjumlahan: $hasilLuar<br>";

function cobaRuangLingkup() {
    $variabelLokal = "Ini lokal";
    echo "Dalam fungsi: $variabelLokal<br>";
}

cobaRuangLingkup();

// Akan menyebabkan error karena $variabelLokal tidak didefinisikan di ruang lingkup global
// echo "Di luar fungsi: $variabelLokal<br>"; 

$variabelGlobal = "Ini global";
function cobaGlobal() {
    global $variabelGlobal;
    echo "Dalam fungsi menggunakan global: $variabelGlobal<br>";
}

cobaGlobal();
echo "Di luar fungsi: $variabelGlobal<br>";
?>