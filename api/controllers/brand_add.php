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

$user->brandtitle = isset($_POST['brandname']) ? $_POST['brandname'] : die("Brand Name Empty");

$user->file_name = @$_FILES['brandimg']['name'];
$user->file_size = @$_FILES['brandimg']['size'];
$user->file_tmp = @$_FILES['brandimg']['tmp_name'];
$user->file_type = @$_FILES['brandimg']['type'];

$user->file_name  = mt_rand(100000, 999999)."-".$user->file_name;

$user->brandimg = $user->file_name;

if($user->isBrandExist()) {
   	header('Location: '.BASE_URL.'admin/brands.php?result=Brand already exist!');
	return false;
}

if(is_uploaded_file($user->file_tmp)){
    if($user->file_size > 1097152 ){
    	header('Location: '.BASE_URL.'admin/brands.php?result=File must not exceed 1MB.');
        return true;
    }else{
    	if($user->create_brand()){
			$targetPath = "../../admin/images/brands/".$user->file_name;
			if(move_uploaded_file($user->file_tmp, $targetPath)) {
				header('Location: '.BASE_URL.'admin/brands.php?result=Brand added!');
				return true;
			}
		}else{
			//header("Location: ".BASE_URL."admin/market_setting.php?result=Fail to create market");
			return false;
		}
    }

}else{
	header('Location: '.BASE_URL.'admin/brands.php?result=Please upload brand image!');
	return false;
}

?>