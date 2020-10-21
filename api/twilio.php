<?php
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client;

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
}

$postData = file_get_contents('php://input');
$data = json_decode($postData);

$account_sid = $data->twilio_sid;
$auth_token = $data->twilio_token;
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with Voice capabilities
$twilio_number = $data->twilio_number;
$admin_number = $data->admin_number;

// Where to make a voice call (your cell phone?)
$to_number = $data->provider_number;

$client = new Client($account_sid, $auth_token);
$client->account->calls->create(
    '+'.$to_number,
    '+'.$twilio_number,
    array(
        "url" => "http://". $config->api_url ."/api/twilio_xml.php?phone=" . $admin_number
    )
);
error_log($account_sid . " - " . $auth_token . " - " . $twilio_number . " - " . $to_number . " - " . $admin_number);
http_response_code(200);

// сообщим пользователю
echo json_encode(array("message" => "Updated"), JSON_UNESCAPED_UNICODE);