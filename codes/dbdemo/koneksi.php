<?php
     $servername = "localhost";
     $username = "root";
     $password = "pass123";
     $dbname = "db_kampus";

     // Membuat koneksi
     $conn = new mysqli($servername, $username, $password, $dbname);

     // Mengecek koneksi
     if ($conn->connect_error) {
         die("Koneksi gagal: " . $conn->connect_error);
     } 
     echo "Koneksi berhasil";
     ?>