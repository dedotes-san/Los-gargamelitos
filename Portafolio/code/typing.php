<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    exit();
}

$user_id = $_SESSION["user_id"];

/* Validar friend_id */

if (!isset($_POST["friend_id"])) {
    exit();
}

$friend_id = intval($_POST["friend_id"]);

/* Actualizar typing */

$stmt = $conn->prepare("
UPDATE users 
SET typing_to = ? 
WHERE id = ?
");

$stmt->bind_param("ii", $friend_id, $user_id);
$stmt->execute();
?>
