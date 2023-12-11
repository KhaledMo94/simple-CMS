<?php
class Post
{
    //db stuff
    private $conn;
    private $table = 'posts';


    //post 
    public $id;
    public $category ;
    public $category_id;
    public $body;
    public $title;
    public $author;
    public $post_date;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read from database

    public function read(){
        $query = "SELECT 
        c.name as category_name,
        p.id ,
        p.category_id ,
        p.body ,
        p.title ,
        p.author ,
        p.post_date 
        FROM ".$this->table." p 
        LEFT JOIN category c 
        ON p.category_id = c.id 
        ORDER BY p.post_date DESC";

        $stmnt = $this->conn ->prepare($query);
        $stmnt->execute();
        return $stmnt;
    }

    public function read_single($id){
        $query = "SELECT c.name as category_name,
                        p.id ,
                        p.category_id ,
                        p.body ,
                        p.title ,
                        p.author ,
                        p.post_date
                    FROM ".$this->table." p
                    LEFT JOIN category c
                    ON p.category_id = c.id
                    WHERE p.id = ?";
        
        $stmnt = $this ->conn->prepare($query);
        $stmnt->bindParam(1,$id);
        $stmnt ->execute();
        $row = $stmnt->fetch(PDO::FETCH_ASSOC);
        $this->title = $row['title'];
        $this->category = $row['category_name'];
        $this->body = $row['title'];
        $this->author = $row['author'];
        $this->post_date = $row['post_date'];
    }
}
