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
$user->disputeid = isset($_POST['disputeid']) ? $_POST['disputeid'] : die();
$user->senderid = isset($_POST['senderid']) ? $_POST['senderid'] : die();
$user->againstid = isset($_POST['againstid']) ? $_POST['againstid'] : die();

$user->who = $_SESSION['userid'];
$user->role = $_SESSION['role'];

if($user->who == "1111" && $user->role == "Admin"){
	if ($user->updateDisputeStatus($user->disputeid, "Cancelled")) {
        $user->userid = $user->senderid;
        $user->title = 'RE: Dispute Cancelled.';
        $user->body = 'The dispute you raised has been cancelled!';
        $user->generatedlink = "dispute_details.php?disputeid=".$user->disputeid;
        if($user->notifications()){
            $user->userid = $user->againstid;
            $user->title = 'RE: Dispute Cancelled';
            $user->body = 'The dispute against you has been cancelled!';
            $user->generatedlink = "dispute_details.php?disputeid=".$user->disputeid;
            $user->notifications();
            echo 'success';
            return;
        }
	}
}else{
	echo 'You have no permission to perform this task!';
	return;
}
