<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Obtener datos del usuario
$userData = $conn->query("SELECT level, xp FROM users WHERE id = $user_id")->fetch_assoc();

$level = $userData["level"];
$xp = $userData["xp"];

// Calcular barra (cada 5 XP sube nivel)
$xp_needed = 5;
$progress = ($xp % $xp_needed) / $xp_needed * 100;

// Filtro favoritos
if (isset($_GET["filter"]) && $_GET["filter"] == "favorites") {
    $result = $conn->query("
        SELECT games.* FROM games
        JOIN favorites ON games.id = favorites.game_id
        WHERE favorites.user_id = $user_id
    ");
} else {
    $result = $conn->query("SELECT * FROM games");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RPG Launcher</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-buttons">
    <a href="achievements.php"><button>🏆 Logros</button></a>
    <a href="dashboard.php?filter=favorites"><button>⭐ Favoritos</button></a>
    <a href="ranking.php"><button>🌍 Ranking</button></a>
    <a href="logout.php"><button>🚪 Salir</button></a>
</div>

<h2>Bienvenido <?php echo $_SESSION["username"]; ?> 🎮</h2>

<h3>🎖 Nivel <?php echo $level; ?></h3>

<div class="xp-container">
    <div class="xp-bar" style="width: <?php echo $progress; ?>%"></div>
</div>
<p><?php echo $xp; ?> XP</p>

<hr>

<h3>🎮 Biblioteca de Juegos</h3>

<div class="container">

<?php while($game = $result->fetch_assoc()) { 

    $favCheck = $conn->query("SELECT * FROM favorites WHERE user_id=$user_id AND game_id=".$game["id"]);
    $isFavorite = $favCheck->num_rows > 0;

    $imageName = strtolower(str_replace(" ", "", $game["name"])) . ".jpg";
?>

    <div class="card">
        <img src="images/<?php echo $imageName; ?>" width="100%">
        <h4><?php echo $game["name"]; ?></h4>
        <p><strong>Género:</strong> <?php echo $game["genre"]; ?></p>
        <p><?php echo $game["description"]; ?></p>

        <?php if ($game["is_real"]) { ?>
            <a href="<?php echo $game["url"]; ?>" target="_blank">
                <button>Ir a la Tienda</button>
            </a>
        <?php } else { ?>
            <a href="play.php?id=<?php echo $game["id"]; ?>">
                <button>Jugar</button>
            </a>
        <?php } ?>

        <br><br>

        <?php if ($isFavorite) { ?>
            <a href="favorite.php?id=<?php echo $game["id"]; ?>">
                <button>❌ Quitar Favorito</button>
            </a>
        <?php } else { ?>
            <a href="favorite.php?id=<?php echo $game["id"]; ?>">
                <button>⭐ Agregar Favorito</button>
            </a>
        <?php } ?>

    </div>

<?php } ?>

</div>

</body>
</html>