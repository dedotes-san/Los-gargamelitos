<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "sql202.infinityfree.com";
$username = "if0_41439069";
$password = "NTw4mR0lFYe";
$dbname = "if0_41439069_rpg_launcher";

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>
