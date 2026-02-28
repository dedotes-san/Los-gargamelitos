<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$game_id = $_GET["id"];

// Agregar XP
$conn->query("UPDATE users SET xp = xp + 10 WHERE id = $user_id");

// Verificar si sube nivel
$user = $conn->query("SELECT xp, level FROM users WHERE id = $user_id")->fetch_assoc();

if ($user["xp"] >= 100) {
    $conn->query("UPDATE users SET level = level + 1, xp = 0 WHERE id = $user_id");
}

echo "<h2>Jugaste y ganaste 10 XP 🎮</h2>";
echo "<a href='dashboard.php'>Volver</a>";
?>