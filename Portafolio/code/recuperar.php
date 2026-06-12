<?php
include "database.php";
include "filtro.php"; 

$error = "";
$success = "";
$step = 1; // Control de fase: 1 para correo, 2 para validación y cambio
$pregunta_usuario = "";
$email_temp = "";

// --- LÓGICA DE PROCESAMIENTO ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // FASE 1: BUSCAR EL CORREO Y OBTENER LA PREGUNTA
    if (isset($_POST['btn_fase1'])) {
        $email = trim($_POST['email'] ?? '');
        $stmt = $conn->prepare("SELECT pregunta_seguridad FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            $pregunta_usuario = $user['pregunta_seguridad'];
            $email_temp = $email;
            $step = 2; // Avanzamos a mostrar la pregunta y campos de pass
        } else {
            $error = "EL CORREO NO EXISTE EN EL SANTUARIO.";
        }
    }

    // FASE 2: VALIDAR RESPUESTA Y ACTUALIZAR CONTRASEÑA
    if (isset($_POST['btn_fase2'])) {
        $email = $_POST['email_hidden'];
        $pregunta_actual = $_POST['pregunta_hidden'];
        $respuesta_input = trim($_POST['respuesta_seguridad']);
        $n_pass = $_POST['nueva_pass'];
        $c_pass = $_POST['confirmar_pass'];

        // Consultar respuesta real en DB
        $stmt = $conn->prepare("SELECT respuesta_seguridad FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user_db = $stmt->get_result()->fetch_assoc();

        if (strtolower($respuesta_input) !== strtolower($user_db['respuesta_seguridad'])) {
            $error = "RESPUESTA INCORRECTA. IDENTIDAD NO VERIFICADA.";
            $step = 2; // Mantener en el formulario
            $pregunta_usuario = $pregunta_actual;
            $email_temp = $email;
        } elseif ($n_pass !== $c_pass) {
            $error = "LOS PERGAMINOS (CONTRASEÑAS) NO COINCIDEN.";
            $step = 2;
            $pregunta_usuario = $pregunta_actual;
            $email_temp = $email;
        } else {
            // --- INTEGRACIÓN DEL FILTRO SUPREMO EN RECUPERACIÓN ---
            $check = validarSeguridad($n_pass, true); // Evalúa tus reglas complejas de contraseña
            if ($check !== "OK") {
                $error = $check; // Muestra la alerta de seguridad insuficiente o insultos
                $step = 2;       // Nos mantenemos en la fase de escritura
                $pregunta_usuario = $pregunta_actual;
                $email_temp = $email;
            } else {
                // Éxito: Encriptar y actualizar
                $hash = password_hash($n_pass, PASSWORD_DEFAULT);
                $upd = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
                $upd->bind_param("ss", $hash, $email);
                if ($upd->execute()) {
                    header("Location: inicio.php?msg=success");
                    exit();
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Acceso - RPG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { 
            --cyan: #00f2ff; 
            --glow: 0 0 20px rgba(0, 242, 255, 0.6); 
            --bg: rgba(10, 25, 30, 0.93);
        }

        body { 
            background: url('images/cambiar.png') no-repeat center center fixed; 
            background-size: cover; 
            color: #e0faff; 
            font-family: 'Segoe UI', sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }

        .card { 
            background: var(--bg); 
            border: 2px solid var(--cyan); 
            padding: 40px; 
            border-radius: 25px; 
            box-shadow: var(--glow); 
            text-align: center; 
            width: 420px; 
            backdrop-filter: blur(8px);
        }

        h2 {
            color: white;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 10px var(--cyan);
            margin-bottom: 30px;
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
            color: var(--cyan);
        }

        input { 
            width: 100%; 
            padding: 14px 45px; 
            background: rgba(0, 40, 50, 0.5); 
            border: 1px solid rgba(0, 242, 255, 0.3); 
            color: white; 
            border-radius: 10px; 
            outline: none; 
            box-sizing: border-box;
            transition: 0.3s;
        }

        input:focus { border-color: var(--cyan); background: rgba(0, 60, 80, 0.6); }

        .pregunta-seccion {
            background: rgba(0, 242, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid var(--cyan);
            margin-bottom: 20px;
            text-align: left;
        }

        .pregunta-seccion label {
            font-size: 11px;
            color: var(--cyan);
            text-transform: uppercase;
            font-weight: bold;
        }

        .pregunta-seccion p {
            margin: 5px 0 0 0;
            font-size: 15px;
        }

        button { 
            width: 100%; 
            padding: 15px; 
            background: linear-gradient(135deg, #005f6b, #00a3b3); 
            border: 1px solid var(--cyan); 
            color: white; 
            font-weight: bold; 
            cursor: pointer; 
            border-radius: 10px; 
            text-transform: uppercase;
            margin-top: 15px;
            transition: 0.4s;
        }

        button:hover:not(:disabled) { box-shadow: 0 0 20px var(--cyan); filter: brightness(1.2); }
        button:disabled { opacity: 0.3; cursor: not-allowed; }

        .error-txt { color: #ffcc00; font-size: 13px; margin-bottom: 15px; display: block; }
        .back-link { display: block; margin-top: 25px; color: var(--cyan); text-decoration: none; font-size: 13px; opacity: 0.8; }
    </style>
</head>
<body>

<div class="card">
    <h2>REFORZAR ALMA</h2>
    
    <?php if($error) echo "<span class='error-txt'>✦ $error</span>"; ?>

    <form method="POST">
        <?php if($step == 1): ?>
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Correo del héroe" required autocomplete="off">
            </div>
            <button type="submit" name="btn_fase1">INVOCAR PREGUNTA</button>

        <?php else: ?>
            <input type="hidden" name="email_hidden" value="<?php echo htmlspecialchars($email_temp); ?>">
            <input type="hidden" name="pregunta_hidden" value="<?php echo htmlspecialchars($pregunta_usuario); ?>">

            <div class="pregunta-seccion">
                <label>Desafío de Identidad:</label>
                <p><?php echo htmlspecialchars($pregunta_usuario); ?></p>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-comment-dots"></i>
                <input type="text" name="respuesta_seguridad" placeholder="Tu respuesta secreta" required autofocus>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="nueva_pass" id="p1" placeholder="Nueva Contraseña" required oninput="validar()">
            </div>

            <div class="input-group">
                <i class="fa-solid fa-shield-check"></i>
                <input type="password" name="confirmar_pass" id="p2" placeholder="Confirmar Contraseña" required oninput="validar()">
            </div>

            <button type="submit" name="btn_fase2" id="btnFinal" disabled>REFORZAR ALMA</button>
        <?php endif; ?>
    </form>

    <a href="inicio.php" class="back-link">Regresar al santuario</a>
</div>

<script>
    function validar() {
        const p1 = document.getElementById('p1').value;
        const p2 = document.getElementById('p2').value;
        const btn = document.getElementById('btnFinal');
        
        // Sincronizado a un mínimo de 12 caracteres como pide tu backend en filtro.php
        if(p1.length >= 12 && p1 === p2) {
            btn.disabled = false;
            document.getElementById('p2').style.borderColor = "#00ffcc";
        } else {
            btn.disabled = true;
            document.getElementById('p2').style.borderColor = p2 === "" ? "rgba(0, 242, 255, 0.3)" : "#ff6b6b";
        }
    }
</script>

</body>
</html>
