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
$privacybtn = isset($_POST['privacybtn']) ? $_POST['privacybtn'] :"";
$user->privacy = isset($_POST['privacy']) ? $_POST['privacy'] : die();
$user->userid =  $_SESSION['userid'];
if ($privacybtn == 'on') {

	if ($user->updateprivacy()) {
		echo 'success';
		return true;
	}
}
