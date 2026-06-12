<?php

$conn = new mysqli("localhost","root","","rpg_launcher");

$category = $_GET['category'];

if($category == "all"){
    $sql = "SELECT * FROM games";
}else{
    $sql = "SELECT * FROM games WHERE id_category = $category";
}

$result = $conn->query($sql);

$games = [];

while($row = $result->fetch_assoc()){
    $games[] = $row;
}

echo json_encode($games);

?>
