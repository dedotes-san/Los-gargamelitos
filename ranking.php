<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$ranking = $conn->query("
SELECT games.name, COUNT(favorites.id) as total
FROM games
LEFT JOIN favorites ON games.id = favorites.game_id
GROUP BY games.id
ORDER BY total DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Ranking Global</title>
    <style>
        body {
            background: linear-gradient(135deg, #0f0f0f, #1a1a2e);
            color: white;
            font-family: Arial;
            text-align: center;
        }

        .card {
            background: #16213e;
            margin: 15px auto;
            padding: 15px;
            width: 300px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,255,200,0.3);
        }

        h1 {
            margin-top: 20px;
        }

        a {
            color: #00ffc8;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1>🌍 Ranking Global</h1>

<?php
$position = 1;
while ($row = $ranking->fetch_assoc()) {
    echo "<div class='card'>";
    echo "<h3>#".$position." - ".$row["name"]."</h3>";
    echo "<p>⭐ Favoritos: ".$row["total"]."</p>";
    echo "</div>";
    $position++;
}
?>

<br>
<a href="dashboard.php">⬅ Volver</a>

</body>
</html> 