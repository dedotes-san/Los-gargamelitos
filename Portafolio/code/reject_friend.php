<?php
session_start();
include "database.php";

$user_id = $_SESSION["user_id"];
$friend_id = $_GET["id"];

$conn->query("
DELETE FROM friends 
WHERE sender_id = $friend_id 
AND receiver_id = $user_id
");

header("Location: friends.php");
