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


setcookie("cart", "", time() - 3600,"/");
setcookie("checkout", "", time() - 3600,"/");
setcookie("order", "", time() - 3600,"/");

// unset($_SESSION['cart']);
// unset($_SESSION['order_status']);
echo "Your cart has been cleared!";
return true;

?>
