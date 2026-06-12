// rpg-notifications.js

function mostrarAvisoVisual(usuario, mensaje) {
    const aviso = document.createElement('div');
    aviso.style = `
        position: fixed; top: 20px; right: 20px; 
        background: rgba(0, 0, 0, 0.95); color: #00f2ff; 
        padding: 15px; border: 2px solid #d4af37; 
        border-radius: 5px; z-index: 10000; 
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.6);
        font-family: 'Crimson Text', serif; min-width: 200px;
    `;
    aviso.innerHTML = `<div style="color:gold; font-size:10px; margin-bottom:5px;">MENSAJE RECIBIDO</div>
                       <strong>${usuario}:</strong> ${mensaje}`;
    
    document.body.appendChild(aviso);
    setTimeout(() => { aviso.remove(); }, 4000);
}

function iniciarRadar() {
    setInterval(() => {
        fetch('check_notifications.php')
            .then(res => res.json())
            .then(data => {
                if (data.nuevo) {
                    mostrarAvisoVisual(data.usuario, data.mensaje);
                }
            })
            .catch(() => {}); // Silenciar errores para no ensuciar la consola
    }, 3000);
}

// Iniciar automáticamente al cargar cualquier página que incluya este JS
document.addEventListener('DOMContentLoaded', iniciarRadar);
