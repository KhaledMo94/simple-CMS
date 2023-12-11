<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");
header("Access-Control-Allow-Methods:DELETE");
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin,Authorization");

require_once("../core/intialize.php");
require_once("../core/deletion.php");

$data = json_decode(file_get_contents("php://input"));

$delete = new Delete($db);
$delete->id = $data->id;
$delete->table = $data->table;

$res = $delete->delete_row();

if($res==true){
    echo json_encode(["Message","Row Deleted"]);
}else{
    echo json_encode(["Message","Row didnt Deleted"]);
}