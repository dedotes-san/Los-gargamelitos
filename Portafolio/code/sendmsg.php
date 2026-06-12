<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    exit("No session");
}

$my_id = intval($_SESSION["user_id"]);
$friend_id = intval($_POST["friend_id"] ?? 0);
$message = trim($_POST["message"] ?? "");

// Verificar datos mínimos
if (!$friend_id) {
    exit("Datos incompletos");
}

// 🔒 VERIFICAR BLOQUEO
$sql_check = "SELECT status FROM friends 
              WHERE (sender_id = ? AND receiver_id = ?) 
              OR (sender_id = ? AND receiver_id = ?)";

$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("iiii", $my_id, $friend_id, $friend_id, $my_id);
$stmt_check->execute();
$res_check = $stmt_check->get_result();
$relation = $res_check->fetch_assoc();

if (isset($relation['status']) && $relation['status'] == 'blocked') {
    exit("blocked");
}

// 📎 MANEJO DE ARCHIVOS
$file_name = null;
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
    $upload_dir = "uploads/messages/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    $new_name = uniqid("file_") . "." . $file_ext;
    move_uploaded_file($file_tmp, $upload_dir . $new_name);
    $file_name = $new_name;
}

// 💬 INSERTAR MENSAJE (Ajustado para el Radar)
// Cambiamos 'sent' por 0 en la columna status
$sql = "INSERT INTO messages (sender_id, receiver_id, message, file, status, created_at) 
        VALUES (?, ?, ?, ?, 0, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss",
    $my_id,
    $friend_id,
    $message,
    $file_name
);

if ($stmt->execute()) {
    echo "ok";
} else {
    echo "error";
}
?>
