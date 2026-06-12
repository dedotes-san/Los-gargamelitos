<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$conn->set_charset("utf8mb4");
$user_id = $_SESSION["user_id"];

// DATOS DEL USUARIO (Única consulta que debe ir aquí arriba)
$userData = $conn->query("SELECT username, level, xp, avatar, vol_master FROM users WHERE id=$user_id")->fetch_assoc();
$username = $userData["username"];
$level = $userData["level"];
$xp = $userData["xp"];
$avatar = $userData["avatar"];
$vol_db = $userData["vol_master"] ?? 0.50; 

$xp_needed = 50;
$progress = ($xp % $xp_needed) / $xp_needed * 100;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RPG Launcher - Dashboard</title>
    <style>
        :root {
            --rpg-gold: #d4af37;
            --rpg-brown: #3e2723;
            --parchment: #fdf5e6;
            --glow: 0 0 15px rgba(212, 175, 55, 0.5);
        }

        body {
            background: url('images/laun.png') no-repeat center center fixed;
            background-size: cover;
            background-color: #050505;
            color: #f0e68c;
            font-family: 'Crimson Text', serif;
            margin: 0;
            padding-bottom: 50px;
        }

        /* --- NAVEGACIÓN --- */
        .top-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 15px 30px;
            background: linear-gradient(to bottom, rgba(0,0,0,0.9), transparent);
            border-bottom: 3px solid var(--rpg-gold);
        }

        .btn-nav, .btn-rpg {
            background: linear-gradient(145deg, #4e342e, #3e2723);
            color: var(--rpg-gold);
            border: 2px solid var(--rpg-gold);
            padding: 10px 18px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            display: inline-block;
            box-shadow: 3px 3px 0px #000;
        }

        .btn-nav:hover, .btn-rpg:hover, .btn-active {
            background: var(--rpg-gold);
            color: var(--rpg-brown);
            transform: translateY(-2px);
            box-shadow: 0 0 15px var(--rpg-gold);
        }

        /* --- PERFIL --- */
        .profile-box {
            display: flex;
            align-items: center;
            gap: 30px;
            padding: 30px;
            margin: 40px auto;
            max-width: 850px;
            background: rgba(20, 20, 20, 0.85);
            border: 4px double var(--rpg-gold);
            border-radius: 8px;
        }

        .profile-pic-container {
            width: 120px; height: 120px;
            border: 3px solid var(--rpg-gold);
            overflow: hidden;
            box-shadow: var(--glow);
        }

        .profile-pic-container img { width: 100%; height: 100%; object-fit: cover; }

        .xp-container {
            width: 350px; height: 18px;
            background: #1a1a1a; border: 1px solid var(--rpg-gold); margin-top: 10px;
        }

        .xp-bar { height: 100%; background: linear-gradient(90deg, #b8860b, #ffd700); }

        .guild-title {
            text-align: center; color: var(--rpg-gold);
            background: rgba(0,0,0,0.6); padding: 15px;
            border-top: 2px solid var(--rpg-gold); border-bottom: 2px solid var(--rpg-gold);
            margin: 40px 0; letter-spacing: 5px;
        }

        .container { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
            gap: 30px; padding: 40px 8%; 
        }

        .card {
            background: #dcc5a1; padding: 15px;
            border: 2px solid #5d4037; border-radius: 4px; color: #2b1d0e;
        }

        .card img { width: 100%; height: 160px; object-fit: cover; }
        
        /* Clase clave para identificar visualmente un favorito */
        .is-favorite { background: #ffcc00 !important; color: black !important; }
    </style>
</head>
<body>

<div class="top-buttons">
    <button id="mainFavBtn" class="btn-rpg" onclick="toggleFavoritesFilter()">⭐ Favoritos</button>
    <a href="ranking.php" class="btn-nav">🌍 Ranking</a>
    <a href="achievements.php" class="btn-nav">🏆 Logros</a>
    <a href="friends.php" class="btn-nav">👥 Amigos</a>
    <a href="configuracion.php" class="btn-nav">⚙️ Config</a>
</div>

<div class="profile-box">
    <div class="profile-pic-container">
        <img src="uploads/<?php echo $avatar ?: 'default.png'; ?>?t=<?php echo time(); ?>">
    </div>
    <div>
        <h2 style="margin:0; color:var(--rpg-gold);">Bienvenido, <?php echo htmlspecialchars($username); ?></h2>
        <h3 style="margin:5px 0;">🎖 NIVEL <?php echo $level; ?></h3>
        <div class="xp-container"><div class="xp-bar" style="width: <?php echo $progress; ?>%"></div></div>
        <p style="color:var(--rpg-gold); font-weight:bold;">EXP: <?php echo $xp; ?> / 50</p>
    </div>
</div>

<div style="text-align:center; margin-bottom: 20px;">
    <input type="text" id="searchGame" placeholder="Buscar en el archivo..." onkeyup="searchGame()" 
           style="padding:10px; width:300px; border: 2px solid var(--rpg-brown); background: var(--parchment);">
</div>

<h2 class="guild-title">BIBLIOTECA DEL GREMIO</h2>

<div class="categorias" style="display:flex; justify-content:center; gap:10px; margin-bottom:20px; flex-wrap: wrap;">
    <button class="btn-rpg" onclick="filterByCategory('')">TODAS</button>
    <button class="btn-rpg" onclick="filterByCategory('Fantasía')">FANTASÍA</button>
    <button class="btn-rpg" onclick="filterByCategory('Mundo Abierto')">MUNDO ABIERTO</button>
    <button class="btn-rpg" onclick="filterByCategory('Acción')">ACCIÓN</button>
    <button class="btn-rpg" onclick="filterByCategory('Anime')">ANIME</button>
    <button class="btn-rpg" onclick="filterByCategory('Turnos')">TURNOS</button>
</div>

<div class="container" id="gamesContainer">
    <?php include "fetch_games.php"; ?>
</div>

<div id="game-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.95); z-index:9999;">
    <div style="padding: 10px; background: #222; display: flex; justify-content: space-between; align-items: center;">
        <span style="color: gold; font-family: 'Courier New', monospace;">RPG BROWSER v1.0</span>
        <button onclick="cerrarMarco()" style="background: #ff4444; color: white; border: none; padding: 5px 15px; cursor: pointer; font-weight: bold; border-radius: 3px;">VOLVER AL LAUNCHER [X]</button>
    </div>
    <iframe id="game-iframe" src="" style="width:100%; height:calc(100% - 45px); border:none; background: white;"></iframe>
</div>

<script>
    let currentFilter = 'all';
    let favoritesOnly = false;

    function loadGames(val, type = 'filter') {
        let params = (type === 'category') ? `category=${val}` : `filter=${val}`;
        fetch("fetch_games.php?" + params)
            .then(res => res.text())
            .then(data => {
                document.getElementById("gamesContainer").innerHTML = data;
                // Si el filtro de favoritos estaba activo, lo reaplicamos a la nueva carga
                if(favoritesOnly) reapplyFavoritesFilter();
            });
    }

    function filterByCategory(cat) {
        favoritesOnly = false;
        document.getElementById("mainFavBtn").classList.remove('btn-active');
        loadGames(cat, 'category');
    }

    function searchGame() {
        let query = document.getElementById("searchGame").value;
        fetch('fetch_games.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'search=' + encodeURIComponent(query)
        })
        .then(res => res.text())
        .then(data => {
            document.getElementById("gamesContainer").innerHTML = data;
            if(favoritesOnly) reapplyFavoritesFilter();
        });
    }

    // INTERRUPTOR DE LA VISTA DE FAVORITOS (FRONTEND)
    function toggleFavoritesFilter() {
        favoritesOnly = !favoritesOnly;
        const btn = document.getElementById('mainFavBtn');
        if (favoritesOnly) {
            btn.classList.add('btn-active');
        } else {
            btn.classList.remove('btn-active');
        }
        reapplyFavoritesFilter();
    }

    // Función auxiliar para ocultar/mostrar elementos según atributo data-favorite
    function reapplyFavoritesFilter() {
        const games = document.querySelectorAll('.game-card');
        games.forEach(game => {
            if (favoritesOnly) {
                const isFav = game.getAttribute('data-favorite') === 'true'; 
                game.style.display = isFav ? 'block' : 'none';
            } else {
                game.style.display = 'block';
            }
        });
    }

    // ACCIÓN DE AGREGAR O QUITAR FAVORITO CON FETCH (ACTUALIZA EL ATRIBUTO)
    function toggleFavorite(gameId) {
        const btn = document.getElementById(`fav-btn-${gameId}`);
        const tarjeta = btn.closest('.game-card');

        fetch(`favorite.php?id=${gameId}`)
            .then(res => res.text())
            .then(data => {
                if (data.trim() === "OK") {
                    if (btn.classList.contains('is-favorite')) {
                        btn.classList.remove('is-favorite');
                        btn.innerText = '⭐ FAVORITO';
                        if (tarjeta) tarjeta.setAttribute('data-favorite', 'false');
                        if (favoritesOnly && tarjeta) tarjeta.style.display = 'none';
                    } else {
                        btn.classList.add('is-favorite');
                        btn.innerText = '✖️ REMOVER';
                        if (tarjeta) tarjeta.setAttribute('data-favorite', 'true');
                    }
                }
            })
            .catch(err => console.error("Error:", err));
    }

    function abrirMarcoContenido(link) {
        document.getElementById('game-iframe').src = link;
        document.getElementById('game-overlay').style.display = 'block';
    }

    function cerrarMarco() {
        document.getElementById('game-iframe').src = "";
        document.getElementById('game-overlay').style.display = 'none';
    }
</script>

</body>
</html>
