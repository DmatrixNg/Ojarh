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

$user->brandid = isset($_GET['brandid']) ? $_GET['brandid'] : die("Brand ID Empty");
$user->brandtitle = isset($_GET['brandtitle']) ? $_GET['brandtitle'] : die("Brand Title Empty");
$user->brandimg =  isset($_GET['brandimg']) ? $_GET['brandimg'] : die("Brand Image Empty");


if(!$user->isBrandExist()) {
   	header('Location: '.BASE_URL.'admin/brands.php?result=Brand Not Found!');
	return false;
}

if($user->delete_brand()){
	$targetPath = "../../admin/images/brands/".$user->brandimg;
	if(unlink($targetPath)) {
		header('Location: '.BASE_URL.'admin/brands.php?result=Brand Deleted!');
		return true;
	}
}else{
	//header("Location: ".BASE_URL."admin/market_setting.php?result=Fail to create market");
	return false;
}
?>