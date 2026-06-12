<?php
session_start();
include "database.php";

if(!isset($_SESSION["user_id"])){
    exit();
}

$user_id = $_SESSION["user_id"];

$result = $conn->query("SELECT level, xp FROM users WHERE id=$user_id");
$data = $result->fetch_assoc();

echo json_encode($data);
?>
