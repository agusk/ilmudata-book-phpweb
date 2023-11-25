<?php
include 'includes/db.php';
session_start();

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mempersiapkan statement untuk login
    $stmt = $conn->prepare("SELECT UserID, Email, Password,Role FROM Users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['Password'])) {
            // Password cocok, lanjutkan login
            $_SESSION['user_id'] = $row['UserID'];
            $_SESSION['login_user'] = $row['Email'];
            $_SESSION['user_role'] = $row['Role'];
            header("location: index.php");
        } else {
            $error = "Email atau Password salah";
        }
    } else {
        $error = "Email atau Password salah";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-5">
                <div class="card-body">
                    <h3 class="card-title text-center">Login</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="register.php" class="btn btn-primary">Daftar</a>
                    </form>
                    <?php if(isset($error)) echo "<p class='text-danger mt-2'>$error</p>"; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
