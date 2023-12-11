<?php
class Date 
{
    private $conn;
    private $table = "category";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $date;
    public $category_name;

    public function search_date(){
        $query = "SELECT created_at FROM {$this->table}
                    WHERE name = :cname";
        $stmnt = $this->conn->prepare($query);
        $stmnt ->bindParam("cname",$this->category_name);
        $stmnt->execute();
        return $stmnt;
    }
}