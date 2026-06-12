<?php
session_start();

// Reportar errores para diagnóstico
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "database.php"; 

if(!isset($_SESSION["user_id"])) { 
    header("Location: inicio.php"); 
    exit(); 
}

$user_id = intval($_SESSION["user_id"]);

// Sincronización de tiempo con la base de datos
$conn->query("SET time_zone = '" . date('P') . "';");

// --- FUNCIÓN DE TIEMPO MEJORADA ---
function tiempoTranscurrido($fecha) {
    if(empty($fecha) || $fecha == "0000-00-00 00:00:00") return "HACE TIEMPO";
    
    $fecha_registro = strtotime($fecha);
    $ahora = time();
    $diferencia = $ahora - $fecha_registro;

    if ($diferencia < 60) return "DISPONIBLE";

    if ($diferencia < 3600) {
        $mins = round($diferencia / 60);
        return "HACE $mins MIN" . ($mins > 1 ? "S" : "");
    }

    if (date('Y-m-d', $fecha_registro) == date('Y-m-d')) {
        $horas = round($diferencia / 3600);
        return "HACE $horas HORA" . ($horas > 1 ? "S" : "");
    }

    if (date('Y-m-d', $fecha_registro) == date('Y-m-d', strtotime('yesterday'))) {
        return "AYER A LAS " . date('g:i A', $fecha_registro);
    }

    return "EL " . date('d/m/Y', $fecha_registro);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libro de Alianzas - RPG</title>
    <style>
        :root {
            --rpg-gold: #c5a059;
            --rpg-red: #8b0000;
            --rpg-brown: #3e2723;
            --parchment: #fdf5e6;
            --stone-dark: rgba(10, 10, 10, 0.95);
        }

        body { 
            background: url('images/libro_alianzas_bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #f0e68c;
            font-family: 'Crimson Text', 'Georgia', serif; 
            margin: 0;
            padding: 20px;
        }

        .container { 
            max-width: 800px; 
            margin: auto; 
            background: var(--stone-dark);
            padding: 30px;
            border-radius: 8px;
            border: 3px solid #4a3b2a;
            box-shadow: 0 0 30px rgba(0,0,0,0.9);
            backdrop-filter: blur(5px);
        }

        .header { 
            border-bottom: 2px solid var(--rpg-gold); 
            padding-bottom: 15px; 
            margin-bottom: 25px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .header h2 {
            font-variant: small-caps;
            letter-spacing: 2px;
            color: var(--rpg-gold);
            text-shadow: 2px 2px 4px #000;
            margin: 0;
        }

        .search-box input { 
            width: 100%; 
            background: var(--parchment);
            border: 2px solid #634d32; 
            padding: 12px; 
            color: #2a1b0a; 
            border-radius: 4px; 
            outline: none;
            font-weight: bold;
            box-sizing: border-box;
        }

        .card { 
            background: rgba(40, 30, 20, 0.6);
            border: 1px solid #4a3b2a; 
            padding: 15px; 
            border-radius: 4px; 
            margin-bottom: 15px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            transition: 0.3s;
        }

        .card:hover { background: rgba(60, 45, 30, 0.8); border-color: var(--rpg-gold); }

        .btn-msg { 
            background: var(--rpg-red); 
            color: white; 
            padding: 10px 20px; 
            border-radius: 3px; 
            text-decoration: none; 
            font-weight: bold; 
            font-size: 12px;
            border: 1px solid #ff4444;
            text-transform: uppercase;
        }

        .history-tag {
            background: #2a1b0a;
            color: var(--rpg-gold);
            padding: 5px 10px;
            margin: 4px;
            display: inline-block;
            border: 1px solid var(--rpg-gold);
            border-radius: 3px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📜 Libro de Alianzas</h2>
            <a href="dashboard.php" style="color:var(--rpg-gold); text-decoration:none; font-weight:bold;">VOLVER</a>
        </div>

        <h4 style="color:var(--rpg-gold); margin-bottom:10px;">Rastros Recientes:</h4>
        <div style="margin-bottom: 20px;">
            <?php
            $stmt = $conn->prepare("SELECT search_text FROM search_history WHERE user_id = ? ORDER BY search_date DESC LIMIT 5");
            $stmt->bind_param("i",$user_id);
            $stmt->execute();
            $resHistory = $stmt->get_result();
            while($h = $resHistory->fetch_assoc()){
                echo "<span class='history-tag'>🔍 ".$h["search_text"]."</span>";
            }
            ?>
        </div>
        
        <div class="search-box">
            <input type="text" id="searchFriend" placeholder="Escribe el nombre de un guerrero..." onkeyup="searchFriend()">
        </div>

        <div id="searchResults"></div>

        <h4 style="color:var(--rpg-gold); margin: 25px 0 15px 0;">Aliados Juramentados:</h4>

        <!-- ESTE ES EL CONTENEDOR QUE SE ACTUALIZA SOLO -->
        <div id="lista-amigos-ajax">
            <p style="text-align:center;">Abriendo el libro...</p>
        </div>
    </div>

    <script>
        // Función para buscar amigos manualmente
        function searchFriend(){
            let search = document.getElementById("searchFriend").value;
            if(search.length < 1) {
                document.getElementById("searchResults").innerHTML = "";
                return;
            }
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "search_friends.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function(){
                document.getElementById("searchResults").innerHTML = this.responseText;
            };
            xhr.send("search="+search);
        }

        // FUNCIÓN PARA ACTUALIZAR LA LISTA SIN RECARGAR
        function actualizarListaAmigos() {
            fetch('fetch_friends.php?t=' + new Date().getTime())
                .then(response => response.text())
                .then(html => {
                    document.getElementById('lista-amigos-ajax').innerHTML = html;
                })
                .catch(err => console.error("Error al leer el libro:", err));
        }

        // Función para mantener TU conexión activa
        function mantenerConexion() {
            fetch('update_status.php?t=' + new Date().getTime())
                .then(response => response.text())
                .then(texto => console.log("Tu rastro: " + texto))
                .catch(err => console.error("Error de conexión:", err));
        }

        // EJECUCIÓN INICIAL
        actualizarListaAmigos();
        mantenerConexion();

        // REPETICIONES AUTOMÁTICAS
        setInterval(actualizarListaAmigos, 10000); // Cada 10 segundos actualiza la lista de amigos
        setInterval(mantenerConexion, 40000);     // Cada 40 segundos avisa que tú estás conectado
    </script>
    
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
