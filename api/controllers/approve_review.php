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
$user->reviewid = isset($_POST['reviewid']) ? $_POST['reviewid'] : die();
$user->sellerid = isset($_POST['sellerid']) ? $_POST['sellerid'] : die();
$user->admin = $_SESSION['userid'];
$user->role = $_SESSION['role'];
$user->status = 'Approved';

if($user->admin == 1111 AND $user->role == 'Admin'){
	if ($user->approveReview()) {
		echo 'success';
		return true;
	}
}else{
	echo 'You have no permission to perform this task!';
	return;
}
