<?php
session_start();
include "database.php"; 

// Verificamos que el usuario esté logueado y que los datos vengan por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    
    $user_id = intval($_SESSION["user_id"]);
    $nuevo_idioma = $_POST['language']; // Recibe 'es' o 'en' del select

    // Validamos que el idioma sea uno de los permitidos para evitar inyecciones
    $idiomas_validos = ['es', 'en'];
    
    if (in_array($nuevo_idioma, $idiomas_validos)) {
        // Preparamos la consulta para actualizar el campo 'language'
        $stmt = $conn->prepare("UPDATE users SET language = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_idioma, $user_id);
        
        if ($stmt->execute()) {
            // Si sale bien, regresamos a la configuración con un mensaje de éxito
            header("Location: configuracion.php?status=lang_updated");
            exit();
        } else {
            // Si hay error en la base de datos
            header("Location: configuracion.php?error=db_error");
            exit();
        }
    } else {
        // Si alguien intenta enviar un valor raro
        header("Location: configuracion.php?error=invalid_lang");
        exit();
    }
} else {
    // Si intentan entrar al archivo directamente sin el formulario
    header("Location: configuracion.php");
    exit();
}
?>
