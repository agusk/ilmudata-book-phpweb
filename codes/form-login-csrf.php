<?php
session_start();

// Fungsi untuk menghasilkan token CSRF
function generateCsrfToken() {
    return bin2hex(random_bytes(32));
}

// Membuat dan menyimpan token CSRF di session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCsrfToken();
}

// Memeriksa token CSRF saat formulir di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed!");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi username dan password (harusnya dari database)
    if ($username == 'admin' && $password == 'password') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        setcookie("username", $username, time() + (86400 * 30), "/"); // Set cookie untuk 30 hari
        header("Location: welcome.php"); // Redirect ke halaman welcome
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form dengan CSRF Protection</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card my-5">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
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