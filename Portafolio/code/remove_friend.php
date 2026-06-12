<?php
session_start();
include "database.php";

$user_id = $_SESSION["user_id"];
$friend_id = $_GET["id"];

$conn->query("
DELETE FROM friends
WHERE (user1=$user_id AND user2=$friend_id)
OR (user1=$friend_id AND user2=$user_id)
");

header("Location: friends.php");
?>
