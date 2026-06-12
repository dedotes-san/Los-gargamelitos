<?php
session_start();
include "database.php";
include "filtro.php";

if (!isset($_SESSION["user_id"])) { header("Location: inicio.php"); exit(); }

$user_id = $_SESSION["user_id"];
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nueva_pass = $_POST['nueva_pass'];
    $check = validarSeguridad($nueva_pass, true);

    if ($check !== "OK") {
        $msg = "<div class='alert-error'>⚠️ $check</div>";
    } else {
        $hash = password_hash($nueva_pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $hash, $user_id);
        if ($stmt->execute()) {
            $msg = "<div style='color:#00ff00;'>✓ CLAVE ACTUALIZADA CON ÉXITO.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seguridad del Reino</title>
    <style>
        :root { --neon: #ff0000; --glow: 0 0 15px rgba(255, 0, 0, 0.7); }
        body { background: #050505; color: white; font-family: sans-serif; text-align: center; padding: 50px; }
        .form-container { background: #121212; border: 1px solid var(--neon); padding: 30px; display: inline-block; border-radius: 15px; box-shadow: var(--glow); }
        .input-container { position: relative; margin: 15px 0; }
        input { background: #000; border: 1px solid var(--neon); color: white; padding: 12px; width: 250px; outline: none; box-shadow: var(--glow); }
        .btn-ver { position: absolute; right: 10px; top: 10px; background: none; border: none; color: var(--neon); cursor: pointer; }
        .btn-update { background: transparent; color: var(--neon); border: 1px solid var(--neon); padding: 10px 20px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        .btn-update:hover { background: var(--neon); color: white; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>SEGURIDAD DE LA CUENTA</h2>
        <?php echo $msg; ?>
        <form method="POST">
            <div class="input-container">
                <input type="password" name="nueva_pass" id="pass2" placeholder="Nueva Contraseña..." required>
                <button type="button" class="btn-ver" onclick="togglePass('pass2')">👁️</button>
            </div>
            <p style="color:#555; font-size:11px;">⚠️ La nueva clave debe ser diferente y segura.</p>
            <button type="submit" class="btn-update">REFORZAR SEGURIDAD</button>
        </form>
        <br><a href="dashboard.php" style="color:#555; text-decoration:none;">[ VOLVER ]</a>
    </div>
    <script>
        function togglePass(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
    <iframe src="player.php" id="playerFrame" style="display:none;"></iframe>
<script>
    // 1. Cambio entre pestañas
    function showTab(tabId, element) {
        document.querySelectorAll('.content-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        element.classList.add('active');
    }

    // 2. Inicialización del Sistema de Audio
    if (!window.audioMaster) {
        // Usamos una ruta relativa al nexo del proyecto
        window.audioMaster = new Audio('sounds/battle.mp3');
        window.audioMaster.loop = true;

        window.audioMaster.addEventListener('error', function() {
            console.error("❌ ERROR 404: El archivo 'sounds/battle.mp3' no existe.");
            console.log("Ruta intentada: " + window.audioMaster.src);
        });

        window.audioMaster.addEventListener('canplaythrough', function() {
            console.log("✅ Sistema de audio listo.");
        });
    }

    // 3. Controladores de la Interfaz
    const volRange = document.getElementById('volRange');
    const volPerc = document.getElementById('volPerc');

    // Cargar volumen inicial desde la base de datos
    window.addEventListener('load', () => {
        const volInicial = <?php echo $user['vol_master']; ?>;
        window.audioMaster.volume = volInicial;
    });

    volRange.addEventListener('input', (e) => {
        const val = e.target.value;
        volPerc.innerText = Math.round(val * 100) + "%";
        
        if (window.audioMaster) {
            window.audioMaster.volume = val;
            
            // Intentar reproducir si está pausado (por bloqueo del navegador)
            if (window.audioMaster.paused) {
                window.audioMaster.play().catch(err => {
                    console.log("Esperando clic del usuario...");
                });
            }
        }
    });

    // 4. Guardado en Base de Datos (AJAX)
    function saveAudioSettings() {
        const vol = volRange.value;
        fetch('update_audio.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'volume=' + vol
        })
        .then(res => res.text())
        .then(data => {
            alert("¡Sincronización de audio completada!");
        })
        .catch(err => console.error("Error al guardar:", err));
    }
</script>
</body>
</html>
