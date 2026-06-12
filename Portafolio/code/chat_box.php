<div id="chatBox" class="chat-box">

<div class="chat-header">
<span id="chatUser">Chat</span>
<button onclick="cerrarChat()">X</button>
</div>

<div id="chatMessages" class="chat-messages"></div>

<div class="chat-input">
<input type="text" id="msg" placeholder="Escribe...">
<button onclick="enviarMsg()">➤</button>
</div>

</div>


<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script>
let friend_id = 0;
// 1. Configurar Pusher con tus llaves
const pusher = new Pusher('90f21c869ad8d46a9415', { cluster: 'us2' });
const channel = pusher.subscribe('rpg-chat');

// 2. Escuchar mensajes nuevos en tiempo real
channel.bind('nuevo-mensaje', function(data) {
    const mi_id = <?php echo $_SESSION['user_id']; ?>;
    
    // Solo mostramos si el mensaje es entre tú y tu amigo actual
    if( (data.receptor == mi_id && data.emisor == friend_id) || 
        (data.emisor == mi_id && data.receptor == friend_id) ) {
        
        const chatMessages = document.getElementById("chatMessages");
        chatMessages.innerHTML += `<div class="msg"><b>${data.usuario}:</b> ${data.mensaje}</div>`;
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});

function abrirChat(id, name){
    friend_id = id;
    document.getElementById("chatBox").style.display="flex";
    document.getElementById("chatUser").innerText=name;
    // Cargamos el historial una sola vez al abrir
    cargarMensajes();
}

function cerrarChat(){
    document.getElementById("chatBox").style.display="none";
    friend_id = 0;
}

function enviarMsg(){
    let msgInput = document.getElementById("msg");
    let msg = msgInput.value;

    if(msg.trim() === "" || friend_id === 0) return;

    // Fíjate que usamos friend_id y message (como pide el PHP arriba)
    fetch(`send_message.php?friend_id=${friend_id}&message=${encodeURIComponent(msg)}`)
    .then(res => res.text())
    .then(data => {
        if(data === "ok") {
            msgInput.value = ""; // Limpiamos el texto
            console.log("Mensaje enviado y notificado a Pusher");
        } else {
            console.error("Error del servidor:", data);
        }
    });
}

function cargarMensajes(){
    // Esta función solo se usa una vez al abrir el chat para traera lo viejo
    fetch(`get_messages.php?friend_id=${friend_id}`)
    .then(res => res.text())
    .then(data => {
        document.getElementById("chatMessages").innerHTML = data;
        let box = document.getElementById("chatMessages");
        box.scrollTop = box.scrollHeight;
    });
}
// Ejemplo de cómo dejarlo en tu main.js para que no te den 403:
setInterval(() => {
    fetch('update_status.php'); 
}, 60000); // 1 minuto es seguro para InfinityFree

</script>
