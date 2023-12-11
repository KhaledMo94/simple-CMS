<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");


//Intializing API
include_once('../core/intialize.php');


//Instantiate Post
$post = new Post($db);

//Query Post
$result = $post ->read();

//affected rows
$num = $result -> rowCount();

if($num>0){
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result ->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            'id'            =>$id,
            'title'         =>$title,
            'author'        =>$author,
            'category_id'   =>$category_id,
            'category_name' =>$category_name,
            'body'          =>html_entity_decode($body)
        );
        array_push($post_arr['data'],$post_item);
    }
    //convert to json and output
    echo json_encode($post_arr);
}else{
    echo json_encode(["message" =>"No output"]);
}