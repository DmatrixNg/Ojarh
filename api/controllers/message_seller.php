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
if (isset($_SESSION['userid'])) {
  $name = $user->userDetails($_SESSION['userid']);
  // code...
  $name = $name->fname.' '.$name->lname;
  $user->userid = $_SESSION['userid'];
}else {
  $name = isset($_POST['b_name']) ? $_POST['b_name'] : null;
  $user->userid = null;
  header("Location: ".BASE_URL."signin.php");
	return;
}
if (isset($_POST['receiverid'])) {

  $user->receiverid = isset($_POST['receiverid']) ? $_POST['receiverid'] : null;
}else {
  $user->receiverid = isset($_POST['ids']) ? $_POST['ids'] : null;
  
}
$user->b_message = isset($_POST['b_message']) ? $_POST['b_message'] : '';
$user->b_name = $name;
$user->b_phone = isset($_POST['b_phone']) ? $_POST['b_phone'] : '';
$user->b_email = isset($_POST['b_email']) ? $_POST['b_email'] : '';
$user->productid= isset($_POST['productid']) ? $_POST['productid'] : '';


// $user->productid = '';

$user->status = 'Pending';
$user->messid = date("Ymdhms");

if ($user->message_seller_pd()) {
  echo 'Sent successfully!';
  return true;
}
