<?php
session_start();
include "database.php"; // Tu conexión

if(isset($_GET['user']) && isset($_SESSION['user_id'])) {
    $my_id = intval($_SESSION['user_id']);
    $friend_id = intval($_GET['user']);

    // Borramos todos los mensajes entre nosotros dos
    $sql = "DELETE FROM messages 
            WHERE (sender_id = $my_id AND receiver_id = $friend_id) 
            OR (sender_id = $friend_id AND receiver_id = $my_id)";
    
    if($conn->query($sql)) {
        // Redirigimos de vuelta al chat
        header("Location: c.php?user=$friend_id&msg=vaciado");
    } else {
        echo "Error al vaciar: " . $conn->error;
    }
} else {
    header("Location: dashboard.php");
}
?>
