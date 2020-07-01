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

$user->complainer_fullname = isset($_POST['complainer_fullname']) ? $_POST['complainer_fullname'] : header("Location: ".BASE_URL."dispute_center.php?mess=Field(s) cannot be empty!");
$user->complainer_email = isset($_POST['complainer_email']) ? $_POST['complainer_email'] : header("Location: ".BASE_URL."dispute_center.php?mess=Field(s) cannot be empty!");
$user->complainer_phone = isset($_POST['complainer_phone']) ? $_POST['complainer_phone'] : header("Location: ".BASE_URL."dispute_center.php?mess=Field(s) cannot be empty!");
$user->subject_request = isset($_POST['subject_request']) ? $_POST['subject_request'] : header("Location: ".BASE_URL."dispute_center.php?mess=Field(s) cannot be empty!");
$user->uid = isset($_POST['uid']) ? $_POST['uid'] : header("Location: ".BASE_URL."dispute_center.php?mess=Field(s) cannot be empty!");
$user->message_inform = isset($_POST['message_inform']) ? $_POST['message_inform'] : header("Location: ".BASE_URL."dispute_center.php?mess=Field(s) cannot be empty!");

$user->disputeid = date('ymdhms');
$user->file_name = @$_FILES['evidencefile']['name'];
$user->file_size = @$_FILES['evidencefile']['size'];
$user->file_tmp = @$_FILES['evidencefile']['tmp_name'];
$user->file_type = @$_FILES['evidencefile']['type'];

$user->file_name  = $user->disputeid."-".$user->file_name;

$user->disputename = $user->file_name;
$user->status = 'Pending';

if($user->file_size > 1097152 ){
    header('Location: '.BASE_URL.'dispute_center.php?result=File must not exceed 1MB.');
    return true;
}else{
    if($user->public_dispute()){
        mkdir( "../../disputefile/".$user->disputename );
        if (!isset($user->file_tmp) || empty($user->file_tmp)) {

          header('Location: '.BASE_URL.'dispute_center.php?result=Dispute submitted, check your email for update about your complaint!');
          return true;
        }else {

          $targetPath = "../../disputefile/".$user->disputename.'/'.$user->file_name;
        if(move_uploaded_file($user->file_tmp, $targetPath)) {
            header('Location: '.BASE_URL.'dispute_center.php?result=Dispute submitted, check your email for update about your complaint!');
            return true;
        }
      }
    }else{
        header("Location: ".BASE_URL."dispute_center.php?result=Fail to create dispute");
        return true;
    }
}

?>
