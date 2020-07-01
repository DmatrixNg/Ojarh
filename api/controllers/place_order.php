<?php
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json; charset=utf-8');
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

$user->sellerid = isset($_POST['sellerid']) ? $_POST['sellerid'] : '';
$user->productid = isset($_POST['productid']) ? $_POST['productid'] : '';
$user->total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : '';

$user->qty = isset($_POST['qty']) ? $_POST['qty'] : '';
$user->product_price = $user->total_amount / $user->qty;

$other_info = isset($_POST['other_info']) ? $_POST['other_info'] : '';
$currency = explode('~', $other_info);

$user->currency = $currency[5];

$user->details = isset($_POST['details']) ? $_POST['details'] :'';

$user->checkout_email = isset($_POST['checkout_email']) ? $_POST['checkout_email'] : '';
$user->checkout_phone = isset($_POST['checkout_phone']) ? $_POST['checkout_phone'] : '';
$user->checkout_fname = isset($_POST['checkout_fname']) ? $_POST['checkout_fname'] : '';
$user->checkout_lname = isset($_POST['checkout_lname']) ? $_POST['checkout_lname'] : '';
$user->billing_address = isset($_POST['billing_address']) ? $_POST['billing_address'] : '';
$user->location = isset($_POST['location']) ? $_POST['location'] : '';

$user->buyer_name = $user->checkout_fname .' '.$user->checkout_lname;
$user->userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
$user->pay_status = isset($_POST['status']) ? $_POST['status'] : '';
$user->payment_method = isset($_POST['status']) ? $_POST['status'] : '';
$user->pay_date = isset($_POST['status']) ? $_POST['status'] : '';
$user->status = isset($_POST['pay_status']) ? $_POST['pay_status'] : '';
$user->pickup_code = rand(0000000, 999999);
$user->orderid = date('ymdhms');

// if(!empty($_SESSION['cart'])) {
//     $cart = $_SESSION['cart'];
//     if(array_key_exists($user->sellerid, $cart)) {
//         foreach($_SESSION['cart'][$user->sellerid] as $productid => $values){
//             $user->orders = json_encode($cart[$user->sellerid]);
//         }
//     }
// }

if(isset($_COOKIE['checkout']) && !empty(json_decode($_COOKIE['checkout'], true))) { //if cart is available
  foreach (json_decode($_COOKIE['checkout'], true)[0]['orders'] as $sellerids => $productids) {
    if ($sellerids == $user->sellerid) {
    $order1 =  json_decode($_COOKIE['checkout'], true)[0]['orders'][$sellerids];
    $user->orders = json_encode($order1);
    // die(print_r(json_decode($user->orders)));

    }
}
}
if($user->place_order()){

  if($currency == "$"){
    $user->details = isset($_POST['details']) ? $_POST['details'] :'';

  }
  // $user->transactions();
  $user->wallet();
  $user->Addtowallet($user->sellerid,$user->total_amount);
  $user->Addtowallet(1111,$user->total_amount);

    foreach (json_decode($_COOKIE['checkout'], true)[0]['orders'] as $sellerids => $productids) {
      if ($sellerids == $user->sellerid) {

      unset(json_decode($_COOKIE['checkout'], true)[0]['orders'][$sellerids]);

      }
    }
      $order =[];
      if (isset($_COOKIE['order']) && !is_null($_COOKIE['order'])) {
      //
      $oldorder = json_decode($_COOKIE['order'], true);

      foreach ($oldorder as $value) {
        $neworder = array('seller' => $value);
        array_push($order,$neworder);
      }
          $neworder = array('seller' => $user->sellerid);
          array_push($order,$neworder);
          print_r($neworder);
          (print_r($order));

          $set =setcookie('order',json_encode($order), time() + 3600, "/");

            return true;


    } else {
      $order = array('seller' => $user->sellerid);
      $set =setcookie('order',json_encode($order), time() + 3600, "/");

        return true;

    }
}


?>
