<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin,Authorization");

require_once("../core/intialize.php");
require_once("../core/createcategory.php");

$create_category = new CreateCategory($db);

$data = json_decode(file_get_contents("php://input"));

$create_category->name = $data ->name;

if($create_category->insert()){
    echo json_encode(array("Message","Category Saved"));
}else{
    echo json_encode(array("Message","Category not Saved"));
};