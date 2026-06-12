<?php
session_start();
include "database.php";

if(isset($_GET['user']) && isset($_SESSION['user_id'])) {
    $my_id = intval($_SESSION['user_id']);
    $friend_id = intval($_GET['user']);

    // Intentamos actualizar la relación sin importar quién la inició
    // Cambiamos 'blocked' a 'accepted' y LIMPIAMOS el blocker_id
    $sql = "UPDATE friends 
            SET status = 'accepted', blocker_id = NULL 
            WHERE (sender_id = $my_id AND receiver_id = $friend_id) 
               OR (sender_id = $friend_id AND receiver_id = $my_id)";
    
    if($conn->query($sql)) {
        // Si se actualizó correctamente, volvemos al chat
        header("Location: c.php?user=$friend_id&success=unblocked");
    } else {
        // Si hay un error de SQL, lo mostramos
        echo "Error en la base de datos: " . $conn->error;
    }
} else {
    header("Location: friends.php");
}
exit();
?>
