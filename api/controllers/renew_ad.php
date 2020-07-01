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
$days = $_POST['days'];
$ad_id = $_POST['id'];

if ($_SESSION['role'] == "Admin") {

  $status = 1;
}else {
  $status = 0;

}


    	if($user->renew_ad($ad_id, $days, $status)){
				header('Location: '.BASE_URL.''.$returnLocation.'/ads.php?result=Congrate Ads renewed successfully!');
				return true;

		}

else{
	header('Location: '.BASE_URL.''.$returnLocation.'/ads.php?result=Error try again later.!');
	return false;
}

?>
