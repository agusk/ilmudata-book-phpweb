<?php
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret_key = "123456789012345678901234567890ab"; // Ganti dengan kunci rahasia Anda

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

// Implementasi Autentikasi dengan JWT
if ($method == 'GET') { 
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401); // Unauthorized
        echo json_encode(["error" => "No Authorization header present"]);
        exit();
    }
    $authHeader = $headers['Authorization'];

    list($jwt) = sscanf($authHeader, 'Bearer %s');
    if ($jwt) {
        try {
            $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
            // Token valid - Lanjutkan
            http_response_code(200);
            echo json_encode(["message" => "Selamat datang...."]);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(["message" => "Access denied.", "error" => $e->getMessage()]);
            exit();
        }
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Access denied"]);
        exit();
    }
}else{
    http_response_code(400);
    echo json_encode(["message" => "Bad request"]);
    exit();

}

?>