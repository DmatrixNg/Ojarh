<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
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

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['body'];

if ($message != "" || $email != "" || $name != "") {
  if($user->contact($name, $email,$phone, $message)){
    header('Location: '.BASE_URL.'/contact.php?result=Thanks For Sharing your Comments with Us');
    return true;
  }
}
?>
