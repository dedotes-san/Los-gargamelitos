<?php
include "database.php";

if(isset($_GET["user"])) {
    $friend_id = intval($_GET["user"]);
    
    // Dejamos que MySQL calcule si la diferencia es menor a 50 segundos
    $stmt = $conn->prepare("SELECT (last_seen > NOW() - INTERVAL 50 SECOND) as is_online FROM users WHERE id = ?");
    $stmt->bind_param("i", $friend_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res && $res['is_online'] == 1) {
        echo '<span style="color:#00ff00;">● EN LINEA</span>';
    } else {
        echo '<span style="color:#ff4444;">DESCONECTADO</span>';
    }
}
?>
