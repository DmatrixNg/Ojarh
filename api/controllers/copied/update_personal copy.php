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
$user->fname = isset($_POST['fname']) ? $_POST['fname'] : die();
$user->lname = isset($_POST['lname']) ? $_POST['lname'] : die();
$user->phone = isset($_POST['phone']) ? $_POST['phone'] : die();
$user->address = isset($_POST['address']) ? $_POST['address'] : die();
$user->state = isset($_POST['state']) ? $_POST['state'] : die();
$user->userid =  $_SESSION['userid'];

if ($user->updatePersonalInfo()) {
	echo 'success';
	return true;
}