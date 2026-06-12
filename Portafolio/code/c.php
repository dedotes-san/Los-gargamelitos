<?php
session_start();
include "database.php";

// 1. Sincronización de zona horaria
date_default_timezone_set('America/Mexico_City'); 
$conn->query("SET time_zone = '" . date('P') . "'");

if(!isset($_SESSION["user_id"])) { header("Location: inicio.php"); exit(); }

$my_id = intval($_SESSION["user_id"]);
$friend_id = isset($_GET["user"]) ? intval($_GET["user"]) : 0;

// 2. Obtener datos del amigo y estado inicial
$stmt = $conn->prepare("
    SELECT username, profile_pic, 
    (last_seen > NOW() - INTERVAL 50 SECOND) as is_online 
    FROM users WHERE id = ?
");
$stmt->bind_param("i", $friend_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if(!$user) { header("Location: friends.php"); exit(); }

$status_text = ($user['is_online'] == 1) ? "● EN LINEA" : "DESCONECTADO";
$status_color = ($user['is_online'] == 1) ? "#00ff00" : "#ff4444";

// 3. Lógica de Bloqueo
$sql_rel = "SELECT status, blocker_id FROM friends 
            WHERE (sender_id = $my_id AND receiver_id = $friend_id) 
            OR (sender_id = $friend_id AND receiver_id = $my_id)";
$res_rel = $conn->query($sql_rel);
$relation = $res_rel->fetch_assoc();

$is_blocked = (isset($relation['status']) && $relation['status'] == 'blocked');
$i_am_blocker = ($is_blocked && $relation['blocker_id'] == $my_id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Taller de Mensajes - <?php echo htmlspecialchars($user['username']); ?></title>
    <style>
        :root { 
            --rpg-gold: #c5a059; 
            --bg-dark: rgba(10, 10, 10, 0.9);
            --wood-dark: #3e2723;
        }

        body, html { 
            margin: 0; padding: 0; height: 100%; 
            background: url('images/taller.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white; font-family: 'Georgia', serif; overflow: hidden; 
        }
        
        .chat-container { display: flex; flex-direction: column; height: 100vh; backdrop-filter: blur(2px); position: relative; }

        .chat-header { 
            padding: 10px 20px; 
            background: var(--bg-dark); 
            border-bottom: 2px solid var(--rpg-gold);
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            z-index: 10;
        }
        .header-left { display: flex; align-items: center; gap: 15px; }
        .header-img { width: 45px; height: 45px; border-radius: 5px; border: 2px solid var(--rpg-gold); object-fit: cover; }
        
        .btn-back { 
            text-decoration: none; color: var(--rpg-gold); font-size: 20px; font-weight: bold;
            transition: 0.3s; padding: 5px;
        }
        .btn-back:hover { text-shadow: 0 0 10px var(--rpg-gold); transform: scale(1.1); }

        .btn-danger { background: transparent; color: #ff4444; border: 1px solid #ff4444; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; margin-left: 5px;}
        .btn-top { text-decoration: none; color: #ccc; border: 1px solid #555; padding: 5px 10px; border-radius: 4px; font-size: 11px; }

        .chat-box { flex: 1; padding: 20px 5%; overflow-y: auto; display: flex; flex-direction: column; gap: 12px; }
        
        .msg { max-width: 75%; padding: 12px 18px; border-radius: 8px; font-size: 15px; border: 1px solid #4a3b2a; position: relative; }
        .msg.me { align-self: flex-end; background: rgba(62, 39, 35, 0.9); border-color: var(--rpg-gold); color: #f4e4bc; }
        .msg.other { align-self: flex-start; background: rgba(30, 30, 30, 0.9); border-color: #555; }

        .input-area { 
            padding: 15px 25px; 
            background: var(--bg-dark); 
            display: flex; gap: 12px; 
            border-top: 2px solid var(--rpg-gold); 
            align-items: center; 
            position: relative;
        }
        .input-area input[type="text"] { 
            flex: 1; background: #f4e4bc; border: 2px solid #634d32; color: #2a1b0a; 
            padding: 12px; border-radius: 4px; outline: none; font-weight: bold;
        }
        .btn-send { background: #8b0000; color: white; border: 1px solid var(--rpg-gold); padding: 10px 20px; border-radius: 4px; font-weight: bold; cursor: pointer; transition: 0.2s; }
        .btn-send:hover { background: #b30000; box-shadow: 0 0 10px var(--rpg-gold); }

        .btn-file { color: var(--rpg-gold); font-size: 24px; cursor: pointer; transition: 0.2s; }
        .btn-file:hover { transform: rotate(15deg) scale(1.2); }

        #previewContainer {
            display: none; position: absolute; bottom: 85px; left: 25px; 
            background: rgba(20, 15, 10, 0.95); border: 2px solid var(--rpg-gold); 
            padding: 10px; border-radius: 8px; z-index: 100; box-shadow: 0 0 20px rgba(0,0,0,0.8);
        }

        .block-msg { width: 100%; text-align: center; color: var(--rpg-gold); font-weight: bold; }
        .btn-unlock { background: var(--rpg-gold); color: black; text-decoration: none; padding: 8px 15px; border-radius: 4px; font-size: 12px; margin-top: 10px; display: inline-block; }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <div class="header-left">
                <a href="friends.php" class="btn-back">❮</a>
                <img src="uploads/<?php echo !empty($user['profile_pic']) ? $user['profile_pic'] : 'default.png'; ?>" class="header-img">
                <div>
                    <strong style="display:block; color:var(--rpg-gold);"><?php echo htmlspecialchars($user['username']); ?></strong>
                    <small id="userStatus" style="font-weight:bold; color: <?php echo $status_color; ?>;">
                        <?php echo $status_text; ?>
                    </small>
                </div>
            </div>
            <div class="header-right">
                <a href="vaciar_c.php?user=<?php echo $friend_id; ?>" class="btn-top" onclick="return confirm('¿Vaciar pergaminos?');">VACIAR</a>
                <button onclick="deleteChat()" class="btn-danger">ELIMINAR</button>
                <?php if(!$i_am_blocker): ?>
                    <button onclick="blockUser()" class="btn-danger">BLOQUEAR</button>
                <?php endif; ?>
            </div>
        </div>

        <div class="chat-box" id="chatBox"></div>

        <div id="previewContainer">
            <div style="position: relative; display: flex; flex-direction: column; align-items: center;">
                <img id="filePreview" src="" style="max-width: 120px; max-height: 120px; border-radius: 4px; display: none; border: 1px solid #634d32;">
                <div id="fileNameDisplay" style="color: #f4e4bc; font-size: 11px; margin-top: 5px; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></div>
                <div onclick="clearPreview()" style="position: absolute; top: -18px; right: -18px; background: #8b0000; color: white; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px; border: 1px solid var(--rpg-gold); font-family: sans-serif;">×</div>
            </div>
        </div>

        <div class="input-area" id="inputContainer">
            <?php if(!$is_blocked): ?>
                <label for="fileInput" class="btn-file">📎</label>
                <input type="file" id="fileInput" style="display:none;" onchange="previewFile()">
                <input type="text" id="messageInput" placeholder="Escribe un pergamino..." autocomplete="off">
                <button onclick="sendMessage()" class="btn-send">ENVIAR</button>
            <?php else: ?>
                <div class="block-msg">
                    ALIANZA ROTA / COMUNICACIÓN CORTADA <br>
                    <?php if($i_am_blocker): ?>
                        <a href="unblock_user.php?user=<?php echo $friend_id; ?>" class="btn-unlock">RESTAURAR ALIANZA</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const friend_id = <?php echo $friend_id; ?>;
        const chatBox = document.getElementById("chatBox");

        // 1. Cargar mensajes
        function loadMessages(){
            fetch("get_messages.php?friend_id=" + friend_id)
            .then(res => res.text()).then(data => {
                const isAtBottom = chatBox.scrollHeight - chatBox.clientHeight <= chatBox.scrollTop + 100;
                chatBox.innerHTML = data;
                if(isAtBottom) chatBox.scrollTop = chatBox.scrollHeight;
            });
        }

        // 2. Avisar que YO estoy conectado (Update my last_seen)
        function iAmAlive() {
            fetch("update_status.php");
        }

        // 3. Revisar si MI AMIGO está online
        function updateFriendStatus() {
            fetch("get_status.php?user=" + friend_id)
            .then(res => res.text())
            .then(data => {
                const statusEl = document.getElementById("userStatus");
                if(statusEl) statusEl.innerHTML = data;
            });
        }

        // 4. Enviar mensaje
        function sendMessage(){
            let input = document.getElementById("messageInput");
            let fileInput = document.getElementById("fileInput");
            let file = fileInput.files[0];

            if(!input.value.trim() && !file) return;

            let formData = new FormData();
            formData.append("message", input.value);
            formData.append("friend_id", friend_id);
            if(file) formData.append("file", file);

            input.value = "";
            fileInput.value = "";
            document.getElementById('previewContainer').style.display = 'none';

            fetch("sendmsg.php", {
                method: "POST",
                body: formData
            }).then(() => loadMessages());
        }

        // 5. Manejo de archivos
        function previewFile() {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('filePreview');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            if (file) {
                previewContainer.style.display = 'block';
                fileNameDisplay.textContent = file.name;
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => { previewImage.src = e.target.result; previewImage.style.display = 'block'; }
                    reader.readAsDataURL(file);
                } else {
                    previewImage.style.display = 'none';
                    fileNameDisplay.innerHTML = "📜 " + file.name;
                }
            }
        }

        function clearPreview() {
            document.getElementById('fileInput').value = "";
            document.getElementById('previewContainer').style.display = 'none';
        }

        // 6. Eventos
        document.getElementById("messageInput")?.addEventListener("keypress", (e) => { 
            if(e.key === "Enter") { e.preventDefault(); sendMessage(); }
        });

        function deleteChat() { if(confirm("¿Eliminar este aliado?")) location.href="delete_friend.php?user="+friend_id; }
        function blockUser() { if(confirm("¿Cortar comunicación?")) location.href="block_user.php?user="+friend_id; }

        // 7. Intervalos
        setInterval(loadMessages, 3000);
        setInterval(iAmAlive, 20000); 
        setInterval(updateFriendStatus, 5000);

        window.onload = () => {
            loadMessages();
            iAmAlive();
            updateFriendStatus();
        };
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
