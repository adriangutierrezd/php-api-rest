<?php


class Database{


    private $host = 'localhost';
    private $db_name = 'php_api_rest';
    private $db_user = 'root';
    private $db_password = '';
    private $connection;

    /**
     * Genera la conexión a la base de datos
     * @return PDO|null devuelve la conexión si la operación es exitosa, null si no lo es
     */
    public function connect(){
        $this->connection = null;
        try{
            $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->db_user, $this->db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $pdoe){
            echo 'Connection error: '.$pdoe->getMessage();
        }
        return $this->connection;
    }

}