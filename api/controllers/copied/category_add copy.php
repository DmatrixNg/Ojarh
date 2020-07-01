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
$user->catname = isset($_POST['catname']) ? $_POST['catname'] : die();
$user->catdescription = isset($_POST['catdescription']) ? $_POST['catdescription'] : die();


//$user->username = $data->username;
//$user->password = $data->password;

$user->catid = mt_rand(100000, 999999);

// $user->catname = htmlspecialchars(trim($_POST['catname']));
// $user->catdescription = htmlspecialchars(trim($_POST['catdescription']));

if ($user->add_category()) {
	echo 'success';
	return true;
}