<?php

session_start();
include "database.php";

$user_id = $_SESSION["user_id"];

if(isset($_POST["search"])){

$search = $_POST["search"];

if(strlen($search) > 0){

// GUARDAR HISTORIAL
$stmtHistory = $conn->prepare("
INSERT INTO search_history 
(user_id, search_text) 
VALUES (?,?)
");

$stmtHistory->bind_param("is",$user_id,$search);

$stmtHistory->execute();

// BUSCAR USUARIOS
$stmt = $conn->prepare("
SELECT id, username, profile_pic 
FROM users 
WHERE username LIKE CONCAT(?, '%')
AND id != ?
LIMIT 5
");

$stmt->bind_param("si",$search,$user_id);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

while($s = $result->fetch_assoc()){

echo "

<div class='card'>

<div style='display:flex;
align-items:center;
gap:10px;'>

<img src='uploads/".($s['profile_pic'] ?: 'default.png')."' 
style='width:35px;
height:35px;
border-radius:50%;'>

<span>".$s['username']."</span>

</div>

<a href='add_friend.php?id=".$s['id']."' 
class='btn'
style='font-size:12px;'>

AÑADIR

</a>

</div>

";

}

}else{

echo "
<p style='font-size:12px;color:#888;'>
No se encontró nadie.
</p>
";

}

}

}

?>
