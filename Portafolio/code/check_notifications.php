<?php
// Desactivamos errores visuales para que no rompan el JSON
error_reporting(0);
ini_set('display_errors', 0);

session_start();
header('Content-Type: application/json');

include "database.php";

if (!isset($_SESSION["user_id"])) {
    echo json_encode(['nuevo' => false]);
    exit();
}

$user_id = intval($_SESSION["user_id"]);

// --- CAMBIO CLAVE AQUÍ ---
// Usamos "messages" que es el nombre real en tu base de datos
$query = "SELECT m.id, m.message, u.username 
          FROM messages m 
          JOIN users u ON m.sender_id = u.id 
          WHERE m.receiver_id = $user_id AND m.status = 0 
          ORDER BY m.sent_at DESC LIMIT 1";

$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    $id_msg = $row['id'];
    
    // Marcamos como leído/notificado para que el cuadrito no se repita
    $conn->query("UPDATE messages SET status = 1 WHERE id = $id_msg");
    
    echo json_encode([
        'nuevo' => true,
        'usuario' => $row['username'],
        'mensaje' => $row['message']
    ]);
} else {
    echo json_encode(['nuevo' => false]);
}
exit();
?>
