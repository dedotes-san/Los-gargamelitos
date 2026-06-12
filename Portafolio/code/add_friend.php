<?php
session_start();
include "database.php";

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $my_id = intval($_SESSION['user_id']);
    $friend_id = intval($_GET['id']);

    // 1. Evitar añadirse a uno mismo
    if ($my_id !== $friend_id) {
        
        // 2. Verificar si YA son amigos (usando sender_id y receiver_id)
        $check = $conn->query("SELECT * FROM friends 
                               WHERE (sender_id = $my_id AND receiver_id = $friend_id) 
                               OR (sender_id = $friend_id AND receiver_id = $my_id)");
        
        if ($check->num_rows == 0) {
            // 3. Insertar la nueva amistad con estado 'accepted'
            $sql = "INSERT INTO friends (sender_id, receiver_id, status) 
                    VALUES ($my_id, $friend_id, 'accepted')";
            
            if ($conn->query($sql)) {
                // Éxito
                header("Location: friends.php?msg=success");
            } else {
                // Error de SQL
                echo "Error al añadir: " . $conn->error;
            }
        } else {
            // Ya eran amigos
            header("Location: friends.php?msg=already_friends");
        }
    } else {
        header("Location: friends.php");
    }
} else {
    echo "Faltan datos para procesar la solicitud.";
}
?>
