<?php
      include 'koneksi.php';
      header("Content-Type: application/json");
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

      $method = $_SERVER['REQUEST_METHOD'];

      switch ($method) {
         case 'GET':
            $id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
            get_pegawai($id);
            break;
         case 'POST':
            add_pegawai();
            break;
         case 'PUT':
            $id = intval($_GET["id"]);
            update_pegawai($id);
            break;
         case 'DELETE':
            $id = intval($_GET["id"]);
            delete_pegawai($id);
            break;
         default:
            echo json_encode(["message" => "Request method not allowed"]);
            break;
      }

      function get_pegawai($id = 0) {
         global $conn;
         $pegawai = array();
         if ($id != 0) {
            $stmt = $conn->prepare("SELECT * FROM pegawai WHERE id = ?");
            $stmt->bind_param("i", $id);
         } else {
            $stmt = $conn->prepare("SELECT * FROM pegawai");
         }
         $stmt->execute();
         $result = $stmt->get_result();
         while ($row = $result->fetch_assoc()) {
            $pegawai[] = $row;
         }
         echo json_encode($pegawai);
         $stmt->close();
      }

      function add_pegawai() {
         global $conn;
         $data = json_decode(file_get_contents("php://input"), true);
         $nama = $data["nama"];
         $jabatan = $data["jabatan"];
         $email = $data["email"];

         $stmt = $conn->prepare("INSERT INTO pegawai (nama, jabatan, email) VALUES (?, ?, ?)");
         $stmt->bind_param("sss", $nama, $jabatan, $email);
         if ($stmt->execute()) {
            echo json_encode(["message" => "Pegawai berhasil ditambahkan"]);
         } else {
            echo json_encode(["message" => "Error saat menambahkan pegawai"]);
         }
         $stmt->close();
      }

      function update_pegawai($id) {
         global $conn;
         $data = json_decode(file_get_contents("php://input"), true);
         $nama = $data["nama"];
         $jabatan = $data["jabatan"];
         $email = $data["email"];

         $stmt = $conn->prepare("UPDATE pegawai SET nama=?, jabatan=?, email=? WHERE id=?");
         $stmt->bind_param("sssi", $nama, $jabatan, $email, $id);
         if ($stmt->execute()) {
            echo json_encode(["message" => "Pegawai berhasil diupdate"]);
         } else {
            echo json_encode(["message" => "Error saat mengupdate pegawai"]);
         }
         $stmt->close();
      }

      function delete_pegawai($id) {
         global $conn;
         $stmt = $conn->prepare("DELETE FROM pegawai WHERE id=?");
         $stmt->bind_param("i", $id);
         if ($stmt->execute()) {
            echo json_encode(["message" => "Pegawai berhasil dihapus"]);
         } else {
            echo json_encode(["message" => "Error saat menghapus pegawai"]);
         }
         $stmt->close();
      }

      $conn->close();
      ?>