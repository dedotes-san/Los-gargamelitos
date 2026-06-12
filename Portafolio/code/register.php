<?php
session_start();
include "database.php";
include "filtro.php"; // Aquí adentro debe estar la función validarSeguridad() y filtroSupremo()

$error = "";

// 1. Catálogo de preguntas aleatorias para el desafío rúnico
$preguntas_seguridad = [
    "¿Cuál es el nombre de tu primera mascota?",
    "¿En qué ciudad naciste?",
    "¿Cuál es tu color favorito de la infancia?",
    "¿Cómo se llamaba tu escuela primaria?",
    "¿Cuál es tu videojuego RPG favorito?"
];

// 2. Seleccionar una pregunta al azar si no se ha enviado el formulario
$pregunta_azar = $preguntas_seguridad[array_rand($preguntas_seguridad)];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    
    // Recibimos los nuevos campos previniendo que vengan vacíos (evita el Warning y Deprecated)
    $pregunta_guardada = $_POST['pregunta_txt'] ?? '';
    $respuesta_user = isset($_POST['respuesta_seguridad']) ? strtolower(trim($_POST['respuesta_seguridad'])) : '';

    // --- INTEGRACIÓN DEL FILTRO SUPREMO ---
    $check_user = validarSeguridad($user, false); // Solo revisa que esté limpio
    $check_pass = validarSeguridad($pass, true);  // Revisa limpieza + requisitos de 12 caracteres, símbolos, etc.

    if ($check_user !== "OK") {
        $error = $check_user;
    } elseif ($check_pass !== "OK") {
        $error = $check_pass;
    } elseif (empty($respuesta_user)) {
        $error = "LA RESPUESTA DE SEGURIDAD ES OBLIGATORIA.";
    }elseif (validarSeguridad($respuesta_user) !== "OK") { // Validación extra para la respuesta secreta
    $error = "⚠️ La respuesta secreta contiene palabras no permitidas.";
} else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res_check = $stmt->get_result();

        if ($res_check->num_rows > 0) {
            $error = "EL CORREO YA ESTÁ REGISTRADO.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            // Agregamos de forma segura los campos a la consulta preparada
            $ins = $conn->prepare("INSERT INTO users (username, email, password, pregunta_seguridad, respuesta_seguridad) VALUES (?, ?, ?, ?, ?)");
            $ins->bind_param("sssss", $user, $email, $hash, $pregunta_guardada, $respuesta_user);

            if ($ins->execute()) {
                header("Location: inicio.php?reg=success");
                exit();
            } else {
                $error = "ERROR AL CREAR CUENTA: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro RPG - Bosque</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { 
            --nature-green: #2d5a27; 
            --nature-light: #4ea93b;
            --nature-gold: #d4a373;
            --dark-wood: rgba(15, 25, 10, 0.95);
        }

        body {
            margin: 0; padding: 0; height: 100vh;
            display: flex; justify-content: center; align-items: center;
            font-family: 'Segoe UI', sans-serif;
            background: url('images/regis.png') no-repeat center center;
            background-size: cover;
            overflow: hidden;
        }

        .card {
            width: 380px;
            background: var(--dark-wood);
            padding: 35px;
            border-radius: 20px;
            text-align: center;
            border: 2px solid var(--nature-green);
            box-shadow: 0 0 30px rgba(45, 90, 39, 0.6);
        }

        h2 { 
            color: var(--nature-gold); 
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8); 
            text-transform: uppercase;
            letter-spacing: 2px;
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
            color: var(--nature-gold);
            opacity: 0.7;
        }

        .input-group .toggle-pass {
            left: auto;
            right: 15px;
            cursor: pointer;
        }

        input {
            width: 100%;
            padding: 12px 40px;
            background: rgba(0, 0, 0, 0.6);
            border: 1px solid var(--nature-green);
            color: #e0e0e0;
            border-radius: 8px;
            box-sizing: border-box;
            outline: none;
            transition: 0.3s;
        }

        input:focus { 
            border-color: var(--nature-light); 
            box-shadow: 0 0 8px var(--nature-light);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to bottom, var(--nature-light), var(--nature-green));
            border: 1px solid #1a3317;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        .alert {
            background: rgba(212, 163, 115, 0.2);
            border: 1px solid var(--nature-gold);
            color: #fefae0;
            padding: 10px;
            font-size: 13px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .footer-link {
            display: block;
            margin-top: 20px;
            color: var(--nature-gold);
            text-decoration: none;
            font-size: 13px;
        }

        .footer-link:hover { color: var(--nature-light); }
    </style>
</head>
<body>

<div class="card">
    <h2>NUEVO AVENTURERO</h2>

    <?php if($error): ?>
        <div class="alert"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="username" placeholder="Nombre de usuario" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required autocomplete="off">
        </div>
        
        <div class="input-group">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" placeholder="Correo Electrónico" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required autocomplete="off">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="reg-pass" name="password" placeholder="Contraseña Segura" required>
            <i class="fa-solid fa-eye toggle-pass" id="reg-eye" onclick="togglePass('reg-pass', 'reg-eye')"></i>
        </div>

        <div style="text-align: left; background: rgba(0,0,0,0.4); padding: 12px; border-radius: 8px; border: 1px dashed var(--nature-green); margin-bottom: 15px;">
            <label style="color: var(--nature-gold); font-size: 12px; font-weight: bold; text-transform: uppercase;">
                <i class="fa-solid fa-shield-halved"></i> Guardián de Cuenta
            </label>
            <p style="color: #e0e0e0; font-size: 13px; margin: 5px 0 10px 0;">
                <strong><?php echo $pregunta_azar; ?></strong>
            </p>
            <input type="hidden" name="pregunta_txt" value="<?php echo $pregunta_azar; ?>">
            <div class="input-group" style="margin-bottom: 0;">
                <i class="fa-solid fa-comment-dots" style="color: var(--nature-gold);"></i>
                <input type="text" name="respuesta_seguridad" placeholder="Escribe tu respuesta secreta" required autocomplete="off" style="padding: 10px 40px; font-size: 14px;">
            </div>
        </div>

        <button type="submit" class="btn-submit">CREAR CUENTA</button>
    </form>

    <a href="inicio.php" class="footer-link">Ya tengo cuenta</a>
</div>

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
</script>
</body>
</html>
