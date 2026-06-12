<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include "database.php";

$user_id = $_SESSION["user_id"] ?? 0;

// 1. DETERMINAR LA CONSULTA SEGÚN EL FILTRO
if (isset($_GET['filter']) && $_GET['filter'] == 'favorites') {
    $sql = "SELECT g.* FROM games g 
            INNER JOIN favorites f ON g.id = f.game_id 
            WHERE f.user_id = $user_id";
} 
elseif (isset($_GET['category']) && !empty($_GET['category'])) {
    $cat = $conn->real_escape_string($_GET['category']);
    $sql = "SELECT * FROM games WHERE genre LIKE '%$cat%'";
} 
elseif (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM games WHERE name LIKE '%$search%'";
} 
else {
    $sql = "SELECT * FROM games";
}

$result = $conn->query($sql);

// 2. MOSTRAR RESULTADOS
if (!$result || $result->num_rows == 0) {
    echo "<p style='color:white;text-align:center;grid-column:1/-1;'>No se encontraron juegos.</p>";
} else {
    while($row = $result->fetch_assoc()) {
        $game_id = $row['id'];
        $name    = $row['name'];
        $genre   = $row['genre'];
        $image   = $row['image'];
        $url     = $row['url'];
        
        // Verificación exacta usando el ID de tu juego (12) o su nombre
        $esMiJuego = ($game_id == 12 || $name == 'Senda del Destino');
        
        // Lógica de favoritos en base de datos
        $checkFav = $conn->query("SELECT id FROM favorites WHERE user_id=$user_id AND game_id=$game_id");
        $isFav = ($checkFav && $checkFav->num_rows > 0);
        $favClass = $isFav ? "is-favorite" : "";
        $favText = $isFav ? "🌟 REMOVER" : "⭐ FAVORITO";
        $dataFav = $isFav ? "true" : "false";

        echo "
        <div class='card game-card' data-favorite='$dataFav'>
            <img src='images/" . htmlspecialchars($image) . "' onerror=\"this.src='images/laun.png'\">
            <h3>" . htmlspecialchars($name) . "</h3>
            <p>" . htmlspecialchars($genre) . "</p>
            
            <div style='display:flex; gap:5px;'>";
                
                // CONDICIÓN PARA EL BOTÓN DE ACCIÓN PRINCIPAL
                if ($esMiJuego) {
                    // Si es tu juego, lo carga dentro del iframe del Launcher
                    echo "<button onclick=\"abrirMarcoContenido('" . htmlspecialchars($url) . "')\" 
                                  style='width:100%; cursor:pointer; font-weight:bold;' class='btn-rpg'>
                              ▶ JUGAR
                          </button>";
                } else {
                    // Si es de Steam/Epic, un enlace limpio que abre una nueva pestaña (_blank)
                    echo "<a href='" . htmlspecialchars($url) . "' target='_blank' 
                             style='width:100%; text-align:center; font-weight:bold; box-sizing: border-box;' class='btn-rpg'>
                              🛒 TIENDA
                          </a>";
                }
                
        echo "
            </div>

            <button id='fav-btn-$game_id' 
                    class='btn-rpg $favClass' 
                    onclick='toggleFavorite($game_id)' 
                    style='width:100%; margin-top:8px;'>
                $favText
            </button>
        </div>";
    } // Cierre del while
} // Cierre del else principal
?>
