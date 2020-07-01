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

//get posted data
$data = json_decode(file_get_contents("php://input"));

// $user->username = $data->username;
// $user->password = $data->password;

$user->email = isset($_POST['sub_email']) ? $_POST['sub_email'] : die("email is empty");

if ($user->subscription()) {
    echo 'You have successfully subscribe to our newsletter, thank you!';
    return true;
}