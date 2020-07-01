<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT, GET, POST');
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
//$data = json_decode(file_get_contents("php://input"));

//sponsor generated id
//$user->sponsorLink = isset($_GET['sponsor']) ? $_GET['sponsor'] : die();
$result = array();

$user->senderid =  $_SESSION['userid'];

$user->againstid = isset($_POST['customerid']) ? $_POST['customerid'] : die();
$user->subject = isset($_POST['subject']) ? $_POST['subject'] : die();
$user->priority = isset($_POST['priority']) ? $_POST['priority'] : die();
$user->details_priority = isset($_POST['details_priority']) ? $_POST['details_priority'] : die();

if($_SESSION['role'] == 'Seller'){
	$link = 'seller';
}elseif($_SESSION['role'] == 'International'){
	$link = 'international';
}elseif($_SESSION['role'] == 'Buyer'){
	$link = 'buyer';
}
if ($user->againstid == "") {
	header('Location: '.BASE_URL.''.$link.'/dispute_center.php?result=Error: Filed Against is empty!');
	return true;
}

$jjj = explode('-', $user->againstid);
$user->againstid = $jjj[1];

$user->disputestatus = 'Pending';
$user->disputeid = mt_rand(100000, 999999);

$user->file_name = @$_FILES['file']['name'];
$user->file_size = @$_FILES['file']['size'];
$user->file_tmp = @$_FILES['file']['tmp_name'];
$user->file_type = @$_FILES['file']['type'];


if($user->file_name == ''){
	$user->file_name = $file_size = $file_tmp = $file_type = "";
}else{
	$user->file_name  = $user->disputeid."-".$user->file_name;
}


if($user->create_dispute()){

	if ( !is_dir( "../../seller/disputefile/" ) ) {
		mkdir( "../../seller/disputefile/" );

		$targetPath = "../../seller/disputefile/".$user->file_name;
		if ($targetPath == "") {
			header('Location: '.BASE_URL.''.$link.'/dispute_center.php?result=Dispute ticket has been created!');
			return true;
		}else {

			if(move_uploaded_file($user->file_tmp, $targetPath)) {
				header('Location: '.BASE_URL.''.$link.'/dispute_center.php?result=Dispute ticket has been created!');
				return true;
			}
		}
	}else{
		if ($targetPath == "") {
			header('Location: '.BASE_URL.''.$link.'/dispute_center.php?result=Dispute ticket has been created!');
			return true;
		}else {
			$targetPath = "../../seller/disputefile/".$user->file_name;
			if(move_uploaded_file($user->file_tmp, $targetPath)) {
				header('Location: '.BASE_URL.''.$link.'/dispute_center.php?result=Dispute ticket has been created!');
				return true;
			}

		}
	}
}else{
	header("Location: ".BASE_URL."".$link."/dispute_center.php?result=Fail to create dispute ticket!");
	return false;
}

?>
