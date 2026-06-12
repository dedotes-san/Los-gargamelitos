<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) { exit(); }

$my_id = $_SESSION["user_id"];
$friend_id = $_GET["friend_id"] ?? 0;

// Marcar como leídos
$conn->query("
UPDATE messages 
SET status='seen' 
WHERE receiver_id=$my_id 
AND sender_id=$friend_id 
AND status='sent'
");

// Obtener mensajes
$stmt = $conn->prepare("
SELECT * FROM messages 
WHERE (sender_id = ? AND receiver_id = ?) 
OR (sender_id = ? AND receiver_id = ?) 
ORDER BY id ASC
");

$stmt->bind_param("iiii",
    $my_id,
    $friend_id,
    $friend_id,
    $my_id
);

$stmt->execute();
$result = $stmt->get_result();

while($msg = $result->fetch_assoc()){

    $isMe = ($msg["sender_id"] == $my_id);
    $clase = $isMe ? "me" : "other";
    $time = date("H:i", strtotime($msg["created_at"]));

    echo "<div class='msg $clase'>";

    // 💬 MENSAJE TEXTO
    if(!empty($msg["message"])){

        echo htmlspecialchars($msg["message"]);
        echo "<br>";

    }

    // 📎 ARCHIVO / IMAGEN
    if(!empty($msg["file"])){

        $file = "uploads/messages/" . $msg["file"];
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $image_ext = ["jpg","jpeg","png","gif","webp"];

        // 🖼 SI ES IMAGEN
        if(in_array($ext, $image_ext)){

            echo "
            <img src='$file' 
            style='
            max-width:200px;
            border-radius:10px;
            margin-top:5px;
            cursor:pointer;
            ' 
            onclick=\"window.open('$file','_blank')\">
            ";

        }

        // 📄 SI ES ARCHIVO
        else{

            echo "
            <a href='$file' 
            target='_blank'
            style='
            display:inline-block;
            margin-top:5px;
            padding:5px 10px;
            border:1px solid red;
            border-radius:5px;
            color:white;
            text-decoration:none;
            '>
            📎 Descargar archivo
            </a>
            ";

        }

    }

    // ⏰ HORA + ✔✔
    echo "
    <div style='
    font-size:9px;
    opacity:0.7;
    text-align:right;
    margin-top:4px;
    '>";

    echo $time;

    if($isMe){

        if($msg["status"] == "seen"){
            echo " <span style='color:#ff0000;'>✔✔</span>";
        }
        else{
            echo " ✔";
        }

    }

    echo "</div>";

    echo "</div>";
}
?>
