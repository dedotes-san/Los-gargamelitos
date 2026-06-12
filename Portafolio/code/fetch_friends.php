<?php
session_start();
include "database.php";

// Sincronización de tiempo
date_default_timezone_set('America/Mexico_City');
$conn->query("SET time_zone = '" . date('P') . "';");

$user_id = intval($_SESSION["user_id"]);

// Tu función de tiempo (asegúrate de que esté disponible aquí)
function tiempoTranscurrido($fecha) {
    if(empty($fecha) || $fecha == "0000-00-00 00:00:00") return "HACE TIEMPO";
    $fecha_registro = strtotime($fecha);
    $diferencia = time() - $fecha_registro;

    if ($diferencia < 60) return "DISPONIBLE";
    if ($diferencia < 3600) return "HACE " . round($diferencia / 60) . " MIN";
    if (date('Y-m-d', $fecha_registro) == date('Y-m-d')) return "HACE " . round($diferencia / 3600) . " HORAS";
    if (date('Y-m-d', $fecha_registro) == date('Y-m-d', strtotime('yesterday'))) return "AYER A LAS " . date('g:i A', $fecha_registro);
    return "EL " . date('d/m/Y', $fecha_registro);
}

// Consulta con TIMESTAMPDIFF para precisión total
$sql = "SELECT u.id, u.username, u.profile_pic, u.last_seen, 
               (TIMESTAMPDIFF(SECOND, u.last_seen, NOW())) as segundos_dif 
        FROM users u 
        JOIN friends f ON (u.id = f.sender_id OR u.id = f.receiver_id)
        WHERE (f.sender_id = $user_id OR f.receiver_id = $user_id) 
        AND u.id != $user_id AND f.status = 'accepted'
        GROUP BY u.id";

$res = $conn->query($sql);

if($res && $res->num_rows > 0) {
    while($f = $res->fetch_assoc()) {
        $is_online = ($f['segundos_dif'] !== null && $f['segundos_dif'] <= 90);
        $tiempo_texto = tiempoTranscurrido($f['last_seen']);
        ?>
        <div class="card">
            <div style="display:flex; align-items:center; gap:15px;">
                <img src="uploads/<?php echo $f['profile_pic'] ?: 'default.png'; ?>" 
                     style="width:60px; height:60px; border:2px solid #c5a059; object-fit: cover;">
                <div>
                    <b style="display:block; font-size:20px; color:#fff;"><?php echo htmlspecialchars($f['username']); ?></b>
                    <small style="color: <?php echo $is_online ? '#00ff00' : '#ccc'; ?>; font-weight:bold;">
                        ● <?php echo $is_online ? 'EN LINEA' : strtoupper($tiempo_texto); ?>
                    </small>
                </div>
            </div>
            <a href="c.php?user=<?php echo $f['id']; ?>" class="btn-msg">ENVIAR CUERVO</a>
        </div>
        <?php
    }
} else {
    echo "<p style='color:#888; text-align:center;'>Tu libro está vacío de aliados.</p>";
}
?>
