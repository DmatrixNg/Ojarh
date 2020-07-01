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
$catid = isset($_POST['id']) ? $_POST['id'] : '';

$userid = $_SESSION['userid'];
$cnt = $user->user_product_catalogue_count($userid, $catid);
if ($cnt > 0) {
  // print_r($cnt);
  $output = "Catalogue not empty, Edit/Move products to another Catalogue, and try again";
  return print($output);
}else {
  if($user->remove_from_user_catalogue($catid)){
    return true;
  }else {
    return "Error removing Catalogue";
  }

}

?>
