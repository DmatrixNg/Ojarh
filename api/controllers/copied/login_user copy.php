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

$user->username = htmlspecialchars(trim($_POST['username']));
$user->password = htmlspecialchars(trim($_POST['password']));

if ($user->userLogin($user->username, $user->password)) {
	return true;
}