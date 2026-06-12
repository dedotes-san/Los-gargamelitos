<?php
// main.php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RPG Launcher - Gremio</title>
    <style>
        body, html { margin: 0; padding: 0; height: 100%; overflow: hidden; background: #000; }
        /* El iframe ocupa toda la pantalla */
        #game-content {
            width: 100%;
            height: 100%;
            border: none;
        }
        /* Reproductor oculto */
        #audio-container { display: none; }
    </style>
</head>
<body>

    <!-- MÚSICA MAESTRA: Nunca se detiene porque esta página nunca se recarga -->
    <audio id="bgMusicMaster" loop>
        <source src="sounds/battle.mp3" type="audio/mpeg">
    </audio>

    <!-- AQUÍ SE CARGAN TODAS TUS PÁGINAS (Dashboard, Amigos, etc.) -->
    <iframe src="dashboard.php" id="game-content" name="mainFrame"></iframe>

    <script>
        const masterAudio = document.getElementById('bgMusicMaster');
        masterAudio.volume = 0.5;

        // Activar música con el primer clic en cualquier parte del sitio
        document.addEventListener('click', () => {
            if (masterAudio.paused) {
                masterAudio.play();
            }
        }, { once: false });

        // Si quieres cambiar el volumen desde el interior del iframe (configuración)
        window.addEventListener('message', function(event) {
            if (event.data.type === 'setVolume') {
                masterAudio.volume = event.data.volume;
            }
        });
    </script>
</body>
</html>
