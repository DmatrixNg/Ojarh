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
$user->senderusername = isset($_POST['senderusername']) ? $_POST['senderusername'] : die();
$user->againstusername = isset($_POST['againstusername']) ? $_POST['againstusername'] : die();
$user->dispute_message = isset($_POST['dispute_message']) ? $_POST['dispute_message'] : die();
$user->disputeid = isset($_POST['disputeid']) ? $_POST['disputeid'] : die();
$user->senderid = isset($_POST['senderid']) ? $_POST['senderid'] : die();
$user->againstid = isset($_POST['againstid']) ? $_POST['againstid'] : die();
$user->messageby = $_SESSION['userid'];

$user->who = $_SESSION['userid'];
$user->role = $_SESSION['role'];

if($user->who == $user->senderid || $user->who == $user->againstid){
	if ($user->processDisputeUser()) {
		echo 'success';
		return true;
	}
}else{
	echo 'You have no permission to perform this task!';
	return;
}
