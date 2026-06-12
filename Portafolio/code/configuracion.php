<?php
session_start();
include "database.php"; 
include "filtro.php"; // <--- INYECCIÓN DEL ESCUDO SUPREMO

if(!isset($_SESSION["user_id"])) { 
    header("Location: inicio.php"); 
    exit(); 
}

$user_id = intval($_SESSION["user_id"]);

// --- LÓGICA DE ACTUALIZACIÓN DE PERFIL ---
$mensaje_status = "";
$es_error = false; // Variable de control para el estilo de las alertas

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $nuevo_nombre = trim($_POST['username']);
    
    // VALIDACIÓN DEL NOMBRE MEDIANTE EL FILTRO SUPREMO
    $check_nombre = validarSeguridad($nuevo_nombre);
    
    if ($check_nombre !== "OK") {
        $mensaje_status = $check_nombre;
        $es_error = true;
    } else {
        // Si el filtro aprueba el nombre, procedemos con la actualización original
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed)) {
                $nuevo_avatar = "avatar_" . $user_id . "_" . time() . "." . $ext;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], "uploads/" . $nuevo_avatar)) {
                    $stmt_upd = $conn->prepare("UPDATE users SET username = ?, avatar = ? WHERE id = ?");
                    $stmt_upd->bind_param("ssi", $nuevo_nombre, $nuevo_avatar, $user_id);
                }
            }
        } else {
            $stmt_upd = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
            $stmt_upd->bind_param("si", $nuevo_nombre, $user_id);
        }
        
        if (isset($stmt_upd) && $stmt_upd->execute()) { 
            $mensaje_status = "¡EXPEDIENTE ACTUALIZADO CON ÉXITO!"; 
            $es_error = false;
        }
    }
}

