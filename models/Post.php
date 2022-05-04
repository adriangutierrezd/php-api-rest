<?php

class Post{

    private $connection;

    private $id;
    private $category_id;
    private $category_name;
    private $title;
    private $body;
    private $author;
    private $created_at;

    /**
     * Crea la conexión a la base de datos
     */
    public function __construct(){
        $database = new Database();
        $db = $database->connect();
        $this->connection = $db;
    }

    /**
     * Obtiene todos los posts de la base de datos
     * @return mixed Objeto con los resultados de la query
     */
    public function read(){
        $result = false;
        try{
            $query = 'SELECT c.name AS category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at 
            FROM posts p INNER JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC';
            // Prepare statement
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            $result = $stmt;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }

    /**
     * Determina si un post existe o no a partir de su id
     * @return bool true si el post existe, false en caso contrario
     */
    public function existPost(){
        $result = false;
        try{
            $query = 'SELECT * FROM posts WHERE id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            if($stmt->rowCount() == 1) $result = true;
        }catch(PDOException $pdoe){
            'Error: '.$pdoe->getMessage();
        }
        return $result;
    }


    /**
     * Obtiene la información de un Post de la base de datos según su id
     * @return void
     */
    public function read_single(){
        try{
            $query = 'SELECT c.name AS category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at 
        FROM posts p INNER JOIN categories c ON p.category_id = c.id WHERE p.id = ?';
            // Prepare statement
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set data
            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->category_name = $row['category_name'];
            $this->category_id = $row['category_id'];
            $this->created_at = $row['created_at'];
            $this->author = $row['author'];
            $this->id = $row['id'];
        }catch(PDOException $pdoe){
            'Error: '.$pdoe->getMessage();
        }
    }

    /**
     * Crea una nuevo post en la base de datos
     * @return bool true si la operación es exitosa, false si no lo es
     */
    public function create() {
        $result = false;
        try{
            // Create query
            $query = 'INSERT INTO posts SET title = :title, body = :body, author = :author, category_id = :category_id';

            // Prepare statement
            $stmt = $this->connection->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);

            // Execute query
            if($stmt->execute()) $result = true;
        }catch(PDOException $pdoe){
            'Error: '.$pdoe->getMessage();
        }
        return $result;
    }

    /**
     * Actualiza un post en la base de datos
     * @return bool true si la operación es exitosa, false si no lo es
     */
    public function update() {
        $result = false;
        try{
            $query = 'UPDATE posts SET title = :title, body = :body, author = :author, category_id = :category_id 
            WHERE id = :id';

            $stmt = $this->connection->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);


            if($stmt->execute()) $result = true;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }

    /**
     * Elimina un post de la base de datos
     * @return bool true si elimina el post de forma exitosa, false en caso contrario
     */
    public function delete(){
        $result = false;
        try{
            $query = 'DELETE FROM posts WHERE id = :id';
            $stmt = $this->connection->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()) $result = true;
        }catch(PDOException $pdoe){
            echo 'Errror: '.$pdoe->getMessage();
        }
        return $result;
    }


    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function getCategoryId(){
        return $this->category_id;
    }

    public function getCategoryName(){
        return $this->category_name;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getBody(){
        return $this->body;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setCategoryId($category_id){
        $this->category_id = $category_id;
    }

    public function setBody($body){
        $this->body = $body;
    }

    public function setAuthor($author){
        $this->author = $author;
    }


}