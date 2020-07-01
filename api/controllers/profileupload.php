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
$user->userid =  $_SESSION['userid'];
$user->status =  1;
$userDetails = $user->userDetails($user->userid);

if ($userDetails->role == "Seller"){$role ="seller";}if ($userDetails->role == "International"){$role ="international";}
if ($userDetails->role == "Buyer"){$role ="buyer";}

$user->marketimgid = mt_rand(100000, 999999);

$user->file_name = $file_size = $file_tmp = $file_type = "";

$user->file_name = @$_FILES['file']['name'];
$user->file_size = @$_FILES['file']['size'];
$user->file_tmp = @$_FILES['file']['tmp_name'];
$user->file_type = @$_FILES['file']['type'];

$user->file_name  = $user->userid."-".$user->file_name;

if(is_uploaded_file($user->file_tmp)){
    if($user->file_size > 1097152 ){
    	// echo 'File size must not be more than 1MB.';
    	header('Location: '.BASE_URL.''.strtolower($_SESSION['role']).'/profile_setting.php?result=File size must not be more than 1MB.');
        return false;
    }else{
    	if($user->updateprofilepic()){
    		if ( !is_dir( "../../".$role."/profilepicture/".$user->userid ) ) {
    			mkdir( "../../".$role."/profilepicture/".$user->userid, 0777, true);
				$targetPath = "../../".$role."/profilepicture/".$user->userid.'/'.$user->file_name;
				if(move_uploaded_file($user->file_tmp, $targetPath)) {
					// echo 'Profile picture updated successfully.';
					header('Location: '.BASE_URL.''.strtolower($_SESSION['role']).'/profile_setting.php?result=Profile picture updated successfully.');
					return true;
				}
    		}else{
    			$targetPath = "../../".$role."/profilepicture/".$user->userid.'/'.$user->file_name;
				if(move_uploaded_file($user->file_tmp, $targetPath)) {
					header('Location: '.BASE_URL.''.strtolower($_SESSION['role']).'/profile_setting.php?result=Profile picture updated successfully.');
					// echo 'Profile picture updated successfully.';
					return true;
				}
    		}

		}else{
			// echo 'could not update profile picture.';
			header('Location: '.BASE_URL.''.strtolower($_SESSION['role']).'/profile_setting.php?result=could not update profile picture.');
			return false;
		}
    }

}else{
	// echo 'Please select a file.';
	header('Location: '.BASE_URL.''.strtolower($_SESSION['role']).'/profile_setting.php?result=Please select a file.');
	return false;
}

?>
