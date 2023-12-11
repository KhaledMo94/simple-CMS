<?php 
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization");

require_once("../core/intialize.php");

require_once("../core/createpost.php");

$create_post = new CreatePost($db,"posts");

//get the posted data

$data = json_decode(file_get_contents("php://input"));

$create_post->title = $data->title;
$create_post->author = $data->author;
$create_post->body = $data->body;
$create_post->category_id = $data->category_id;

if($create_post->insert()){
    echo json_encode(array("Message","Post Saved"));
}else{
    echo json_encode(array("Message","Post Not Created"));
}