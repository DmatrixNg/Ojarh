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

$user->created_by = "SuperAdmin";
$user->catid = mt_rand(100000, 999999);

$user->file_name = @$_FILES['catimage']['name'];
$user->file_size = @$_FILES['catimage']['size'];
$user->file_tmp = @$_FILES['catimage']['tmp_name'];
$user->file_type = @$_FILES['catimage']['type'];

$user->file_name  = $user->catid."-".$user->file_name;

$user->admin = $_SESSION['userid'];
$user->role = $_SESSION['role'];
$user->status = 1;
if($user->admin == 1111 AND $user->role == 'Admin'){
	if(is_uploaded_file($user->file_tmp)){
		if($user->file_size > 1097152 ){
			header('Location: '.BASE_URL.'admin/market_setting.php?result=File must not exceed 1MB.');
			return true;
		}else{
			if($user->add_category()){
				mkdir( "../../seller/catImage/".$user->catid );
				$targetPath = "../../seller/catImage/".$user->catid.'/'.$user->file_name;
				if(move_uploaded_file($user->file_tmp, $targetPath)) {
					header('Location: '.BASE_URL.'admin/product_category.php?result=Category added!');
					return true;
				}
			}else{
				header("Location: ".BASE_URL."admin/product_category.php?result=Fail to create category");
				return false;
			}
		}

	}else{
		header('Location: '.BASE_URL.'admin/product_category.php?result=Please upload category image!');
		return false;
	}
}else{
	header('Location: '.BASE_URL.'admin/product_category.php?result=You have no permission to perform this task!');
	return false;
}

