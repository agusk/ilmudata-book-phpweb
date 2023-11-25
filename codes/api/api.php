<?php
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        // Menampilkan data buku (contoh sederhana)
        echo json_encode(["message" => "Menampilkan data buku"]);
        break;

    case 'POST':
        // Menambahkan data buku
        echo json_encode(["message" => "Buku baru ditambahkan", "data" => $data]);
        break;

    case 'PUT':
        // Memperbarui data buku
        echo json_encode(["message" => "Data buku diperbarui", "data" => $data]);
        break;

    case 'DELETE':
        // Menghapus data buku
        echo json_encode(["message" => "Data buku dihapus"]);
        break;

    default:
        // Metode tidak dikenali
        header("HTTP/1.1 405 Method Not Allowed");
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>