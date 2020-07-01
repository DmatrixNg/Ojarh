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

$productID = isset($_POST['productID']) ? $_POST['productID'] : 'Product information empty!';

if(isset($_SESSION['userid'])){
    if($user->add_to_favourite($_SESSION['userid'], $productID)){
        return true;
    }
}else{
    if($user->add_to_favourite_anonymous($productID)){
        return true;
    }
}


?>