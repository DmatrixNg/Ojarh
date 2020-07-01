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

$productID = $_GET['productID'];
$sellerID = $_GET['sellerid'];
$qty  = $_GET['qty'] ?? 0;
$price = $_GET['price'] ?? 0;
$pack = $_GET['pack'] ?? 0;
$action = $_GET['action'] ?? 0;

$product_datails = [];
$cookie =[];
// die(print_r($action));
if ($action == 1) {
  //
  // print_r(($_COOKIE));
  if (isset($_COOKIE['cart']) && !is_null($_COOKIE['cart'])) {
    //
    $oldcookie = json_decode($_COOKIE['cart'], true);

    foreach ($oldcookie as $value) {

      array_push($cookie,$value);
    }
  }
  $newcookie = $_GET;
  array_push($cookie,$newcookie);

  // print_r($cookie);
  // dd($cookie);
  return setcookie('cart',json_encode($cookie), time() + 3600, "/");
}
else {
  // dd(request()->get('action'));
  $oldcookie = json_decode($_COOKIE['cart'], true);
  if ($oldcookie) {
    foreach ($oldcookie as $key => $value) {
      // dump($key);

      if ($value['sellerid'] == $_GET['sellerid'] &&
      $value['productID'] == $_GET['productID']) {
        unset($oldcookie[$key]);
      }
      // dump($oldcookie);
      // array_push($cookie,$value);
    }
    // die(print_r($oldcookie));
    return setcookie(
    'cart',json_encode($oldcookie), time() + 3600, "/"
    );
  }
}

?>
