<?php
     $conn = new mysqli("localhost", "root", "pass123", "mysql");

     if ($conn->connect_error) {
         die("Koneksi gagal: " . $conn->connect_error);
     } 
     echo "Koneksi berhasil";
     ?>