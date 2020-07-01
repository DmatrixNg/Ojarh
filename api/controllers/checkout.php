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
  $packaging = $_POST['packaging'];
  $sellerid = $_POST['sellerid'];

  $productid = $_POST['productid'];
  $qty = $_POST['qty'];
  $subtotal = $_POST['subtotal'];
  $_POST['grand_total_naira'];
  $_POST['grand_total_dollar'];
  // $all =[];
  // print_r($_POST);
  foreach (array_unique($sellerid) as $key => $value) {
    $checkout = [];
    for ($i=0; $i < count($productid) ; $i++) {
      // $_POST
      if ($value == $sellerid[$i] ) {
        // $checkout[] = "in";
         $checkout[$productid[$i]] = ['qty' => $qty[$i], 'pack_type' => $packaging[$i], 'total_price' => $subtotal[$i]];
      }else {

      }
       // (print_r('out'));
    }
    $all[$value] = $checkout;
  }
// die(print_r($all));
  $cookie =[];
//   if (isset($_COOKIE['checkout']) && !is_null($_COOKIE['checkout'])) {
//   //
//   $oldcookie = json_decode($_COOKIE['checkout'], true);
//
//   foreach ($oldcookie as $value) {
//
//     array_push($cookie,$value);
//   }
// }

  $newcookie = array(
    'orders' => $all,
    'total_naira' => $_POST['grand_total_naira'],
    'total_dollar' =>$_POST['grand_total_dollar']
 );
  array_push($cookie,$newcookie);

  $set =setcookie('checkout',json_encode($cookie), time() + 3600, "/");
  // print_r($set);
if ($set) {
  header('Location: '.BASE_URL.'make_pay.php');
  return true;
}
