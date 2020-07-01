<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Controller.php';
include_once '../models/core.php';

//Instantiate DB & connect
// $database = new Database();
// $db = $database->connect();

$db = getDB();

$user = new Users($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$receiverid = isset($_POST['receiverid']) ? $_POST['receiverid'] : 'Error, field(s) cannot be empty!';
$b_message = isset($_POST['b_message']) ? $_POST['b_message'] : 'Error, field(s) cannot be empty!';


$status = 'Pending';
$date_message = date("Ymdhms");

if ($user->reply_chat_messages($receiverid,$b_message,
$status,$date_message)) {
    echo 'Sent successfully!';
    return true;
}
