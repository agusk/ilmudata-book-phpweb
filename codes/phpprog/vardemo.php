<?php
// Demonstrasi Variabel dan Tipe Data PHP

// Tipe data String
$nama = "John Doe";
echo "Nama: $nama<br>";

// Tipe data Integer
$umur = 25;
echo "Umur: $umur<br>";

// Tipe data Float/Double
$berat = 70.5;
echo "Berat: $berat kg<br>";

// Tipe data Boolean
$isStudent = true;
echo "Apakah mahasiswa? " . ($isStudent ? 'Ya' : 'Tidak') . "<br>";

// Tipe data Array
$hobi = array("Membaca", "Menulis", "Bersepeda");
echo "Hobi: " . implode(", ", $hobi) . "<br>";

// Tipe data NULL
$alamat = null;
echo "Alamat: " . ($alamat ?? 'Tidak Diketahui') . "<br>";

?>