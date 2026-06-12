<?php
session_start();
include "database.php";

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET["id"])){
    die("Juego no encontrado");
}

$user_id = $_SESSION["user_id"];
$game_id = intval($_GET["id"]);

$conn->query("UPDATE users SET xp = xp + 1 WHERE id = $user_id");

$result = $conn->query("SELECT url FROM games WHERE id = $game_id");

if($result->num_rows > 0){
    $game = $result->fetch_assoc();
    header("Location: ".$game["url"]);
    exit();
}else{
    echo "Juego no encontrado";
}
?>
