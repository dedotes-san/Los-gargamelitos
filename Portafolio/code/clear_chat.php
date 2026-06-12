<?php
session_start();
include "database.php";
$my_id = $_SESSION["user_id"];
$friend_id = $_GET["user"];
$conn->query("DELETE FROM messages WHERE (sender_id=$my_id AND receiver_id=$friend_id) OR (sender_id=$friend_id AND receiver_id=$my_id)");
header("Location: c.php?user=$friend_id");
?>
