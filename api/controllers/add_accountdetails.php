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
$user->userid = $_SESSION['userid'];
$user->bankname = isset($_POST['bankname']) ? $_POST['bankname'] : die();
$user->accountnumber = isset($_POST['accountnumber']) ? $_POST['accountnumber'] : die();
$user->accountname = isset($_POST['accountname']) ? $_POST['accountname'] : die();
$user->accounttype = isset($_POST['accounttype']) ? $_POST['accounttype'] : die();
$user->status = 'Active';



if ($user->add_accountdetails()) {
	echo 'success';
	return true;
}