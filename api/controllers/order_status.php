<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
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
$user->status = isset($_GET['status']) ? $_GET['status'] : die();
$user->orderid = isset($_GET['orderid']) ? $_GET['orderid'] : die();
$user->buyerid = isset($_GET['buyerid']) ? $_GET['buyerid'] : die();

	if ($user->update_order_status()) {
		echo 'success';
		return true;
	}
