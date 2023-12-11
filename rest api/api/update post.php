<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");
header("Access-Control-Allow-Methods:PUT");
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Authorization,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin");

require_once("../core/intialize.php");
require_once("../core/update.php");

$inputs = json_decode(file_get_contents("php://input"));

$update = new Update($db);

$inputs->id = htmlspecialchars(strip_tags($inputs->id));
$inputs->body = htmlspecialchars(strip_tags($inputs->body));
$inputs->title = htmlspecialchars(strip_tags($inputs->title));
$inputs->author = htmlspecialchars(strip_tags($inputs->author));
$inputs->category_id = htmlspecialchars(strip_tags($inputs->category_id));


$update->id = $inputs->id;
$update->body = $inputs->body;
$update->title = $inputs->title;
$update->author = $inputs->author;
$update->category_id = $inputs->category_id;

if($update->update_by_id()){
    echo json_encode(['Message','Post Updated']);
}else{
    echo json_encode(['Message','Try Again']);
}
