<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn->query("INSERT INTO users (username, email, password, level, xp) 
    VALUES ('$username', '$email', '$password', 0, 0)");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro - RPG Launcher</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="auth-container">
    <div class="auth-card">
        <h2>📝 Crear Cuenta</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
</form>

        <br>
        <a href="index.php">Ya tengo cuenta</a>
    </div>
</div>

</body>
</html>