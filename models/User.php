<?php

class User{

    private $connection;

    private $id;
    private $username;
    private $password;

    /**
     * Crea la conexión a la base de datos
     */
    public function __construct(){
        $database = new Database();
        $db = $database->connect();
        $this->connection = $db;
    }


    /**
     * Registra un usuario en la base de datos
     * @return bool true si usuario se ha guardado correctamente, false si no
     */
    public function save(){
        $result = false;
        try{
            $query = 'INSERT INTO users SET username = :username, password = :password';
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);

            if($stmt->execute()) $result = true;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }

    /**
     * Obtiene un usuario de la base de datos por su nombre de usuario
     * @return mixed devuelve un usuario de la base de datos por su nombre. Si no coincide con ningún registro, devuelve false
     */
    public function log(){
        $result = false;

        try{
            $query = 'SELECT * FROM users WHERE username = :username';
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':username', $this->username);
            if($stmt->execute() && $stmt->rowCount() == 1) $result = $stmt->fetchObject();
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }

        return $result;
    }

    /**
     * Determina si un nombre de usuario ya está en uso
     * @return bool true si ya está en uso, false si está libre
     */
    public function userExits(){
        $result = false;
        try{
            $query = 'SELECT * FROM users WHERE username = :username';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            if($stmt->rowCount() == 1) $result = true;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }

    /**
     * Obtiene la contraseña encriptada de un usuario en la base de datos
     * @return mixed devuelve la contraseña si el usuario existe, y false si no hay ningún registro con dicho nombre de usuario
     */
    public function getHashPassword() {
        $result = false;
        try{
            $query = 'SELECT password FROM users WHERE username = :username';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            if($stmt->rowCount() == 1) $result = $stmt->fetchObject()->password;
        }catch(PDOException $pdoe){
            echo 'Error: '.$pdoe->getMessage();
        }
        return $result;
    }
    

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = password_hash($password,  PASSWORD_DEFAULT);
    }
}