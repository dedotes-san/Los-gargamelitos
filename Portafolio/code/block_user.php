<?php
session_start();
include "database.php"; // Tu conexión

if(isset($_GET['user']) && isset($_SESSION['user_id'])) {
    $my_id = intval($_SESSION['user_id']);
    $friend_id = intval($_GET['user']);

    // Evitar bloquearse a uno mismo
    if($my_id !== $friend_id) {
        
        // Verificamos si ya existe una relación de bloqueo o amistad
        $check = $conn->query("SELECT * FROM friends 
                               WHERE (sender_id = $my_id AND receiver_id = $friend_id) 
                               OR (sender_id = $friend_id AND receiver_id = $my_id)");
        
        if($check->num_rows > 0) {
            $friend_row = $check->fetch_assoc();
            $relation_id = $friend_row['id'];
            
            // Actualizamos el estado a 'blocked' y registramos QUIÉN bloqueó
            $sql = "UPDATE friends SET status = 'blocked', blocker_id = $my_id 
                    WHERE id = $relation_id";
            
            if($conn->query($sql)) {
                // REDIRIGIMOS de vuelta al chat, no mostramos "ok"
                header("Location: c.php?user=$friend_id&status=bloqueado");
                exit();
            } else {
                echo "Error SQL: " . $conn->error;
            }
        }
    }
}
header("Location: c.php"); // Por si acaso
?>
