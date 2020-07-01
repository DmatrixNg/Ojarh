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
$user->plan = isset($_POST['plan']) ? $_POST['plan'] : die();
$user->durate = isset($_POST['durate']) ? $_POST['durate'] : die();
$user->useremail = isset($_POST['useremail']) ? $_POST['useremail'] : die();
$user->userid =  $_SESSION['userid'];

if ($user->upgrade_plan()) {
	echo 'success';
	return true;
}