<?php
class Database {

    // укажите свои учетные данные базы данных
    private $host = "";
    private $db_name = "";
    private $username = "";
    private $password = "";
    private $port = 0;
    public $conn;

    // получаем соединение с БД
    public function getConnection(){

        $this->conn = null;

        try {
            $this->conn = new PDO('pgsql:host='.$this->host.';port='.$this->port.';dbname='.$this->db_name.';user='.$this->username.';password='.$this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
