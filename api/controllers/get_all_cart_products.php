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
// 			if(!empty($_SESSION['cart'])) {
// 				foreach ($_SESSION['cart'] as $sellerids => $productids) {

// 					foreach($_SESSION['cart'][$sellerids] as $key => $values){
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

				if(!empty($_SESSION['cart'])) { //if cart is available
					foreach ($_SESSION['cart'] as $sellerids => $productids) { //get product details of each cart items
						$sellerD = $user->userDetails($sellerids);
						$sellerBizD = $user->bizDetails($sellerids);

						foreach($_SESSION['cart'][$sellerids] as $productid => $values){
							// print_r($productid);

							$productD = $user->get_product_details($productid);

							$product_id = $productD->productid;
							$product_name = $productD->product_title;
							$product_img = $productD->img0;
							$product_vendor = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;

							$output .='
								<tr id="item_'.$product_id.'">
									<td><img class="img img-thumbnail" width="60" height="60" src=".../../seller/productimg/'.$product_id.'/'.$product_img.'"></td>
									<td>'.$product_name.'</td>
									<td>'.$product_vendor.'</td>
									<td><button class="btn btn-danger" id="'.$sellerids.'" onclick="remove_from_cart(this.id, '.$product_id.')"><i class="fa fa-times"></i></button></td>
								</tr>';

							$total_item = $total_item + 1;

						}
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
