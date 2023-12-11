<?php
class Update 
{
    private $conn;
    private $table = "posts";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public $title;
    public $category_id;
    public $body;
    public $author;
    public $id;

    public function update_by_id()
    {
        $query = "UPDATE {$this->table} SET 
        title = :title , body = :body ,category_id = :category_id , author =:author,post_date = now() 
        WHERE id = :id";
        $stmnt = $this->conn->prepare($query);
        $stmnt->bindParam("title",$this->title);
        $stmnt->bindParam("id",$this->id);
        $stmnt->bindParam("body",$this->body);
        $stmnt->bindParam("category_id",$this->category_id);
        $stmnt->bindParam("author",$this->author);
        if($stmnt->execute()){
            return true;
        }else{
            return false;
        }
        
    }
}