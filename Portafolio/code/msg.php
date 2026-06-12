<?php
session_start();
include "database.php";

if (!isset($_SESSION["user_id"])) exit("No session");

$my_id = $_SESSION["user_id"];
$f = $_GET["friend_id"] ?? null;
$m = $_GET["message"] ?? "";

if (!$f || empty(trim($m))) exit("Datos incompletos");

// 1. Guardar en tu base de datos (Tu código original)
$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message, created_at, status) VALUES (?, ?, ?, NOW(), 'sent')");
$stmt->bind_param("iis", $my_id, $f, $m);
$stmt->execute();

// 2. Avisar a Pusher con tus llaves reales
$app_id = "2130471";
$key    = "90f21c869ad8d46a9415";
$secret = "f42c9a6dd1a595e60213";
$cluster = "us2";

$data_pusher = json_encode([
    'emisor'   => $my_id,
    'receptor' => $f,
    'usuario'  => $_SESSION['username'] ?? "Usuario", 
    'mensaje'  => htmlspecialchars($m)
]);

$timestamp = time();
$body = json_encode(['name' => 'nuevo-mensaje', 'channels' => ['rpg-chat'], 'data' => $data_pusher]);
$body_md5 = md5($body);
$auth_sig = hash_hmac('sha256', "POST\n/apps/$app_id/events\nauth_key=$key&auth_timestamp=$timestamp&auth_version=1.0&body_md5=$body_md5", $secret);

$url = "https://api-$cluster.pusher.com/apps/$app_id/events?auth_key=$key&auth_timestamp=$timestamp&auth_version=1.0&body_md5=$body_md5&auth_signature=$auth_sig";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);

echo "Enviado";
?>
