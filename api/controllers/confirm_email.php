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
//$data = json_decode(file_get_contents("php://input"));

//sponsor generated id
$user->auth_id = isset($_GET['auth_id']) ? $_GET['auth_id'] : '';
$user->conf_id = 0;
$user->status = 1;

if($user->confirm_email()){
    header('location: '.BASE_URL.'signin.php?mess=Email confirmation successful!');
    return;
}else{
    header('location: '.BASE_URL.'signin.php?mess=Problem activating your account, contact our customer care!');
    return;
}