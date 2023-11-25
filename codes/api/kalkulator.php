<?php
header("Content-Type: application/json");

// Fungsi untuk operasi matematika
function calculate($num1, $num2, $operation) {
    switch ($operation) {
        case 'tambah':
            return $num1 + $num2;
        case 'kurang':
            return $num1 - $num2;
        case 'kali':
            return $num1 * $num2;
        case 'bagi':
            return $num2 != 0 ? $num1 / $num2 : "Error: Division by zero";
        default:
            return "Invalid operation";
    }
}

// Mendapatkan input dari request JSON
$input = json_decode(file_get_contents('php://input'), true);
$num1 = $input['num1'];
$num2 = $input['num2'];
$operation = $input['operasi'];

// Menghitung dan mengirimkan respons
$result = calculate($num1, $num2, $operation);
echo json_encode(["result" => $result]);
?>