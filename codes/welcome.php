<?php
session_start(); // Memulai session

// Memeriksa apakah pengguna sudah login. Jika tidak, redirect ke halaman login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: form-login.php");
    exit;
}

// Jika sudah login, tampilkan pesan selamat datang
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"> <!-- Bootstrap CSS lokal -->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-5">
                <div class="card-header">Selamat Datang</div>
                <div class="card-body">
                    <h5 class="card-title">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h5>
                    <p class="card-text">Anda berhasil login.</p>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script> <!-- Bootstrap JS lokal -->

</body>
</html>