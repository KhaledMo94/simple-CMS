<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");

require_once("../core/intialize.php");


require_once("../core/post.php");

$post = new Post($db);
// $post ->read_single(2);
$post->id = isset($_GET['id'])?$_GET['id']:die("Post id Doesn`t setted.");

$post ->read_single($post->id);

$post_arr = array(
    'id'        =>$post->id,
    'title'     =>$post->title,
    'author'    =>$post->author,
    'body'      =>$post->body,
    'post_date' =>$post->post_date
);

$result = json_encode($post_arr);

echo $result;