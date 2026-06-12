<?php
session_start();
include "database.php"; 

// 1. FUNCIONES DE LIMPIEZA Y SEGURIDAD
function limpiarTexto($texto){
    $texto = strtolower($texto);
    $texto = preg_replace('/[^a-z0-9]/','',$texto);
    $texto = str_replace(
        ["0","1","3","4","5","7"],
        ["o","i","e","a","s","t"],
        $texto
    );
    return $texto;
}

function contieneGroseria($texto){
    $palabras = ["puta","puto","pendejo","mierda","idiota","cabron","chingar","verga","culo","fuck","shit","bitch"];
    $texto = limpiarTexto($texto);
    foreach($palabras as $p){
        if(strpos($texto, $p) !== false){
            return true;
        }
    }
    return false;
}

// VALIDACIÓN DE SESIÓN
if (!isset($_SESSION["user_id"])) {
    header("Location: inicio.php");
    exit();
}

$sql = "SELECT username, level, xp, profile_pic, mensaje_baneo 
        FROM users 
        WHERE (mensaje_baneo IS NULL OR mensaje_baneo = '') 
        ORDER BY level DESC, xp DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ranking Mundial - Khaldurun</title>
    <style>
        :root {
            --crystal-blue: #00d4ff;
            --stone-bg: rgba(15, 15, 20, 0.9);
            --gold: #e2c044;
            --glow: 0 0 15px rgba(0, 212, 255, 0.4);
        }

        body {
            /* Usando el fondo de la liga de mecánicos que tienes en tus archivos */
            background: url('images/khaldurun_league.png') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .header-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 900px;
            margin: 0 auto 30px;
            background: rgba(0,0,0,0.7);
            padding: 15px 25px;
            border-bottom: 3px solid var(--crystal-blue);
            border-radius: 8px 8px 0 0;
        }

        .btn-back {
            text-decoration: none;
            color: var(--crystal-blue);
            border: 1px solid var(--crystal-blue);
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: bold;
            transition: 0.3s;
            text-transform: uppercase;
        }

        .btn-back:hover {
            background: var(--crystal-blue);
            color: black;
            box-shadow: var(--glow);
        }

        .ranking-table {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            background: var(--stone-bg);
            border-collapse: collapse;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .ranking-table th {
            background: rgba(0, 212, 255, 0.1);
            color: var(--crystal-blue);
            padding: 15px;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid var(--crystal-blue);
        }

        .ranking-table td {
            padding: 10px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* --- AQUÍ ESTÁ EL AJUSTE QUE PEDISTE PARA LOS NOMBRES --- */
        .hero-cell {
            display: flex;
            align-items: center; /* Alinea imagen y texto al centro verticalmente */
            gap: 12px;           /* Espacio pequeño y fijo entre imagen y nombre */
        }

        .profile-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid var(--crystal-blue);
            object-fit: cover;
            flex-shrink: 0;      /* Evita que la imagen se haga chica */
        }

        .hero-name {
            font-weight: 600;
            font-size: 0.95em;   /* Un poco más pequeño para que se vea elegante */
            color: #f0f0f0;
            white-space: nowrap; /* Evita que el nombre se salte de línea */
        }

        /* Colores para el Top 1 */
        .top-1 { 
            background: rgba(226, 192, 68, 0.15) !important; 
        }
        .top-1 .hero-name { color: var(--gold); }
        .top-1 td:first-child { color: var(--gold); font-weight: bold; font-size: 1.2em; }

        tr:hover { background: rgba(255,255,255,0.05); }

        /* Botón de sonido */
        #soundToggle {
            position: fixed; top: 15px; right: 15px;
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(0,0,0,0.8); color: var(--crystal-blue);
            border: 1px solid var(--crystal-blue); cursor: pointer; z-index: 999;
        }
    </style>
</head>
<body>

    <div class="header-nav">
        <h1 style="color: var(--crystal-blue); margin: 0; font-size: 1.5em;">🏆 RANKING DE KHALDURUN</h1>
        <a href="dashboard.php" class="btn-back">🏠 VOLVER</a>
    </div>

    <table class="ranking-table">
        <thead>
            <tr>
                <th style="width: 80px;">Puesto</th>
                <th>Héroe</th>
                <th>Nivel</th>
                <th>XP</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $puesto = 1;
            while($row = $result->fetch_assoc()): 
                if (contieneGroseria($row['username'])) { continue; }
            ?>
            <tr class="<?php echo ($puesto == 1) ? 'top-1' : ''; ?>">
                <td>#<?php echo $puesto; ?></td>
                <td>
                    <div class="hero-cell">
                        <img src="uploads/<?php echo $row['profile_pic'] ?: 'default.png'; ?>" class="profile-img">
                        <span class="hero-name"><?php echo htmlspecialchars($row['username']); ?></span>
                    </div>
                </td>
                <td style="color: var(--crystal-blue); font-weight: bold;">Lvl <?php echo $row['level']; ?></td>
                <td style="color: #aaa;"><?php echo number_format($row['xp']); ?> XP</td>
            </tr>
            <?php 
            $puesto++;
            endwhile; 
            ?>
        </tbody>
    </table>

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
    
    <script src="rpg-notifications.js"></script>
</body>
</html>
