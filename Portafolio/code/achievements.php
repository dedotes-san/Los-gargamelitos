<?php
session_start();
include "database.php"; 

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];

/**
 * LISTA MAESTRA DE 32 LOGROS
 */
$lista_maestra = [
    "Rostro del Héroe" => "Sube tu primera foto de perfil.",
    "Renacido" => "Cambia tu nombre de usuario.",
    "Primer Favorito" => "Guarda tu primer juego en favoritos.",
    "Coleccionista (5 Juegos)" => "Ten 5 juegos en tu biblioteca personal.",
    "Fanático" => "Guarda 10 juegos en favoritos.",
    "Curador" => "Guarda 20 juegos en favoritos.",
    "Iniciado" => "Alcanza el Nivel 5.",
    "Escudero" => "Alcanza el Nivel 10.",
    "Caballero" => "Alcanza el Nivel 20.",
    "Lord" => "Alcanza el Nivel 50.",
    "Inmortal" => "Alcanza el Nivel 100.",
    "Viajero de Fantasía" => "Explora la categoría Fantasía.",
    "Guerrero de Acción" => "Explora la categoría Acción.",
    "Maestro de Turnos" => "Explora la categoría Turnos.",
    "Otaku" => "Explora la categoría Anime.",
    "Trotamundos" => "Visita todas las categorías disponibles.",
    "Primer Mensaje" => "Envía tu primer mensaje en el chat.",
    "Charlatán" => "Envía más de 100 mensajes en el chat.",
    "Muro de Hierro" => "Bloquea a un usuario por primera vez.",
    "Diplomático" => "Desbloquea a un usuario.",
    "Limpieza Real" => "Usa la función de limpiar chat.",
    "Madrugador" => "Inicia sesión antes de las 8:00 AM.",
    "Noctámbulo" => "Inicia sesión después de las 11:00 PM.",
    "Fiel" => "Inicia sesión 3 días seguidos.",
    "Adicto" => "Inicia sesión 7 días seguidos.",
    "Click Veloz" => "Abre 10 juegos diferentes.",
    "Buscador de Secretos" => "Realiza 5 búsquedas en la biblioteca.",
    "Estilo Rojo" => "Personaliza tu interfaz con el tema neón.",
    "Biografía Escrita" => "Completa la información de tu perfil.",
    "Donador" => "Apoya al gremio con una contribución.",
    "Explorador de Grietas" => "Encuentra una página oculta o un error.",
    "GRAN MAESTRO" => "Desbloquea todos los logros anteriores."
];

$total_sistema = count($lista_maestra);

// --- 1. LÓGICA DE VERIFICACIÓN (PASO PREVIO) ---

// Contar favoritos actuales
$query_favs = $conn->query("SELECT COUNT(*) as total FROM favorites WHERE user_id = $user_id");
$count_favs = $query_favs->fetch_assoc()['total'];

$metas_favoritos = [
    "Primer Favorito" => 1,
    "Coleccionista (5 Juegos)" => 5,
    "Fanático" => 10,
    "Curador" => 20
];

foreach ($metas_favoritos as $titulo_logro => $requisito) {
    if ($count_favs >= $requisito) {
        $check = $conn->query("SELECT id FROM achievements WHERE user_id = $user_id AND title = '$titulo_logro'");
        if ($check->num_rows == 0) {
            $conn->query("INSERT INTO achievements (user_id, title, unlocked_at) VALUES ($user_id, '$titulo_logro', NOW())");
        }
    }
}

// Lógica Gran Maestro
$res_check_total = $conn->query("SELECT COUNT(*) as total FROM achievements WHERE user_id = $user_id AND title != 'GRAN MAESTRO'");
$mis_logros_actuales = $res_check_total->fetch_assoc()['total'];

