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

if(isset($_POST['id'])){
    $user->userid = isset($_POST['id']) ? $_POST['id'] : die('id field is empty.');
    $user->role = isset($_POST['role']) ? $_POST['role'] : die('Role field is empty.');
    $user->agentid = isset($_POST['agentid']) ? $_POST['agentid'] : 1111;
    $user->username = isset($_POST['username']) ? $_POST['username'] : die('Username is empty.');
    $user->email = isset($_POST['email']) ? $_POST['email'] : die('Email is empty!');
    $user->password = isset($_POST['password']) ? $_POST['password'] : die('Password field is empty.');
    $user->fname = isset($_POST['fname']) ? $_POST['fname'] : die('First name is empty.');
    $user->lname = isset($_POST['lname']) ? $_POST['lname'] : die('Last name is empty.');
    $user->phone = isset($_POST['phone']) ? $_POST['phone'] : die('Phone number is empty.');
    $user->state = isset($_POST['state']) ? $_POST['state'] : die('State field is empty.');
    $user->country = isset($_POST['country']) ? $_POST['country'] : die('Country field is empty.');
    $user->address = isset($_POST['address']) ? $_POST['address'] : die('Address field is empty.');
    if($user->update_users()){
        echo 'success';
    }
}else{
    $user->role = isset($_POST['role']) ? $_POST['role'] : die('Role field is empty.');
    $user->agentid = isset($_POST['agentid']) ? $_POST['agentid'] : 1111;
    $user->username = isset($_POST['username']) ? $_POST['username'] : die('Username is empty.');
    $user->email = isset($_POST['email']) ? $_POST['email'] : die('Email is empty!');
    $user->password = isset($_POST['password']) ? $_POST['password'] : die('Password field is empty.');
    $user->fname = isset($_POST['fname']) ? $_POST['fname'] : die('First name is empty.');
    $user->lname = isset($_POST['lname']) ? $_POST['lname'] : die('Last name is empty.');
    $user->phone = isset($_POST['phone']) ? $_POST['phone'] : die('Phone number is empty.');
    $user->state = isset($_POST['state']) ? $_POST['state'] : die('State field is empty.');
    $user->country = isset($_POST['country']) ? $_POST['country'] : die('Country field is empty.');
    $user->address = isset($_POST['address']) ? $_POST['address'] : die('Address field is empty.');
    $user->confirmationCode = mt_rand(100000, 999999);
    if($user->create_user()){
        echo 'success';
    }
}



