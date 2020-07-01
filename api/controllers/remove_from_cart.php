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
$productID = $_POST['productID'];
$sellerID = $_POST['sellerID'];

$product_datails = [];

if($user->remove_from_cart($sellerID, $productID)){
	return true;
} else {
	echo 0;
}

?>
