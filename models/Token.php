<?php


class Token{

    private $connection;

    private $id;
    private $user_id;
    private $token;

    /**
     * Crea la conexión a la base de datos
     */
    public function __construct(){
        $database = new Database();
        $db = $database->connect();
        $this->connection = $db;
    }


    /**
     * Obtiene el token de un usuario por su id
     * @return mixed devueleve el token del usuario en caso de que exista, y false si dicho usuario no tiene token
     */
    public function getToken(){
        $result = false;
        try{
            $query = 'SELECT token FROM tokens WHERE user_id = :user_id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':user_id', $_SESSION['login']->id);
            if($stmt->execute() && $stmt->rowCount() == 1) $result = $stmt->fetchObject()->token;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }

    /**
     * Determina si un token existe en la base de datos
     * @param $token token a verificar
     * @return bool true si existe, false si no existe
     */
    public function existsToken($token){
        $result = false;
        try{
            $query = 'SELECT * FROM tokens WHERE token = :token';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            if($stmt->rowCount() == 1) $result = true;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }


    /**
     * Genera un token aleatorio
     * @return void
     */
    public function createToken(){
        try{
            $this->token = bin2hex(random_bytes(16));
        }catch(Exception $e){
            echo 'Error: '.$e->getMessage();
        }
        $this->saveToken();
    }

    /**
     * Guarda un token en la base de datos
     * @return bool true si la operación es exitosa, false si no lo es
     */
    private function saveToken(){
        $result = false;
        try{
            $query = 'INSERT INTO tokens SET user_id = :user_id, token = :token';
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':user_id', $_SESSION['login']->id);
            $stmt->bindParam(':token', $this->token);

            if($stmt->execute()) $result = true;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }

}