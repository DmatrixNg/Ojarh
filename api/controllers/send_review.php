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

$user->product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 'Error, field(s) cannot be empty!';
$user->user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 'Error, field(s) cannot be empty!';
$user->r_name = isset($_POST['r_name']) ? $_POST['r_name'] : 'Error, field(s) cannot be empty!';
$user->r_email = isset($_POST['r_email']) ? $_POST['r_email'] : 'Error, field(s) cannot be empty!';
$user->rating = isset($_POST['rating']) ? $_POST['rating'] : 'Error, field(s) cannot be empty!';
$user->r_title = isset($_POST['r_title']) ? $_POST['r_title'] : 'Error, field(s) cannot be empty!';
$user->r_body = isset($_POST['r_body']) ? $_POST['r_body'] : 'Error, field(s) cannot be empty!';

$user->status = 'Pending';
$user->reviewid = date("Ymdhms");

$user->reply = null;

if ($user->submit_review()) {
    echo 'Sent successfully!';
    return true;
}
