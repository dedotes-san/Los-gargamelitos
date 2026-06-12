<?php
include "database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($pass, $row['password']) || $pass == $row['password']) {
            session_regenerate_id();
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        } else { 
            $error = "Contraseña incorrecta"; 
        }
    } else { 
        $error = "El correo no está registrado"; 
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrar al Reino</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --cyan-glow: #00d4ff;
            --glass-bg: rgba(15, 25, 35, 0.85);
        }

        body {
            margin: 0; padding: 0; height: 100vh;
            background: url('images/ini (2).png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            display: flex; justify-content: center; align-items: center;
            overflow: hidden;
        }

        .login-card {
            width: 420px;
            background: var(--glass-bg);
            padding: 40px;
            border-radius: 30px;
            border: 1.5px solid rgba(0, 212, 255, 0.4);
            text-align: center;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
        }

        .top-icon {
            font-size: 40px;
            color: white;
            margin-bottom: 10px;
            filter: drop-shadow(0 0 10px var(--cyan-glow));
        }

        h2 {
            color: white;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 15px var(--cyan-glow);
            margin-bottom: 25px;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .input-group .toggle-pass {
            left: auto;
            right: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .input-group .toggle-pass:hover { color: var(--cyan-glow); }

        input {
            width: 100%;
            padding: 14px 45px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid #444;
            border-radius: 10px;
            color: white;
            box-sizing: border-box;
            outline: none;
        }

        input:focus { border-color: var(--cyan-glow); }

        .btn-rpg {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: linear-gradient(to bottom, #0077be, #004488);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid var(--cyan-glow);
            cursor: pointer;
            clip-path: polygon(5% 0%, 95% 0%, 100% 50%, 95% 100%, 5% 100%, 0% 50%);
            transition: 0.3s;
        }

        .btn-rpg:hover { filter: brightness(1.2); transform: scale(1.02); }

        .footer-links { margin-top: 30px; font-size: 14px; }
        .footer-links a { color: #eee; text-decoration: none; margin: 0 10px; }
        .footer-links a:hover { color: var(--cyan-glow); }

        #soundToggle {
            position: fixed; top: 20px; right: 20px;
            background: rgba(0,0,0,0.7); border: 1px solid white;
            color: white; border-radius: 50%; width: 40px; height: 40px; cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="top-icon"><i class="fa-regular fa-compass"></i></div>
    <h2>ENTRAR AL REINO</h2>

    <?php if(isset($error)): ?>
        <p style="color: #00d4ff; font-size: 13px;">✦ <?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <i class="fa-solid fa-user"></i>
            <input type="email" name="email" placeholder="Correo del héroe" required>
        </div>

        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="login-pass" name="password" placeholder="Contraseña secreta" required>
            <i class="fa-solid fa-eye toggle-pass" id="login-eye" onclick="togglePass('login-pass', 'login-eye')"></i>
        </div>

        <button type="submit" class="btn-rpg">INICIAR AVENTURA</button>
    </form>

    <div class="footer-links">
        <a href="register.php">Crear Cuenta</a>
        <span style="opacity: 0.3">|</span>
        <a href="recuperar.php">¿Olvidaste tu clave?</a>
    </div>
</div>

<button id="soundToggle" onclick="toggleMusic()">🔊</button>
<audio id="bgMusic" src="sounds/battle.mp3" loop></audio>

<script>
    function togglePass(inputId, eyeId) {
        const p = document.getElementById(inputId);
        const e = document.getElementById(eyeId);
        if (p.type === "password") {
            p.type = "text";
            e.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            p.type = "password";
            e.classList.replace("fa-eye-slash", "fa-eye");
        }
    }

    const music = document.getElementById("bgMusic");
    let isPlaying = false;
    function toggleMusic() {
        const btn = document.getElementById("soundToggle");
        if (!isPlaying) { music.play(); btn.textContent = "🔊"; } 
        else { music.pause(); btn.textContent = "🔇"; }
        isPlaying = !isPlaying;
    }
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
</body>
</html>
