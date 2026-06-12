<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) exit();

$user_id = $_SESSION["user_id"];

// Buscamos el último mensaje recibido que no haya sido notificado
// Nota: Necesitas una columna 'notificado' (TINYINT) en tu tabla de mensajes
$query = "SELECT m.mensaje, u.username, m.id 
          FROM mensajes m 
          JOIN users u ON m.id_emisor = u.id 
          WHERE m.id_receptor = $user_id AND m.notificado = 0 
          ORDER BY m.fecha DESC LIMIT 1";

$result = $conn->query($query);

if ($row = $result->fetch_assoc()) {
    // Marcamos como notificado para que no vuelva a aparecer
    $conn->query("UPDATE mensajes SET notificado = 1 WHERE id = " . $row['id']);
    
    // Devolvemos los datos en formato JSON
    echo json_encode([
        'nuevo' => true,
        'usuario' => $row['username'],
        'mensaje' => $row['mensaje']
    ]);
} else {
    echo json_encode(['nuevo' => false]);
}
?>
