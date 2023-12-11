<?php

class CreateCategory 
{
    private $conn;
    private $table = "category";

    public $name;

    public function __construct($db)
    {
        $this->conn=$db;
    }

    function insert(){
        $query = "INSERT INTO {$this->table} (name) VALUES (:name)";
        $stmnt = $this->conn ->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $stmnt ->bindParam(":name",$this->name);

        if($stmnt->execute()){
            return true;
        }else{
            return false;
        }
    }
}