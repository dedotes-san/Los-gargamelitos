<?php
session_start();
include "database.php";

if(!isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$friend_id = $_GET["id"];

/* aceptar solicitud */
$conn->query("
UPDATE friends 
SET status='accepted' 
WHERE sender_id = $friend_id 
AND receiver_id = $user_id
");

header("Location: friends.php");
exit();
