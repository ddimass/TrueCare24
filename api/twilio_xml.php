<?php
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

use Twilio\TwiML\VoiceResponse;

// Start our TwiML response
$response = new VoiceResponse;

$phone = htmlspecialchars($_GET["phone"]);

// Read a message aloud to the caller
//$response->say(
//    "Thank you for calling! Have a great day.",
//    array("voice" => "alice")
//);
$response->dial('+'.$phone);
echo $response;