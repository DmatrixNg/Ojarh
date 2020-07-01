<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT, GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Controller.php';
include_once '../models/core.php';

$db = getDB();

$user = new Users($db);

$data = json_decode(file_get_contents("php://input"));

$returnLocation = strtolower($_SESSION['role']);
$days = $_POST['days'];
$link = $_POST['link'];
$adslocation = $_POST['adslocation'];

$file_name = @$_FILES['adimg']['name'];
$file_size = @$_FILES['adimg']['size'];
$file_tmp = @$_FILES['adimg']['tmp_name'];
$file_type = @$_FILES['adimg']['type'];

$file_name  = mt_rand(100000, 999999)."-".$file_name;
if ($_SESSION['role'] == "Admin") {
  // code...
  $status = 1;
}else {
  $status = 0;

}
 
if(is_uploaded_file($file_tmp)){
    if($file_size > 1097152 ){
    	header('Location: '.BASE_URL.''.$returnLocation.'/create_ads.php?result=File must not exceed 1MB.');
        return true;
    }else{
    	if($user->create_ad($link, $adslocation, $file_name, $days, $status)){
			$targetPath = "../../public/ads/".$file_name;
			if(move_uploaded_file($file_tmp, $targetPath)) {
				header('Location: '.BASE_URL.''.$returnLocation.'/create_ads.php?result=Ads added!');
				return true;
			}
		}else{
			//header("Location: ".BASE_URL."admin/market_setting.php?result=Fail to create market");
			return false;
		}
    }

}else{
	header('Location: '.BASE_URL.''.$returnLocation.'/create_ads.php?result=Please upload Ad image!');
	return false;
}

?>
