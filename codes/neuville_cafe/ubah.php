<?php
include 'koneksi.php';
$id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ubah Produk - Kafe Neuville</title>
    <!-- Sisipkan Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <h2>Ubah Produk</h2>
        <form action="ubah_aksi.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" class="form-control" name="nama_produk" value="<?php echo $row['nama_produk']; ?>">
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="text" class="form-control" name="harga" value="<?php echo $row['harga']; ?>">
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea class="form-control" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
    </div>
<!-- Menyertakan JavaScript Bootstrap dari folder lokal -->
<script src="js/jquery-3.7.1.slim.min.js"></script>
<script src="js/popper.min.js" ></script>
<script src="js/bootstrap.min.js"></script>       
</body>
</html>
