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

$userid = $_GET['id'];
$access = isset($_GET['access']) ? $_GET['access'] : 0;

if ($access == 1) {
  $access = 'Approved';
  $mess ='User Approved!';
}else {
  $access = 'pending';
  $mess ='User Access Revoked!';
}

    	if($user->update_business_access($userid,$access)){
				header('Location: '.BASE_URL.''.$returnLocation.'/business_access.php?result='.$mess.'');
				return true;

		}

else{
	header('Location: '.BASE_URL.''.$returnLocation.'/business_access.php?result=Error, Try again later');
	return false;
}

?>
