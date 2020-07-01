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
$sellerID = $_POST['sellerid'];
$qty  = $_POST['qty'] ?? 0;
$price = $_POST['price'] ?? 0;
$pack = $_POST['pack'] ?? 0;

$product_datails = [];

if($user->add_to_cart($sellerID, $productID,$qty,$price,$pack)){
	return true;

	// $result =  $user->get_product_details($productID);

	// $product_id = $result->productid;
	// $product_name = $result->product_title;
	// $product_img = $result->img0;

	// $product_details = ['product_id' => $product_id, 'product_title' => $product_name, 'product_img' => $product_img];

	// echo json_encode($product_details);

} else {
	return false;
}

?>
