<?php
session_start();
include "database.php";
if(isset($_POST['volume']) && isset($_SESSION['user_id'])) {
    $vol = floatval($_POST['volume']);
    $stmt = $conn->prepare("UPDATE users SET vol_master = ? WHERE id = ?");
    $stmt->bind_param("di", $vol, $_SESSION['user_id']);
    $stmt->execute();
}
?>
