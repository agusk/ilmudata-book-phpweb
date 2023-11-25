<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pendaftaran</title>
    <!-- Menyertakan CSS Bootstrap dari folder lokal -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Formulir Pendaftaran
                </div>
                <div class="card-body">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // ... Proses data dan tampilkan output
                        $nama = $_POST['nama'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $alamat = $_POST['alamat'];
                        $jenis_kelamin = $_POST['jenis_kelamin'];
                        $pekerjaan = $_POST['pekerjaan'];
                        $setuju = isset($_POST['setuju']) ? 'Ya' : 'Tidak';

                        // Tampilkan data
                        echo "<h2>Data Pendaftaran:</h2>";
                        echo "Nama: " . $nama . "<br>";
                        echo "Email: " . $email . "<br>";
                        echo "Password: " . $password . "<br>"; // Harus dienkripsi pada aplikasi nyata
                        echo "Alamat: " . $alamat . "<br>";
                        echo "Jenis Kelamin: " . $jenis_kelamin . "<br>";
                        echo "Pekerjaan: " . $pekerjaan . "<br>";
                        echo "Setuju: " . $setuju;
                    } else {
                    ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea class="form-control" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <div>
                                <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                                <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan:</label>
                            <select class="form-control" name="pekerjaan">
                                <option value="Pelajar">Pelajar</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Pekerja">Pekerja</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="setuju" name="setuju" value="Ya">
                            <label class="form-check-label" for="setuju">Setuju</label>
                        </div>
                        <button type="submit" class="btn btn-primary" id="tombolDaftar" disabled>Daftar</button>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menyertakan JavaScript Bootstrap dari folder lokal -->
<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="/js/bootstrap.min.js"></script>

<script>
    document.getElementById('setuju').addEventListener('change', function() {
        document.getElementById('tombolDaftar').disabled = !this.checked;
    });
</script>

</body>
</html>