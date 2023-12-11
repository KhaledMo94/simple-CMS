<?php
class Delete 
{
    private $conn;
    public $id;
    public $table;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function delete_row(){
        $query = "DELETE FROM {$this->table} WHERE id=:id";
        $stmnt = $this->conn->prepare($query);
        $stmnt->bindParam("id",$this->id);
        if($stmnt->execute()){
            return true;
        }else{
            return false;
        }
    }
}