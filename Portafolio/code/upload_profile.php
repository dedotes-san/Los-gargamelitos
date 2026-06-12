<?php
session_start();
include "database.php"; // Asegúrate de que la ruta sea correcta según tu proyecto

// Usamos el user_id de la sesión que es más seguro
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0) {
    $file_name = $_FILES["profile_pic"]["name"];
    $tmp_name = $_FILES["profile_pic"]["tmp_name"];
    
    // IMPORTANTE: Para que dashboard.php las encuentre, 
    // guárdalas en "uploads/" directamente si así lo tienes en el otro código
    $folder = "uploads/" . $file_name;

    if (move_uploaded_file($tmp_name, $folder)) {
        // Actualizamos usando el ID para evitar fallos con nombres duplicados
        $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->bind_param("si", $file_name, $user_id);
        
        if ($stmt->execute()) {
            header("Location: dashboard.php?success=1");
        } else {
            echo "Error al actualizar la base de datos.";
        }
    } else {
        echo "Error al mover el archivo a la carpeta uploads.";
    }
} else {
    header("Location: dashboard.php?error=upload_failed");
}
?>
