<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"]) || !isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$user_id = intval($_SESSION["user_id"]);
$game_id = intval($_GET["id"]);

// Verificar si ya es favorito mediante consultas preparadas
$stmt = $conn->prepare("SELECT * FROM favorites WHERE user_id = ? AND game_id = ?");
$stmt->bind_param("ii", $user_id, $game_id);
$stmt->execute();
$check = $stmt->get_result();

if ($check->num_rows > 0) {
    // Si ya existe → eliminar
    $del = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND game_id = ?");
    $del->bind_param("ii", $user_id, $game_id);
    $del->execute();
} else {
    // Insertar favorito
    $ins = $conn->prepare("INSERT INTO favorites (user_id, game_id) VALUES (?, ?)");
    $ins->bind_param("ii", $user_id, $game_id);
    $ins->execute();

    // Contar favoritos actuales para el sistema de logros
    $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM favorites WHERE user_id = ?");
    $countStmt->bind_param("i", $user_id);
    $countStmt->execute();
    $totalFavorites = $countStmt->get_result()->fetch_assoc()["total"];

    // Verificar logros
    if ($totalFavorites == 1) {
        $ach = $conn->prepare("INSERT INTO achievements (user_id, title) VALUES (?, 'Primer Favorito')");
        $ach->bind_param("i", $user_id); $ach->execute();
    }
    if ($totalFavorites == 5) {
        $ach = $conn->prepare("INSERT INTO achievements (user_id, title) VALUES (?, 'Coleccionista (5 Juegos)')");
        $ach->bind_param("i", $user_id); $ach->execute();
    }
    if ($totalFavorites == 10) {
        $ach = $conn->prepare("INSERT INTO achievements (user_id, title) VALUES (?, 'Maestro RPG (10 Juegos)')");
        $ach->bind_param("i", $user_id); $ach->execute();
    }

    // ===== SISTEMA DE EXP =====
    $userStmt = $conn->prepare("SELECT level, xp FROM users WHERE id = ?");
    $userStmt->bind_param("i", $user_id);
    $userStmt->execute();
    $userData = $userStmt->get_result()->fetch_assoc();

    $currentLevel = $userData["level"];
    $currentXP = $userData["xp"];
    $currentXP += 20; // Sumar 20 de XP

    if ($currentXP >= 100) {
        $currentLevel += 1;
        $currentXP -= 100;
    }

    $upd = $conn->prepare("UPDATE users SET level = ?, xp = ? WHERE id = ?");
    $upd->bind_param("iii", $currentLevel, $currentXP, $user_id);
    $upd->execute();
}

// Retornamos un estado exitoso para que el fetch de JS sepa que terminó correctamente
echo "OK";
exit();
?>
