<?php

//conectar con la base de datos
class Database{
    //credenciales de usuario de la DB
    private $host = "localhost";
    private $db_name = "php_login_system";
    private $username = "root";
    private $pass = "";
    public $conn;
    
    //conexión db
    public function getConnection(){
        
        $this -> conn = null;
        
        try{
            $this -> conn = new PDO("mysql:host=" . $this -> host . ";dbname=" . $this->db_name, $this -> username, $this ->pass);
        }catch(PDOException $exception){
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>