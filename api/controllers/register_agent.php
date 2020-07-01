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
if (isset($_POST['id'])) {
  $user->agentfname = isset($_POST['agentfname']) ? $_POST['agentfname'] : die("Firstname is empty");
  $user->agentlname = isset($_POST['agentlname']) ? $_POST['agentlname'] : die("Lastname is empty");
  $user->agentphone = isset($_POST['agentphone']) ? $_POST['agentphone'] : die("Phone is empty");
  $user->agentemail = isset($_POST['agentemail']) ? $_POST['agentemail'] : die("Email is empty");
  $user->agentaddress = isset($_POST['agentaddress']) ? $_POST['agentaddress'] : die("Address is empty");
  $user->agentstate = isset($_POST['agentstate']) ? $_POST['agentstate'] : die("State is empty");
  $user->agentcountry = isset($_POST['agentcountry']) ? $_POST['agentcountry'] : die("Country is empty");

  $user->agentid = $_POST['id'];



      	if($user->update_agent()){

  			echo "success";
      }else{
  	echo "Error updating details";
  	return;
  }

}else {


$user->agentfname = isset($_POST['agentfname']) ? $_POST['agentfname'] : die("Firstname is empty");
$user->agentlname = isset($_POST['agentlname']) ? $_POST['agentlname'] : die("Lastname is empty");
$user->agentphone = isset($_POST['agentphone']) ? $_POST['agentphone'] : die("Phone is empty");
$user->agentemail = isset($_POST['agentemail']) ? $_POST['agentemail'] : die("Email is empty");
$user->agentaddress = isset($_POST['agentaddress']) ? $_POST['agentaddress'] : die("Address is empty");
$user->agentstate = isset($_POST['agentstate']) ? $_POST['agentstate'] : die("State is empty");
$user->agentcountry = isset($_POST['agentcountry']) ? $_POST['agentcountry'] : die("Country is empty");

$user->agentstatus = 'Inactive';
$user->agentid = mt_rand(10000000, 99999999);

$user->file_name = @$_FILES['agentfile']['name'];
$user->file_size = @$_FILES['agentfile']['size'];
$user->file_tmp = @$_FILES['agentfile']['tmp_name'];
$user->file_type = @$_FILES['agentfile']['type'];

$user->agentpic_name = @$_FILES['agentpic']['name'];
$user->agentpic_size = @$_FILES['agentpic']['size'];
$user->agentpic_tmp = @$_FILES['agentpic']['tmp_name'];
$user->agentpic_type = @$_FILES['agentpic']['type'];

$user->file_name  = $user->agentid."-".$user->file_name;

$user->agentpic_name  = $user->agentid."-".$user->agentpic_name;

$user->agentfile_name = $user->file_name;

$user->agentimg_name = $user->agentpic_name;

if($user->isAgentExist()) {
   	header('Location: '.BASE_URL.'all_agents.php?result=Agent already exist!');
	return false;
}

if(is_uploaded_file($user->file_tmp) && is_uploaded_file($user->agentpic_tmp)){
    if($user->file_size > 1097152 && $user->agentpic_size > 1097152){
    	header('Location: '.BASE_URL.'all_agents.php?result=File must not exceed 1MB for each Profile picture and CV.');
        return true;
    }else{
    	if($user->create_agent()){
			mkdir( "../../agentcv/".$user->agentid );
			mkdir( "../../agentprofilepic/".$user->agentid );
			$targetPath = "../../agentcv/".$user->agentid."/".$user->agentfile_name;
			$targetPath2 = "../../agentprofilepic/".$user->agentid."/".$user->agentimg_name;
			if(move_uploaded_file($user->file_tmp, $targetPath) && move_uploaded_file($user->agentpic_tmp, $targetPath2)) {
				header('Location: '.BASE_URL.'all_agents.php?result=You have successfully created a profile, please check your mail for update!');
				return true;
			}
		}else{
			header("Location: ".BASE_URL."all_agents.php?result=Failed, try again later.");
			return false;
		}
    }

}else{
	header('Location: '.BASE_URL.'all_agents.php?result=Please upload your Picture & CV!');
	return false;
}
}
?>