// Obtener datos del usuario
$stmt = $conn->prepare("SELECT username, email, avatar, created_at, level, xp, vol_master FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Cálculos de interfaz para la barra de progreso
$progress = ($user['xp'] / 100) * 100; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración Avanzada - RPG Launcher</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --magic-cyan: #00f2ff; 
            --magic-glow: 0 0 15px rgba(0, 242, 255, 0.4); 
            --dark-glass: rgba(5, 15, 20, 0.95);
            --border-light: rgba(0, 242, 255, 0.2);
            --panel-bg: rgba(0, 242, 255, 0.03);
        }

        body {
            background: url('images/configuracion.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; display: flex; justify-content: center; align-items: center;
            height: 100vh; color: #e0faff; overflow: hidden;
        }

        .main-container {
            display: flex; width: 1100px; height: 750px;
            background: var(--dark-glass); border: 1px solid var(--border-light);
            box-shadow: 0 0 50px rgba(0,0,0,0.9), var(--magic-glow);
            border-radius: 10px; overflow: hidden; backdrop-filter: blur(20px);
        }

        /* Sidebar Navegación */
        .sidebar {
            width: 260px; background: rgba(0, 0, 0, 0.7);
            border-right: 1px solid var(--border-light);
            display: flex; flex-direction: column; padding: 40px 0;
        }

        .nav-item {
            padding: 18px 30px; cursor: pointer; display: flex;
            align-items: center; gap: 15px; color: rgba(0, 242, 255, 0.4); 
            transition: 0.3s; text-transform: uppercase; font-size: 12px; 
            letter-spacing: 2px; text-decoration: none; font-weight: 700;
        }

        .nav-item:hover, .nav-item.active {
            color: var(--magic-cyan); background: rgba(0, 242, 255, 0.07);
            text-shadow: 0 0 10px var(--magic-cyan); border-left: 4px solid var(--magic-cyan);
        }

        /* Paneles de Contenido */
        .content-panel { flex: 1; padding: 45px; overflow-y: auto; display: none; scrollbar-width: thin; }
        .content-panel.active { display: block; animation: panelFade 0.5s ease-out; }

        @keyframes panelFade { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .section-title {
            color: white; text-transform: uppercase; letter-spacing: 3px;
            border-bottom: 2px solid var(--magic-cyan); padding-bottom: 12px; 
            margin-bottom: 35px; font-size: 20px; font-weight: 800;
        }

        /* Componentes de Información */
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 25px; }

        .info-card {
            background: var(--panel-bg); border: 1px solid rgba(0, 242, 255, 0.15);
            padding: 18px; border-radius: 5px; display: flex; flex-direction: column;
        }

        .info-card label { font-size: 10px; color: var(--magic-cyan); text-transform: uppercase; margin-bottom: 6px; opacity: 0.8; letter-spacing: 1px; }
        .info-card span { font-size: 15px; font-weight: 500; }

        .rpg-input {
            background: rgba(0,0,0,0.6); border: 1px solid var(--border-light);
            color: var(--magic-cyan); padding: 12px; width: 95%; border-radius: 4px;
            outline: none; transition: 0.4s; font-size: 18px;
        }
        .rpg-input:focus { border-color: var(--magic-cyan); box-shadow: var(--magic-glow); }

        /* Barra de Experiencia */
        .level-bar-container { margin-top: 15px; }
        .level-bar-mini { width: 100%; height: 8px; background: #0a0a0a; border-radius: 4px; overflow: hidden; border: 1px solid rgba(0,242,255,0.1); }
        .level-fill { height: 100%; background: linear-gradient(90deg, #0088ff, var(--magic-cyan)); box-shadow: 0 0 15px var(--magic-cyan); transition: width 1s ease-in-out; }

        /* Estatus Online */
        .status-badge { color: #00ff88; font-size: 11px; font-weight: bold; display: flex; align-items: center; gap: 6px; text-transform: uppercase; }
        .status-badge::before { content: ''; width: 8px; height: 8px; background: #00ff88; border-radius: 50%; box-shadow: 0 0 10px #00ff88; }

        /* Botones Estilizados */
        .btn-action {
            border: none; padding: 16px; font-weight: 800; cursor: pointer; 
            border-radius: 4px; transition: 0.3s; text-transform: uppercase;
            font-size: 13px; letter-spacing: 2px;
        }
        .btn-save { background: var(--magic-cyan); color: #020b10; width: 100%; box-shadow: var(--magic-glow); }
        .btn-save:hover { filter: brightness(1.2); transform: scale(1.01); }

        .custom-file-upload {
            display: inline-block; padding: 10px 20px; cursor: pointer;
            background: rgba(0,242,255,0.1); border: 1px solid var(--magic-cyan);
            font-size: 11px; border-radius: 4px; margin-top: 12px; color: white;
            transition: 0.3s; text-transform: uppercase; font-weight: bold;
        }
        .custom-file-upload:hover { background: var(--magic-cyan); color: black; }

        .setting-row { 
            display: flex; justify-content: space-between; align-items: center; 
            padding: 18px 0; border-bottom: 1px solid rgba(0, 242, 255, 0.08); 
        }

        input[type="file"] { display: none; }
    </style>
</head>
<body>

<div class="main-container">
    <div class="sidebar">
        <div class="nav-item active" onclick="showTab('cuenta', this)">
            <i class="fa-solid fa-user-gear"></i> Perfil de Guerrero
        </div>
        <div class="nav-item" onclick="showTab('sonido', this)">
            <i class="fa-solid fa-sliders"></i> Sistema de Audio
        </div>
        
        <div style="margin-top: auto;">
            <a href="dashboard.php" class="nav-item" style="color: #ffab00;">
                <i class="fa-solid fa-circle-chevron-left"></i> Volver al Nexo
            </a>
            <a href="logout.php" class="nav-item" style="color: #ff4444;">
                <i class="fa-solid fa-power-off"></i> Desconectarse
            </a>
        </div>
    </div>

    <div id="cuenta" class="content-panel active">
        <form method="POST" enctype="multipart/form-data">
            <div class="section-title">Expediente del Guerrero</div>
            
            <?php if($mensaje_status): ?>
                <?php if($es_error): ?>
                    <div style="background: rgba(255,171,0,0.1); border: 1px solid #ffab00; padding: 12px; margin-bottom: 25px; text-align: center; font-size: 13px; color: #ffab00; font-weight: bold; border-radius: 4px;">
                        <?php echo $mensaje_status; ?>
                    </div>
                <?php else: ?>
                    <div style="background: rgba(0,255,136,0.1); border: 1px solid #00ff88; padding: 12px; margin-bottom: 25px; text-align: center; font-size: 13px; color: #00ff88; font-weight: bold; border-radius: 4px;">
                        <i class="fa-solid fa-check-double"></i> <?php echo $mensaje_status; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div style="display: flex; gap: 35px; margin-bottom: 35px; align-items: flex-start;">
                <div style="text-align: center;">
                    <div style="width: 150px; height: 150px; border: 2px solid var(--magic-cyan); border-radius: 5px; padding: 6px; box-shadow: var(--magic-glow); background: #000; position: relative;">
                        <img src="uploads/<?php echo $user['avatar'] ?: 'default.png'; ?>?t=<?php echo time(); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2px;">
                    </div>
                    <label class="custom-file-upload">
                        <input type="file" name="avatar">
                        <i class="fa-solid fa-upload"></i> Cargar ADN Visual
                    </label>
                </div>

                <div style="flex: 1;">
                    <label style="font-size: 11px; color: var(--magic-cyan); text-transform: uppercase; font-weight: bold;">Identificador de Batalla</label>
                    <input type="text" name="username" class="rpg-input" value="<?php echo htmlspecialchars($user['username']); ?>" placeholder="Nombre del Guerrero..." required>
                    
                    <div style="margin: 15px 0;">
                        <div class="status-badge">Núcleo Activo / En Línea</div>
                        <p style="opacity: 0.5; font-size: 13px; margin-top: 8px;">Reclutado el: <?php echo date('d/m/Y', strtotime($user['created_at'])); ?></p>
                    </div>
                    
                    <div class="level-bar-container">
                        <div style="display: flex; justify-content: space-between; font-size: 12px; text-transform: uppercase; font-weight: bold; color: var(--magic-cyan);">
                            <span>Nivel <?php echo $user['level']; ?></span>
                            <span><?php echo $user['xp']; ?> / 100 XP</span>
                        </div>
                        <div class="level-bar-mini">
                            <div class="level-fill" style="width: <?php echo $progress; ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <label>Enlace de Red</label>
                    <span><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="info-card">
                    <label>Rango Asignado</label>
                    <span>Comandante de Interfaz</span>
                </div>
                <div class="info-card">
                    <label>Ubicación de Nodo</label>
                    <span>Servidor Regional Latam</span>
                </div>
                <div class="info-card">
                    <label>Firma Digital (UID)</label>
                    <span>#<?php echo str_pad($user_id, 6, "0", STR_PAD_LEFT); ?></span>
                </div>
            </div>

            <div class="section-title" style="margin-top: 45px; font-size: 16px;">Protocolos de Seguridad</div>
            <div class="box-info" style="background: rgba(0,0,0,0.3); border: 1px solid var(--border-light); padding: 0 20px;">
                <div class="setting-row">
                    <div>
                        <strong style="display: block;">Cifrado de Acceso</strong>
                        <span style="font-size: 11px; opacity: 0.5;">Cambia tu contraseña periódicamente para evitar brechas.</span>
                    </div>
                    <button type="button" class="btn-action" style="padding: 10px 20px; font-size: 10px; border: 1px solid var(--magic-cyan); background: transparent; color: white;">Actualizar Llave</button>
                </div>
                <div class="setting-row">
                    <div>
                        <strong style="display: block;">Visibilidad del Perfil</strong>
                        <span style="font-size: 11px; opacity: 0.5;">Permite que otros guerreros vean tus hazañas.</span>
                    </div>
                    <input type="checkbox" checked style="accent-color: var(--magic-cyan); width: 18px; height: 18px; cursor: pointer;">
                </div>
            </div>

            <button type="submit" name="update_profile" class="btn-action btn-save" style="margin-top: 35px;">
                <i class="fa-solid fa-shuttle-space"></i> Sincronizar Cambios con la Nube
            </button>
        </form>
    </div>

    <div id="sonido" class="content-panel">
        <div class="section-title">Ajustes de Audio Ambiental</div>
        
        <div class="info-card" style="padding: 40px; background: rgba(0,0,0,0.4);">
            <label style="font-size: 14px; text-align: center; display: block; margin-bottom: 20px;">Volumen Maestro de Transmisión</label>
            <input type="range" id="volRange" min="0" max="1" step="0.01" value="<?php echo $user['vol_master']; ?>" style="width: 100%; accent-color: var(--magic-cyan); cursor: pointer;">
            <div style="display: flex; justify-content: space-between; font-family: 'Courier New', monospace; margin-top: 15px; color: var(--magic-cyan);">
                <span>SILENCIO</span>
                <span id="volPerc" style="font-size: 24px; font-weight: bold;"><?php echo ($user['vol_master'] * 100); ?>%</span>
                <span>MÁXIMO</span>
            </div>
        </div>

        <div class="info-grid" style="margin-top: 30px;">
            <div class="info-card">
                <label>Efectos Especiales (SFX)</label>
                <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
                    <input type="checkbox" checked style="accent-color: var(--magic-cyan);"> <span style="font-size: 13px;">Activado</span>
                </div>
            </div>
            <div class="info-card">
                <label>Frecuencia de Voz</label>
                <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
                    <input type="checkbox" checked style="accent-color: var(--magic-cyan);"> <span style="font-size: 13px;">Activado</span>
                </div>
            </div>
        </div>

        <button onclick="saveAudioSettings()" class="btn-action btn-save" style="margin-top: 40px;">
            <i class="fa-solid fa-volume-high"></i> Guardar Configuración de Audio
        </button>
    </div>
</div>

<script>
    function showTab(tabId, element) {
        document.querySelectorAll('.content-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        element.classList.add('active');
    }

    if (!window.audioMaster) {
        window.audioMaster = new Audio('sounds/battle.mp3');
        window.audioMaster.loop = true;

        window.audioMaster.addEventListener('error', function() {
            console.error("❌ ERROR 404: El archivo 'sounds/battle.mp3' no existe.");
        });

        window.audioMaster.addEventListener('canplaythrough', function() {
            console.log("✅ Sistema de audio listo.");
        });
    }

    const volRange = document.getElementById('volRange');
    const volPerc = document.getElementById('volPerc');

    window.addEventListener('load', () => {
        const volInicial = <?php echo $user['vol_master']; ?>;
        window.audioMaster.volume = volInicial;
    });

    volRange.addEventListener('input', (e) => {
        const val = e.target.value;
        volPerc.innerText = Math.round(val * 100) + "%";
        
        if (window.audioMaster) {
            window.audioMaster.volume = val;
            if (window.audioMaster.paused) {
                window.audioMaster.play().catch(err => {
                    console.log("Esperando clic del usuario...");
                });
            }
        }
    });

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
