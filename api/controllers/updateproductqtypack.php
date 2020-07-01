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

//get posted data
$data = json_decode(file_get_contents("php://input"));

$sellerID = isset($_POST['sellerID']) ? $_POST['sellerID'] : '';
$productID = isset($_POST['productID']) ? $_POST['productID'] : '';
$qty = isset($_POST['qty']) ? $_POST['qty'] : '';
$pack_type = isset($_POST['pack_type']) ? $_POST['pack_type'] : '';
$tot = isset($_POST['tot']) ? $_POST['tot'] : '';

if ($user->update_cart ($sellerID, $productID, $qty, $pack_type, $tot)) {
    echo 'Cart updated!';
    return true;
}