<?php
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;

header("Content-Type: application/json");
$secret_key = "123456789012345678901234567890ab"; // Ganti dengan kunci rahasia Anda

// Menerima username dan password dari request POST
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

// Verifikasi username dan password (contoh sederhana)
if ($username == 'user1' && $password == 'pass123') {
    $issuedAt = time();
    $expirationTime = $issuedAt + 3600;  // Token valid selama 1 jam
    $payload = array(
        'iat' => $issuedAt,
        'exp' => $expirationTime,
        'iss' => 'localhost',
        'data' => array(
            'userId' => 1,
            'userName' => $username
        )
    );

    $jwt = JWT::encode($payload, $secret_key,'HS256');
    echo json_encode(['message' => 'Login successful', 'token' => $jwt]);
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Login failed']);
}
?>