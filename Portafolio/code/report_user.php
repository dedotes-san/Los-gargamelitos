<?php
session_start();
include "database.php";

$user_id = $_SESSION["user_id"];
$reported = $_GET["id"];

$conn->query("
INSERT INTO reports (reporter_id,reported_id,reason)
VALUES ($user_id,$reported,'Mal comportamiento')
");

header("Location: friends.php");
?>
