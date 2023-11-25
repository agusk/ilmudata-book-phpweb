<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kafe Neuville</title>
    <!-- Sisipkan Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Produk Kafe Neuville</h2>
        <a href="tambah.php" class="btn btn-primary">Tambah Produk</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['nama_produk']."</td>
                                <td>".$row['harga']."</td>
                                <td>".$row['deskripsi']."</td>
                                <td>
                                    <a href='ubah.php?id=".$row['id']."' class='btn btn-warning'>Edit</a>
                                    <a href='hapus.php?id=".$row['id']."' class='btn btn-danger'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<!-- Menyertakan JavaScript Bootstrap dari folder lokal -->
<script src="js/jquery-3.7.1.slim.min.js"></script>
<script src="js/popper.min.js" ></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>
