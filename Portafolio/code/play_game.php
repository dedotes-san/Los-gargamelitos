<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Juego</title>
    <style>
        body { margin:0; }
        iframe { width:100%; height:100vh; border:none; }
    </style>
</head>
<body>

<iframe src="game/index.html"></iframe>

</body>
</html>
