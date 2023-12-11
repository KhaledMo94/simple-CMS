<?php

class RetrieveBy
{
    private $conn;
    private $table;

    public function __construct($db,$table)
    {
        $this->conn = $db;
        $this->table = $table;
    }

    public $value;

    public $author;
    public $title;
    public $body;
    public $post_date;
    public $category_id;
    public $category;
    public $id;
    public $created_at;

    public function search(){
        $query =    "SELECT * FROM ".$this->table." 
                    WHERE author LIKE ?";
        $stmnt = $this->conn ->prepare($query);
        $stmnt ->bindParam(1, $this->value);
        $stmnt ->execute();
        return $stmnt;
    }
}