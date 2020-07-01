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
$catid = isset($_POST['e_catid']) ? $_POST['e_catid'] : die();
$catname = isset($_POST['e_catname']) ? $_POST['e_catname'] : die();
$catdescription = isset($_POST['e_catdescription']) ? $_POST['e_catdescription'] : die();

$user->file_name = @$_FILES['e_catimage']['name'];
$user->file_size = @$_FILES['e_catimage']['size'];
$user->file_tmp = @$_FILES['e_catimage']['tmp_name'];
$user->file_type = @$_FILES['e_catimage']['type'];

$catImage  = $user->catid."-".$user->file_name;

$user->admin = $_SESSION['userid'];
$user->role = $_SESSION['role'];
$user->status = 1;
if($user->role == 'Admin'){
	if(is_uploaded_file($user->file_tmp)){
		if($user->file_size > 1097152 ){
			header('Location: '.BASE_URL.'admin/market_setting.php?result=File must not exceed 1MB.');
			return true;
		}else{
			if($user->update_category($catname, $catdescription, $catImage, $catid)){
				$targetPath = "../../seller/catImage/".$catid.'/'.$catImage;
				if(move_uploaded_file($user->file_tmp, $targetPath)) {
					header('Location: '.BASE_URL.'admin/product_category.php?result=Category updated!');
					return true;
				}
			}else{
				header("Location: ".BASE_URL."admin/product_category.php?result=Fail to create category");
				return false;
			}
		}

	}elseif(!is_uploaded_file($user->file_tmp)){
        if($user->update_category_withoutimg($catname, $catdescription, $catid)){
            header('Location: '.BASE_URL.'admin/product_category.php?result=Category updated!');
			return true;
        }
    }else{
		header('Location: '.BASE_URL.'admin/product_category.php?result=Please upload category image!');
		return false;
	}
}else{
	header('Location: '.BASE_URL.'admin/product_category.php?result=You have no permission to perform this task!');
	return false;
}

