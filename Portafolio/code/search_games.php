<?php

include "database.php";
session_start();

$user_id = $_SESSION["user_id"];

if(isset($_POST["search"])){

$search = $_POST["search"];

$stmt = $conn->prepare("
SELECT * 
FROM games 
WHERE name 
LIKE CONCAT(?, '%')
OR genre 
LIKE CONCAT('%', ?, '%')
");

$stmt->bind_param("ss",$search,$search);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

while($game = $result->fetch_assoc()){

$g_id = $game['id'];

$checkFav = $conn->query("
SELECT id 
FROM favorites 
WHERE user_id = $user_id 
AND game_id = $g_id
");

$isFav = ($checkFav->num_rows > 0);

echo "

<div class='card'>

<img src='images/".($game['image'] ?: 'default_game.png')."'>

<h4>".$game['name']."</h4>

<p style='font-size:12px;color:#ccc;'>
<strong>Género:</strong>
".$game['genre']."
</p>

<div style='margin-top:15px;'>";

if($game["is_real"]){

echo "
<a href='".$game["url"]."' target='_blank'>
<button style='width:100%;'>
Tienda
</button>
</a>";

}else{

echo "
<a href='play.php?id=".$game["id"]."'>
<button style='width:100%;'>
JUGAR
</button>
</a>";

}

echo "

<a href='favorite.php?id=".$g_id."'>
<button style='width:100%;margin-top:8px;'>

".($isFav ? "❌ QUITAR DE FAVORITO" : "⭐ FAVORITO")."

</button>
</a>

</div>

</div>

";

}

}else{

echo "
<p style='text-align:center;
grid-column:1/-1;
color:#888;'>

No se encontraron juegos.

</p>
";

}

}

?>
