<?php
session_start();
include "database.php";

if(isset($_SESSION["user_id"])) {
    $uid = intval($_SESSION["user_id"]);
    // Actualiza la última vez visto con la hora exacta del servidor
    $conn->query("UPDATE users SET last_seen = NOW() WHERE id = $uid");
}
?>
