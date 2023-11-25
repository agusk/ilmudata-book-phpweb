<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk - Kafe Neuville</title>
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
        <h2>Tambah Produk</h2>
        <form action="tambah_aksi.php" method="post">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" class="form-control" name="nama_produk">
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="text" class="form-control" name="harga">
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea class="form-control" name="deskripsi"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

<!-- Menyertakan JavaScript Bootstrap dari folder lokal -->
<script src="js/jquery-3.7.1.slim.min.js"></script>
<script src="js/popper.min.js" ></script>
<script src="js/bootstrap.min.js"></script>   
</body>
</html>
