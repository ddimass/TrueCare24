<?php
class Customer {

    // подключение к базе данных и таблице 'products'
    private $conn;
    private $table_name = "customers";

    // свойства объекта
    public $id;
    public $name;
    public $email;
    public $phone;
    public $status_id;
    public $type;


    // конструктор для соединения с базой данных
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){

        // выбираем все записи
        $query = "SELECT * FROM " .$this->table_name .";";
        $result = $this->conn->query($query);


        return $result;
    }
    public function update_status()
    {

        // выбираем все записи
        $this->status_id = htmlspecialchars(strip_tags($this->status_id));
        $query = "UPDATE
                " . $this->table_name . "
            SET
                status_id = :status_id
            WHERE
                id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $this->id);
        $stmt->bindValue(':status_id', $this->status_id);

        if ($stmt->execute()) {
            return true;
        }
        echo "\nPDO::errorInfo():\n";
        print_r($stmt->errorInfo());
        return false;
    }
}