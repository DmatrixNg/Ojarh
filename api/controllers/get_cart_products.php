<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT, GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Controller.php';
include_once '../models/core.php';

$db = getDB();
$user = new Users($db);

$total_item = 0;

// $output = '<div class="table-responsive">
// 		<table class="table table-bordered table-striped">
// 			<tr>
// 				<th>Product Image</th>
// 				<th>Product name</th>
// 				<th>Seller name</th>
// 				<th>Action</th>
// 			</tr>';
// 			if(!empty($_COOKIE['cart'])) {
// 				foreach ($_COOKIE['cart'] as $id['sellerid'] => $productids) {

// 					foreach($_COOKIE['cart'][$id['sellerid']] as $key => $values){
// 						$productD = $user->get_product_details($key);
// 						print_r($productD->product_title);
// 					}

// 				}
// 			}

// 		$output .='</table></div>';
$output = '<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Product Image</th>
				<th>Product name</th>
				<th>Seller name</th>
				<th>Action</th>
			</tr>';

				if(isset($_COOKIE['cart']) && !empty(json_decode($_COOKIE['cart'], true))) { //if cart is available
					foreach (json_decode($_COOKIE['cart'], true) as $id) { //get product details of each cart items
						$sellerD = $user->userDetails($id['sellerid']);
						$sellerBizD = $user->bizDetails($id['sellerid']);

						// foreach(json_decode($_COOKIE['cart'], true) as $productid => $values){
						// 	// print_r($productid);

							$productD = $user->get_product_details($id['productID']);
							for ($i=0; $i < 7; $i++) {
								$img = 'img'.$i;
								if (!is_null($productD->$img) && !empty($productD->$img)) {
									$image = $productD->$img;
									break;
								}
							}
							$product_id = $productD->productid;
							$product_name = $productD->product_title;
							$product_img = $image;
							$product_vendor = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;

							// die(print_r(json_decode($_COOKIE['cart'], true)));
							$output .='
								<tr id="item_'.$product_id.'">
									<td><img class="img img-thumbnail" width="60" height="60" src="'.BASE_URL.strtolower($sellerD->role).'/productimg/'.$product_id.'/'.$product_img.'"></td>
									<td>'.$product_name.'</td>
									<td>'.$product_vendor.'</td>
									<td><button class="btn btn-danger" id="'.$id['sellerid'].'" onclick="AddCartmini(this.id, '.$product_id.',0)"><i class="fa fa-times"></i></button></td>
								</tr>';

							$total_item = $total_item + 1;

						// }
					}
				} else { // no item in cart
					$output .='<tr>
						<td colspan="4">Your cart is empty!</td>
						</tr>';
				}
		$output .='</table></div>';
		$data = array(
			'cart_details' => $output,
			'total_item' => $total_item
		);
echo json_encode($data);
