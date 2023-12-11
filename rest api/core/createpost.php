<?php
class CreatePost
{
    private $conn;
    private $table;

    // post fields

    public function __construct($db,$table)
    {
        $this->conn = $db;
        $this->table = $table;
    }

    public $category_id;
    public $title;
    public $body;
    public $author;

    public function insert(){
        $query = "INSERT INTO {$this->table} 
            (category_id,title,body,author) VALUES
            (:category_id,:title,:body,:author)";

        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));

        $stmnt = $this->conn ->prepare($query);
        $stmnt->bindParam(':title',$this->title);
        $stmnt->bindParam(':category_id',$this->category_id);
        $stmnt->bindParam(':body',$this->body);
        $stmnt->bindParam(':author',$this->author);

        if($stmnt ->execute()){
            return true;
        }
        printf("Error %s \n",$stmnt->error);
        return false;
    }
}