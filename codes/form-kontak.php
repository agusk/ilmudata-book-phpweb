<!DOCTYPE html>
<html>
<head>
    <title>Formulir Kontak</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form ketika di-submit
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Tampilkan data
    echo "<h2>Input Anda:</h2>";
    echo "Nama: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Pesan: " . $message;
} else {
    // Tampilkan formulir jika halaman tidak di-submit
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Nama: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        Pesan: <textarea name="message"></textarea><br>
        <input type="submit" value="Kirim">
    </form>
    <?php
}
?>

</body>
</html>