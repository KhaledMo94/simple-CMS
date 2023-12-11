<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Authorization,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin");


require_once("../core/intialize.php");
require_once("../core/date.php");

$data = json_decode(file_get_contents("php://input"));

$date = new Date($db);
$date->category_name = $data ->category_name;
$res = $date->search_date();
$num = $res ->rowCount();
// echo $num;
if($num>0){
    while($row = $res->fetch(PDO::FETCH_ASSOC)){
        echo json_encode(['date_created',$row['created_at']]);
    }
}else{
    echo json_encode(['Message','No such category found']);
}