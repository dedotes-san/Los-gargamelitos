<?php
session_start();
include "database.php";

$me = $_SESSION["user_id"];
$friend = $_GET["id"];

$conn->query("
INSERT INTO friends (sender_id, receiver_id, status)
VALUES ($me, $friend, 'pending')
");

header("Location: friends.php");
