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

$user->marketname = isset($_POST['marketname']) ? $_POST['marketname'] : die("Market Name Empty");
$user->marketstate = isset($_POST['marketstate']) ? $_POST['marketstate'] : die("Market State Empty");
$user->marketcategories = isset($_POST['marketcategories']) ? $_POST['marketcategories'] : die("Market Category Empty");
$user->marketaddress = isset($_POST['marketaddress']) ? $_POST['marketaddress'] : die("Market Address Empty");
$user->marketchairman = isset($_POST['marketchairman']) ? $_POST['marketchairman'] : die("Market Chairman Empty");

$user->created_by = "SuperAdmin";
$user->marketstatus = 'Active';
$user->marketid = mt_rand(100000, 999999);

$user->file_name = @$_FILES['marketimg']['name'];
$user->file_size = @$_FILES['marketimg']['size'];
$user->file_tmp = @$_FILES['marketimg']['tmp_name'];
$user->file_type = @$_FILES['marketimg']['type'];

$user->file_name  = $user->marketid."-".$user->file_name;

$user->marketimg = $user->file_name;

if($user->isMarketExist()) {
   	header('Location: '.BASE_URL.'admin/market_setting.php?result=Market already already exist!');
	return false;
}

if(is_uploaded_file($user->file_tmp)){
    if($user->file_size > 1097152 ){
    	header('Location: '.BASE_URL.'admin/market_setting.php?result=File must not exceed 1MB.');
        return true;
    }else{
    	if($user->create_market()){
			mkdir( "../../seller/marketImage/".$user->marketname );
			$targetPath = "../../seller/marketImage/".$user->marketname.'/'.$user->file_name;
			if(move_uploaded_file($user->file_tmp, $targetPath)) {
				header('Location: '.BASE_URL.'admin/market_setting.php?result=Market added!');
				return true;
			}
		}else{
			//header("Location: ".BASE_URL."admin/market_setting.php?result=Fail to create market");
			return false;
		}
    }

}else{
	header('Location: '.BASE_URL.'admin/market_setting.php?result=Please upload market image!');
	return false;
}

?>