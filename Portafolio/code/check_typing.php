<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    exit();
}

$my_id = $_SESSION["user_id"];

/* Validar friend_id */

if (!isset($_GET["friend_id"])) {
    exit();
}

$friend_id = intval($_GET["friend_id"]);

$stmt = $conn->prepare("
SELECT typing_to 
FROM users 
WHERE id = ?
");

$stmt->bind_param("i", $friend_id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && $row["typing_to"] == $my_id) {

echo "typing";

}
?>
