<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Controller.php';
include_once '../models/core.php';

$db = getDB();

$user = new Users($db);

$data = json_decode(file_get_contents("php://input"));

$returnLocation = strtolower($_SESSION['role']);

$ad_id = $_GET['id'];



    	if($user->stop_ad($ad_id)){
				header('Location: '.BASE_URL.''.$returnLocation.'/ads.php?result=Ads Stopped!');
				return true;

		}

else{
	header('Location: '.BASE_URL.''.$returnLocation.'/ads.php?result=Error try again later.!');
	return false;
}

?>
