<?php
session_start();
include "database.php"; 

if (!isset($_SESSION["user_id"])) {
    header("Location: inicio.php");
    exit();
}

$user_id = intval($_SESSION["user_id"]);
$nuevo_nombre = $_POST['username'];
$archivo_foto = $_FILES['avatar'];

// 1. ACTUALIZAR NOMBRE DE USUARIO
$stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
$stmt->bind_param("si", $nuevo_nombre, $user_id);
$stmt->execute();

// 2. PROCESAR LA IMAGEN
if ($archivo_foto['error'] === 0) {
    $extension = pathinfo($archivo_foto['name'], PATHINFO_EXTENSION);
    $nombre_final = "avatar_" . $user_id . "." . $extension;
    $ruta_destino = "uploads/" . $nombre_final;

    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($archivo_foto['tmp_name'], $ruta_destino)) {
        $stmt_img = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt_img->bind_param("si", $nombre_final, $user_id);
        $stmt_img->execute();
    }
}

// REDIRECCIÓN AL DASHBOARD
header("Location: dashboard.php"); 
exit();
?>
