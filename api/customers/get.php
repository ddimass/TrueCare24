<?php
include_once '../config/database.php';
include_once 'customer.php';


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$customer = new Customer($db);



// чтение товаров будет здесь

$stmt = $customer->read();
$num = $stmt->rowCount();

if ($num>0) {

    // массив товаров
    $customers_arr=array();
    $customers_arr["records"]=array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее, чем fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($customers_arr["records"], $row);
    }

    // устанавливаем код ответа - 200 OK
    http_response_code(200);

    // выводим данные о товаре в формате JSON
    echo json_encode($customers_arr);
} else {

    // установим код ответа - 404 Не найдено
    http_response_code(404);

    // сообщаем пользователю, что товары не найдены
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}