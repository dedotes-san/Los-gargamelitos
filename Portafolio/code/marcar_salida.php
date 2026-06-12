<?php
session_start();
include "database.php";
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $viejo = date("Y-m-d H:i:s", strtotime("-5 minutes")); // Retrocede el tiempo
    
    $stmt = $conn->prepare("UPDATE users SET last_seen = ? WHERE id = ?");
    $stmt->bind_param("si", $viejo, $user_id);
    $stmt->execute();
}
?>
