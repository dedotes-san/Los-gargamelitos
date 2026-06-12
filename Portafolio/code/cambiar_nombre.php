<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$error_msg = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nuevo_nombre'])) {
    $nuevo_nombre = mysqli_real_escape_string($conn, $_POST['nuevo_nombre']);

    // 1. Verificar si el nombre ya está en uso por OTRO usuario
    $check_sql = "SELECT id FROM users WHERE username = '$nuevo_nombre' AND id != $user_id";
    $res_check = $conn->query($check_sql);

    if ($res_check->num_rows > 0) {
        // El nombre está ocupado
        $error_msg = "EL NOMBRE '$nuevo_nombre' YA ESTÁ OCUPADO POR OTRO GUERRERO.";
    } else {
        // 2. Si está libre, proceder con el UPDATE
        $update_sql = "UPDATE users SET username = '$nuevo_nombre' WHERE id = $user_id";
        
        if ($conn->query($update_sql)) {
            $success_msg = "NOMBRE ACTUALIZADO CON ÉXITO.";
            
            // 3. Registrar el LOGRO "Renacido" automáticamente
            $logro_sql = "INSERT IGNORE INTO achievements (user_id, title, unlocked_at) 
                         VALUES ($user_id, 'Renacido', NOW())";
            $conn->query($logro_sql);
            
            // Actualizar la sesión para que el saludo cambie de inmediato
            $_SESSION["username"] = $nuevo_nombre;
        } else {
            $error_msg = "ERROR CRÍTICO EN EL SISTEMA.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        :root { --neon: #ff0000; --glow: 0 0 15px rgba(255, 0, 0, 0.7); }
        body { background: #050505; color: white; font-family: sans-serif; text-align: center; padding: 50px; }
        
        .form-container {
            background: #121212;
            border: 1px solid #333;
            padding: 30px;
            display: inline-block;
            border-radius: 10px;
        }

        input[type="text"] {
            background: #000;
            border: 1px solid var(--neon);
            color: white;
            padding: 10px;
            box-shadow: var(--glow);
            outline: none;
        }

        /* Mensaje de Error (Ocupado) */
        .alert-error {
            color: var(--neon);
            text-shadow: var(--glow);
            border: 1px solid var(--neon);
            padding: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .btn-update {
            background: transparent;
            color: var(--neon);
            border: 1px solid var(--neon);
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-update:hover {
            background: var(--neon);
            color: white;
            box-shadow: var(--glow);
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>CAMBIAR NOMBRE DE AVENTURERO</h2>

        <?php if ($error_msg): ?>
            <div class="alert-error">⚠️ <?php echo $error_msg; ?></div>
        <?php endif; ?>

        <?php if ($success_msg): ?>
            <div class="alert-success" style="color: #00ff00; margin-bottom: 20px;">
                ✓ <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nuevo_nombre" placeholder="Nuevo nombre..." required>
            <br><br>
            <button type="submit" class="btn-update">ACTUALIZAR IDENTIDAD</button>
        </form>
        
        <br>
        <a href="dashboard.php" style="color: #555; text-decoration: none;">[ CANCELAR ]</a>
    </div>
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
