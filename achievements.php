<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$achievements = $conn->query("SELECT * FROM achievements WHERE user_id=$user_id ORDER BY unlocked_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Mis Logros</title>
    <style>
        body {
            background-color: #0f0f0f;
            color: white;
            font-family: Arial;
            text-align: center;
        }

        .card {
            background-color: #1c1c1c;
            margin: 15px auto;
            padding: 15px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 0 10px #00ffcc;
        }

        a {
            color: #00ffcc;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1>🏆 Mis Logros</h1>

<?php
if ($achievements->num_rows > 0) {
    while ($row = $achievements->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<h3>🏅 ".$row["title"]."</h3>";
        echo "<p>Desbloqueado: ".$row["unlocked_at"]."</p>";
        echo "</div>";
    }
} else {
    echo "<p>No tienes logros aún.</p>";
}
?>

<br>
<a href="dashboard.php">⬅ Volver al Dashboard</a>

</body>
</html>