if ($mis_logros_actuales >= ($total_sistema - 1)) {
    $check_gm = $conn->query("SELECT id FROM achievements WHERE user_id = $user_id AND title = 'GRAN MAESTRO'");
    if ($check_gm->num_rows == 0) {
        $conn->query("INSERT INTO achievements (user_id, title, unlocked_at) VALUES ($user_id, 'GRAN MAESTRO', NOW())");
    }
}

// --- 2. LÓGICA DE CARGA (DESPUÉS DE INSERTAR) ---

$ganados = [];
// Volvemos a consultar para tener la lista fresca y el contador real
$res = $conn->query("SELECT title, unlocked_at FROM achievements WHERE user_id = $user_id");
if($res) {
    while($row = $res->fetch_assoc()) {
        $ganados[$row['title']] = $row['unlocked_at'];
    }
}

$num_ganados = count($ganados);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Santuario de Cristales - Logros</title>
    <style>
        :root { 
            --crystal-blue: #00d4ff; 
            --crystal-glow: 0 0 20px rgba(0, 212, 255, 0.6); 
            --stone-bg: rgba(10, 15, 25, 0.85);
            --locked-gray: #444;
            --gold-text: #e2c044;
        }

        body { 
            /* FONDO DE LAS CAVERNAS DE CRISTAL */
            background: url('images/caverna_cristal.png') no-repeat center center fixed;
            background-size: cover;
            background-color: #050a10; 
            color: white; 
            font-family: 'Crimson Text', serif; 
            text-align: center; 
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: var(--crystal-blue);
            text-shadow: 0 0 15px var(--crystal-blue), 2px 2px 10px #000;
            text-transform: uppercase;
            letter-spacing: 6px;
            margin-top: 30px;
            background: rgba(0,0,0,0.5);
            display: inline-block;
            padding: 10px 40px;
            border-radius: 50px;
            border: 1px solid var(--crystal-blue);
        }

        .btn-back {
            display: inline-block;
            text-decoration: none;
            color: var(--crystal-blue);
            border: 2px solid var(--crystal-blue);
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: 0.3s;
            margin-bottom: 30px;
            background: rgba(0, 212, 255, 0.1);
            box-shadow: 3px 3px 0px #000;
        }
        .btn-back:hover {
            background: var(--crystal-blue);
            color: #000;
            box-shadow: var(--crystal-glow);
            transform: scale(1.05);
        }

        .progress-text { 
            font-size: 32px; 
            color: var(--crystal-blue); 
            text-shadow: var(--crystal-glow);
            font-weight: bold;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
            padding: 20px;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* TARJETA COMO RECUADRO DE CRISTAL/PIEDRA */
        .card {
            background: var(--stone-bg);
            backdrop-filter: blur(8px);
            padding: 25px 15px;
            border-radius: 5px;
            border: 2px solid #2a2e3d;
            transition: 0.4s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.5);
        }

        .card.unlocked {
            border-color: var(--crystal-blue);
            background: linear-gradient(145deg, rgba(0,212,255,0.1), var(--stone-bg));
        }

        .card.unlocked:hover {
            transform: translateY(-10px);
            box-shadow: var(--crystal-glow);
            border-color: #fff;
        }

        .card.locked {
            opacity: 0.5;
            filter: grayscale(0.8);
            border-style: dotted;
        }

        .trophy-icon {
            font-size: 45px;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 10px rgba(0, 212, 255, 0.4));
        }

        h3 {
            margin: 10px 0;
            font-size: 19px;
            color: #fff;
            letter-spacing: 1px;
        }

        p {
            font-size: 14px;
            color: #adb5bd;
            margin: 0 0 15px 0;
            line-height: 1.4;
            font-style: italic;
        }

        small {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        /* DISEÑO PARA BOTÓN DE SONIDO */
        #soundToggle {
            position: fixed;
            top: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(0,0,0,0.8);
            color: var(--crystal-blue);
            border: 1px solid var(--crystal-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            box-shadow: var(--crystal-glow);
        }
    </style>
</head>
<body>

    <h1>💎 SANTUARIO DE KHALDURUN</h1>
    
    <div style="margin: 20px 0;">
        <a href="dashboard.php" class="btn-back">⬅ VOLVER AL CAMPAMENTO</a>
    </div>

    <div class="progress-text">
        RELIQUIAS HALLADAS: <?php echo $num_ganados; ?> / <?php echo $total_sistema; ?>
    </div>

    <div class="achievements-grid">
        <?php foreach($lista_maestra as $titulo => $desc): ?>
            <?php $win = isset($ganados[$titulo]); ?>
            
            <div class="card <?php echo $win ? 'unlocked' : 'locked'; ?>">
                <div class="trophy-icon">
                    <?php echo $win ? '💎' : '🌑'; ?>
                </div>
                
                <h3><?php echo $win ? htmlspecialchars($titulo) : 'Fragmento Oculto'; ?></h3>
                
                <p><?php echo htmlspecialchars($desc); ?></p>
                
                <?php if($win): ?>
                    <small style="color: var(--crystal-blue);">
                        EXTRAÍDO EL: <?php echo date("d/m/y", strtotime($ganados[$titulo])); ?>
                    </small>
                <?php else: ?>
                    <small style="color: var(--locked-gray);">AÚN EN LA OSCURIDAD</small>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
// Creamos o recuperamos la música
if (!window.audioMaster) {
    window.audioMaster = new Audio('sounds/battle.mp3');
    window.audioMaster.loop = true;
    window.audioMaster.volume = 0.5;
}

// 1. Al cargar la página: Verificamos si hay un tiempo guardado
const tiempoGuardado = localStorage.getItem('musica_posicion');
if (tiempoGuardado) {
    window.audioMaster.currentTime = parseFloat(tiempoGuardado);
}

// 2. Mientras escuchamos: Guardamos la posición cada segundo
setInterval(() => {
    if (!window.audioMaster.paused) {
        localStorage.setItem('musica_posicion', window.audioMaster.currentTime);
    }
}, 1000);

// 3. Intentar reproducir (necesita un clic del usuario al menos una vez en el sitio)
const tocarMusica = () => {
    window.audioMaster.play();
    // Una vez que suena, quitamos el evento para que no se repita el play al hacer más clics
    document.removeEventListener('click', tocarMusica);
};

document.addEventListener('click', tocarMusica);

// Por si el navegador ya permite el autoplay (si ya hiciste clic en la página anterior)
window.audioMaster.play().catch(() => {});
</script>

    <script>
// 1. Crear o recuperar el objeto de música
if (!window.audioMaster) {
    window.audioMaster = new Audio('sounds/battle.mp3');
    window.audioMaster.loop = true;
}

// 2. Función para aplicar los ajustes guardados
function aplicarAjustesRpg() {
    // LEER VOLUMEN: Busca el volumen que guardaste en configuracion.php
    // Si no encuentra nada, usa 0.5 (50%) por defecto
    const volLog = localStorage.getItem('musica_volumen') || 0.5;
    window.audioMaster.volume = parseFloat(volLog);

    // LEER POSICIÓN: Para que no empiece la canción desde cero
    const posLog = localStorage.getItem('musica_posicion');
    if (posLog) {
        window.audioMaster.currentTime = parseFloat(posLog);
    }
}

// 3. Guardar la posición cada segundo para que la música sea fluida entre páginas
setInterval(() => {
    if (!window.audioMaster.paused) {
        localStorage.setItem('musica_posicion', window.audioMaster.currentTime);
    }
}, 1000);

// 4. Activar al primer clic (Requerido por el navegador)
document.addEventListener('click', () => {
    aplicarAjustesRpg(); // Aplicamos el volumen justo antes de sonar
    window.audioMaster.play().catch(e => console.log("Esperando interacción..."));
}, { once: true });

// Intentar sonar automáticamente si el usuario ya interactuó antes
aplicarAjustesRpg();
window.audioMaster.play().catch(() => {});
</script>
    
    <script src="rpg-notifications.js"></script>
</body>
</html>
