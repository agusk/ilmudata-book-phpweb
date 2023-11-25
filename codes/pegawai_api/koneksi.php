<?php
   $conn = new mysqli("localhost", "root", "pass123", "pegawai_db");
   if ($conn->connect_error) {
       die("Koneksi gagal: " . $conn->connect_error);
   }
   ?>