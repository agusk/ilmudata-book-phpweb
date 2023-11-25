<?php
// Mendeteksi metode HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo "Hello World";
        break;

    case 'POST':
        // Menangkap data yang dikirim dan menampilkannya kembali
        $data = json_decode(file_get_contents('php://input'), true);
        echo "Data received: " . json_encode($data);
        break;

    case 'PUT':
        // Simulasi update data
        echo "Data updated";
        break;

    case 'DELETE':
        // Simulasi penghapusan data
        echo "Data deleted";
        break;

    default:
        // Metode tidak dikenali
        header("HTTP/1.1 405 Method Not Allowed");
        echo "Method not allowed";
        break;
}
?>