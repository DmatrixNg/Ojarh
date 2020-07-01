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
$user->bizname = isset($_POST['bizname']) ? $_POST['bizname'] : die();
$user->bizphone = isset($_POST['bizphone']) ? $_POST['bizphone'] : die();
$user->bizemail = isset($_POST['bizemail']) ? $_POST['bizemail'] : die();
$user->bizregdate = isset($_POST['bizregdate']) ? $_POST['bizregdate'] : die();
$user->bizstate = isset($_POST['bizstate']) ? $_POST['bizstate'] : die();
$user->bizmarket = isset($_POST['bizmarket']) ? $_POST['bizmarket'] : die();
$user->bizaddress = isset($_POST['bizaddress']) ? $_POST['bizaddress'] : die();
$user->bizwebsite = isset($_POST['bizwebsite']) ? $_POST['bizwebsite'] : die();
$user->userid =  $_SESSION['userid'];
$user->status = 'Updated';

// echo json_encode($user->bizstate);
// return;

if ($user->createBusinessInfo()) {
	echo 'success';
	return true;
}