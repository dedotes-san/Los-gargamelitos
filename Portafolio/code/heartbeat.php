<?php
session_start();
include "database.php";

if (isset($_SESSION["user_id"])) {
    $uid = intval($_SESSION["user_id"]);
    // Actualizamos la fecha y hora exacta de este momento
    $conn->query("UPDATE users SET last_activity = NOW() WHERE id = $uid");
    echo "pulsado";
}
?>
