<?php
session_start();
include "database.php";

// Sincronizar también aquí
date_default_timezone_set('America/Mexico_City');
$conn->query("SET time_zone = '" . date('P') . "';");

if(isset($_SESSION["user_id"])) {
    $user_id = intval($_SESSION["user_id"]);
    // Actualizamos usando la hora del servidor de DB
    $stmt = $conn->prepare("UPDATE users SET last_seen = NOW() WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    echo "Conexión estable";
}
?>
