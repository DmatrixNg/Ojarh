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
$user->messid = isset($_POST['messid']) ? $_POST['messid'] : die();
$user->action = isset($_POST['action']) ? $_POST['action'] : die();

$user->who = $_SESSION['userid'];
$user->role = $_SESSION['role'];

if($user->who == "1111" && $user->role == "Admin"){
	if ($user->updateMessageStatus($user->messid, trim($user->action))) {
		return "success";
	}

}else{
	echo 'You have no permission to perform this task!';
	return;
}
