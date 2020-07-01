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
// sponsor generated id
$column = isset($_POST['column']) ? $_POST['column'] : die();
$value = isset($_POST['value']) ? $_POST['value'] : die();
if($_SESSION['role'] == 'Admin'){
	if ($user->updateSettings($column, $value)) {
		echo 'Settings Update';
		return true;
	} else {
		echo 'Update Failed!';
		return;	
	}
}else{
	echo 'You have no permission to perform this task!';
	return;
}
