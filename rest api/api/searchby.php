<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:Application/json");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin,Authorization");

require_once("../core/intialize.php");

require_once("../core/retrieveby.php");

$data = json_decode(file_get_contents("php://input"));

$retrieve = new RetrieveBy($db,$data->table);
$retrieve->value = $data->value;

$res = $retrieve->search();
$num = $res ->rowCount();
echo $num;

if ($num>0){
    $resulted_array = array();
    while($row = $res->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        if($data->table =="posts"){
            $retrieve->author = $row['author'];
            $retrieve->title = $row['title'];
            $retrieve->body = $row['body'];
            $retrieve->post_date = $row['post_date'];
            $retrieve->category_id = $row['category_id'];
            $result_item = array(
                "author"            =>$retrieve->author ,
                "title"             =>$retrieve->title,
                "body"              =>$retrieve->body,
                "post_date"         =>$retrieve->post_date,
                "category_id"       =>$retrieve->category_id
            );
            array_push($result_item,$resulted_array);
        }
        if($data->table =="category"){
            $retrieve->category = $row['category'];
            $retrieve->id = $row['id'];
            $retrieve->created_at = $row['created_at'];
            $result_item =array(
                'id'            =>$row['id'],
                'name'          =>$row['name'],
                'created_at'    =>$row['created_at']
            );
            array_push($result_item,$resulted_array);
        }
    }
    echo json_encode($resulted_array);
}else{
    echo json_encode(['Message','No such fields']);
}