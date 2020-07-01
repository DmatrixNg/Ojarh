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

// print_r($_POST);
// return;

$user->marketname = isset($_POST['e_marketname']) ? $_POST['e_marketname'] : die("Market Name Empty");
$user->marketstate = isset($_POST['e_marketstate']) ? $_POST['e_marketstate'] : die("Market State Empty");
$user->marketcategories = isset($_POST['e_marketcategories']) ? $_POST['e_marketcategories'] : die("Market Category Empty");
$user->marketaddress = isset($_POST['e_marketaddress']) ? $_POST['e_marketaddress'] : die("Market Address Empty");
$user->marketchairman = isset($_POST['e_marketchairman']) ? $_POST['e_marketchairman'] : die("Market Chairman Empty");

$user->marketid = isset($_POST['e_marketid']) ? $_POST['e_marketid'] : die("Market ID Name Empty");

$user->file_name = @$_FILES['e_marketimg']['name'];
$user->file_size = @$_FILES['e_marketimg']['size'];
$user->file_tmp = @$_FILES['e_marketimg']['tmp_name'];
$user->file_type = @$_FILES['e_marketimg']['type'];

$user->file_name  = $user->marketid."-".$user->file_name;

$user->marketimg = $user->file_name;

if(is_uploaded_file($user->file_tmp)){
    if($user->file_size > 1097152 ){
    	header('Location: '.BASE_URL.'admin/market_setting.php?result=File must not exceed 1MB.');
        return true;
    }else{
    	if($user->update_market()){
			mkdir( "../../seller/marketImage/".$user->marketname );
			$targetPath = "../../seller/marketImage/".$user->marketname.'/'.$user->file_name;
			if(move_uploaded_file($user->file_tmp, $targetPath)) {
				header('Location: '.BASE_URL.'admin/market_setting.php?result=Market updated!');
				return true;
			}
		}else{
			//header("Location: ".BASE_URL."admin/market_setting.php?result=Fail to create market");
			return false;
		}
    }

}else{
	if($user->update_market_2()){
        header('Location: '.BASE_URL.'admin/market_setting.php?result=Market updated!');
		return true;
    }
}

?>