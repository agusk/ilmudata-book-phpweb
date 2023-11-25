<?php
session_start(); // Memulai session

// Mengakhiri session: Hapus semua data session
$_SESSION = array();

// Menghancurkan session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); // Menghancurkan session

// Redirect ke halaman login
header("Location: form-login.php");
exit;
?>