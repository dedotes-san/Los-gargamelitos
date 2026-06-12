<?php
session_start();
include "database.php"; // Ajusta la ruta si está en una carpeta api/

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    // Actualiza la última vez que se vio al usuario
    $conn->query("UPDATE users SET last_seen = NOW() WHERE id = $user_id");
}
?>
