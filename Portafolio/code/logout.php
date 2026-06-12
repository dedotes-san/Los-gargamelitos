<?php
session_start();
include "database.php";

if(isset($_SESSION["user_id"])) {
    $uid = intval($_SESSION["user_id"]);
    // Seteamos una fecha vieja para forzar el estado desconectado
    $conn->query("UPDATE users SET last_seen = '2000-01-01 00:00:00' WHERE id = $uid");
}

session_destroy();
header("Location: inicio.php");
exit();
