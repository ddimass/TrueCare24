<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключаем файл для работы с БД и объектом Product
include_once '../config/database.php';
include_once 'customer.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;}

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$customer = new Customer($db);

// получаем id товара для редактирования
$postData = file_get_contents('php://input');
$data = json_decode($postData);

// установим id свойства товара для редактирования
$customer->id = $data->id;
// установим значения свойств товара
$customer->status_id = $data->status_id;

// обновление товара
if ($customer->update_status()) {

    // установим код ответа - 200 ok
    http_response_code(200);

    // сообщим пользователю
    echo json_encode(array("message" => "Updated"), JSON_UNESCAPED_UNICODE);
}

// если не удается обновить товар, сообщим пользователю
else {

    // код ответа - 503 Сервис не доступен
    http_response_code(503);

    // сообщение пользователю
    echo json_encode(array("message" => "Fail"), JSON_UNESCAPED_UNICODE);
}
