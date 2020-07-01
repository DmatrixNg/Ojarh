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
//$data = json_decode(file_get_contents("php://input"));

//sponsor generated id
//$user->sponsorLink = isset($_GET['sponsor']) ? $_GET['sponsor'] : die();

$user->role = htmlspecialchars(trim($_POST['role']));
$user->username = htmlspecialchars(trim($_POST['username']));
$user->email = htmlspecialchars(trim($_POST['email']));
$user->password = htmlspecialchars(trim($_POST['password']));
$user->fname = htmlspecialchars(trim($_POST['fname']));
$user->lname = htmlspecialchars(trim($_POST['lname']));
$user->phone = htmlspecialchars(trim($_POST['phone']));
$user->state = htmlspecialchars(trim($_POST['state']));
$user->address = htmlspecialchars(trim($_POST['address']));

if($user->create_user()){
    echo 'success';
}