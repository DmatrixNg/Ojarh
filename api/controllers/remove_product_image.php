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
$image = $_POST['image'];
$product = $_POST['id'];
$user->productid = $_POST['id'];
$product = $user->get_product_details($product);
print_r($image);

for ($i=0; $i < 7; $i++) {
	$img = "img".$i;
	// print_r($product->$img);
	if (!is_null($product->$img) && !empty($product->$img)) {

		if ($product->$img != $image ) {
			$user->$img = $product->$img;
		}

	}else {
		break;
	}
}
print_r($product->$img);


// $user->userid = $_SESSION['userid'];
//
// 		if(isset($image, $storeimgs)){
// 			foreach ($storeimgs as $key => $value) {
// 				if ($value == $image) {
// 					unset($storeimgs->$key);
// 				}
// 			}
//  }
// 			$user->storeimage = json_encode($storeimgs);
			if ($user->remove_product_image()) {
				return true;
			}else {

			echo 0;
		}



?>
