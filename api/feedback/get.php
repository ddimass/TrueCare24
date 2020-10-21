<?php
include_once '../config/database.php';
include_once 'feedback.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$feedback = new Feedback($db);


$id = htmlspecialchars($_GET["id"]);
// чтение товаров будет здесь

$stmt = $feedback->read($id);
$num = $stmt->rowCount();

if ($num>0) {

    // массив товаров
    $feedback_arr=array();
    $feedback_arr["records"]=array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее, чем fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($feedback_arr["records"], $row);
    }

    // устанавливаем код ответа - 200 OK
    http_response_code(200);

    // выводим данные о товаре в формате JSON
    echo json_encode($feedback_arr['records'][0]);
} else {

    // установим код ответа - 404 Не найдено
    http_response_code(200);

    // сообщаем пользователю, что товары не найдены
    echo json_encode(array("message" => "Not found"), JSON_UNESCAPED_UNICODE);
}