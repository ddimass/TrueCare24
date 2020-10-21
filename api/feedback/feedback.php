<?php
class Feedback {

    // подключение к базе данных и таблице 'products'
    private $conn;
    private $table_name = "feedback";

    // свойства объекта
    public $id;
    public $value;
    public $message;
    public $customer_id;


    // конструктор для соединения с базой данных
    public function __construct($db){
        $this->conn = $db;
    }

    public function read($id){

        // выбираем все записи
        $query = "SELECT * FROM " .$this->table_name . " where customer_id=" . $id;
        $result = $this->conn->query($query);


        return $result;
    }
    public function set_feedback()
    {
        if (isset($this->id)) {
            $query = "
            update
                " . $this->table_name . " 
            set 
               value = :value, 
               message = :message, 
               customer_id = :customer_id, 
               datetime = :datetime
            where
                id = ". $this->id ."
            ";
        } else {
            $query = "
            insert into
                " . $this->table_name . " (value, message, customer_id, datetime)
            VALUES (:value, :message, :customer_id, :datetime);
            ";
        }

        $stmt = $this->conn->prepare($query);
        $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
        $this->message=htmlspecialchars(strip_tags($this->message));
        $this->value=htmlspecialchars(strip_tags($this->value));
        $stmt->bindValue(':value', $this->value);
        $stmt->bindValue(':message', $this->message);
        $stmt->bindValue(':customer_id', $this->customer_id);
        $date = new DateTime('NOW');
        $stmt->bindValue(':datetime', $date->format('Y-m-d H:i'));

        if ($stmt->execute()) {
            return true;
        }
        echo "\nPDO::errorInfo():\n";
        print_r($stmt->errorInfo());
        return false;
    }
}