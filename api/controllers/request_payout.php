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
$user->userid = isset($_POST['userid']) ? $_POST['userid'] : die();
$user->amount = isset($_POST['amount']) ? $_POST['amount'] : die();
$user->name = isset($_POST['name']) ? $_POST['name'] : die();
$user->accountnumber = isset($_POST['accountnumber']) ? $_POST['accountnumber'] : die();
$user->description = isset($_POST['description']) ? $_POST['description'] : die();
$user->role = $_SESSION['role'];

if ($user->payout_request($user->userid,$user->amount,$user->name,$user->accountnumber,$user->description)) {

		header('Location: '.BASE_URL.strtolower($user->role).'/wallet.php?result=Request Sent!');

		return true;
}else {
	header('Location: '.BASE_URL.strtolower($user->role).'/wallet.php?result=You have a pending Required!');

	return true;
}
