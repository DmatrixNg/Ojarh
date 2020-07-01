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

// sponsor generated id
// $seller = isset($_POST['sellerid']) ? $_POST['sellerid'] : die('You have to select a seller!');
// $sellerid = explode('-', $seller);

$user->sellerid = $_POST['sellerid'];
$user->productcategory = isset($_POST['quick_category']) ? $_POST['quick_category'] : die('Category field is empty!');
$user->productid = isset($_POST['quick_product_list']) ? $_POST['quick_product_list'] : die('Product field is empty');
$user->quantity = isset($_POST['q_quantity']) ? $_POST['q_quantity'] : die('Choose quantity of product!');
$user->fullname = isset($_POST['q_fullname']) ? $_POST['q_fullname'] : die('Name field is empty!');
$user->email = isset($_POST['q_email']) ? $_POST['q_email'] : die("Email field is empty!");
$user->phone = isset($_POST['q_phone']) ? $_POST['q_phone'] : die('Phone number field is empty!');
$user->delivery_address = isset($_POST['q_delivery']) ? $_POST['q_delivery'] : die('Set a delivery address!');
$user->order_description = isset($_POST['q_message']) ? $_POST['q_message'] : '';
$user->orderid = date('ymdhsm');

if($user->place_qorder()){
    echo 'Order place successful. The seller will contact you soon!';
    return true;
}
