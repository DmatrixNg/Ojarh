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

if ($_SESSION['role'] == "Seller") {
	$locator = SELLER_URL;}
if ($_SESSION['role'] == "International") {
	$locator = INTERNATIONAL_URL;}
if ($_SESSION['role'] == "Buyer") {
	$locator = BUYER_URL;}
if ($_SESSION['role'] == "Admin") {
	$locator = ADMIN_URL;}
if ($_SESSION['role'] == "Sub Admin") {
	$locator = ADMIN_URL;}
$user->verificationtype = isset($_POST['verificationtype']) ? $_POST['verificationtype'] : die("Please select document type:");

$user->verifystatus = 'Pending';
$user->verifyid = mt_rand(100000, 999999);

$user->file_name = @$_FILES['verifyimage']['name'];
$user->file_size = @$_FILES['verifyimage']['size'];
$user->file_tmp = @$_FILES['verifyimage']['tmp_name'];
$user->file_type = @$_FILES['verifyimage']['type'];

//die(print_r($_FILES));
$user->userid = $_SESSION['userid'];

$user->file_name  = $user->verifyid."-".$user->file_name;
$userDetails = $user->userDetails($_SESSION['userid']);

if ($userDetails->role == "Seller"){$role ="seller";}if ($userDetails->role == "International"){$role ="international";}

if($user->isVerifyExist()) {
   	header('Location: '.$locator.'/seller_verification.php?result=You already requested for this process, verification is on going!');
	return false;
}
//die(print_r(is_uploaded_file($user->file_tmp)));
if(is_uploaded_file($user->file_tmp)){
    if($user->file_size > 1097152 ){
    	header('Location: '.$locator.'/seller_verification.php?result=File must not exceed 1MB.');
        return true;
    }else{
    	if($user->submit_verify()){
			mkdir( "../../".$role."/verifyfile/".$user->verifyid, 0777, true);
			$targetPath = "../../".$role."/verifyfile/".$user->verifyid.'/'.$user->file_name;
			if(move_uploaded_file($user->file_tmp, $targetPath)) {
				header('Location: '.$locator.'/seller_verification.php?result=Verication submitted!');
				return true;
			}
		}else{
			//header("Location: ".BASE_URL."seller/seller_verification.php?result=Fail to create market");
			return false;
		}
    }

}else{
	header('Location: '.$locator.'/seller_verification.php?result=Please upload credential!');
	return false;
}

?>
