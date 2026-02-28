<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$game_id = $_GET["id"];

// Verificar si ya es favorito
$check = $conn->query("SELECT * FROM favorites WHERE user_id=$user_id AND game_id=$game_id");

if ($check->num_rows > 0) {

    // Si ya existe → eliminar
    $conn->query("DELETE FROM favorites WHERE user_id=$user_id AND game_id=$game_id");

} else {

    // Insertar favorito
    $conn->query("INSERT INTO favorites (user_id, game_id) VALUES ($user_id, $game_id)");

    // Contar favoritos actuales
    $countResult = $conn->query("SELECT COUNT(*) as total FROM favorites WHERE user_id=$user_id");
    $countRow = $countResult->fetch_assoc();
    $totalFavorites = $countRow["total"];

    // Verificar logros
    if ($totalFavorites == 1) {
        $conn->query("INSERT INTO achievements (user_id, title) VALUES ($user_id, 'Primer Favorito')");
    }

    if ($totalFavorites == 5) {
        $conn->query("INSERT INTO achievements (user_id, title) VALUES ($user_id, 'Coleccionista (5 Juegos)')");
    }

    if ($totalFavorites == 10) {
        $conn->query("INSERT INTO achievements (user_id, title) VALUES ($user_id, 'Maestro RPG (10 Juegos)')");
    }
    // ===== SISTEMA DE XP =====

// Obtener datos actuales
$userData = $conn->query("SELECT level, xp FROM users WHERE id=$user_id")->fetch_assoc();

$currentLevel = $userData["level"];
$currentXP = $userData["xp"];

// Sumar XP (20 por favorito)
$currentXP += 20;

// Verificar si sube de nivel
if ($currentXP >= 100) {
    $currentLevel += 1;
    $currentXP -= 100;
}

// Actualizar usuario
$conn->query("UPDATE users SET level=$currentLevel, xp=$currentXP WHERE id=$user_id");
}

header("Location: dashboard.php");
exit();
?>