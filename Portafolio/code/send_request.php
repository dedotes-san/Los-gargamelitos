<?php

session_start();
include "database.php";

$sender = $_SESSION["user_id"];
$receiver = $_GET["id"];

$conn->query("
INSERT INTO friend_requests (sender_id,receiver_id)
VALUES ($sender,$receiver)
");

header("Location: friends.php");

?>
