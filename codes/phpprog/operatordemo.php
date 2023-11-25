<?php
// Demonstrasi Operator dan Ekspresi

// Operator Aritmatika
$angka1 = 10;
$angka2 = 3;
$jumlah = $angka1 + $angka2;
$selisih = $angka1 - $angka2;
$produk = $angka1 * $angka2;
$bagi = $angka1 / $angka2;
$modulus = $angka1 % $angka2;

echo "Jumlah: $jumlah<br>";
echo "Selisih: $selisih<br>";
echo "Produk: $produk<br>";
echo "Bagi: $bagi<br>";
echo "Modulus: $modulus<br>";

// Operator Perbandingan
$apakahSama = ($angka1 == $angka2);
$apakahTidakSama = ($angka1 != $angka2);
$apakahLebihBesar = ($angka1 > $angka2);

echo "Apakah sama? " . ($apakahSama ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah tidak sama? " . ($apakahTidakSama ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah lebih besar? " . ($apakahLebihBesar ? 'Ya' : 'Tidak') . "<br>";

// Operator Logika
$apakahKeduanyaBenar = ($angka1 > 0) && ($angka2 < 5);
$apakahSalahSatunyaBenar = ($angka1 < 0) || ($angka2 < 5);

echo "Apakah keduanya benar? " . ($apakahKeduanyaBenar ? 'Ya' : 'Tidak') . "<br>";
echo "Apakah salah satunya benar? " . ($apakahSalahSatunyaBenar ? 'Ya' : 'Tidak') . "<br>";
?>