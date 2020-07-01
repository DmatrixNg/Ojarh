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

//Get raw posted data
//$data = json_decode(file_get_contents("php://input"));

//sponsor generated id
//$user->sponsorLink = isset($_GET['sponsor']) ? $_GET['sponsor'] : die();
$result = array();
if ($_SESSION['role'] == "Seller") {
	$locator = SELLER_URL;}
if ($_SESSION['role'] == "International") {
	$locator = INTERNATIONAL_URL;}
if ($_SESSION['role'] == "Buyer") {
	$locator = BUYER_URL;}
if ($_SESSION['role'] == "Admin") {
	$locator = ADMIN_URL;}
if ($_SESSION['role'] == "Sub Admin") {
	$locator = ADMIN_URL;}
$user->productstatus = 'Active';
$user->productid = isset($_POST['productid']) ? $_POST['productid'] : die();

$user->userid =  $_SESSION['userid'];

// echo $user->productid;
// return;
$user->product_title = isset($_POST['product_title']) ? $_POST['product_title'] : die();
$user->market = isset($_POST['market']) ? $_POST['market'] : die("Market field is empty.");
$user->countryorigin = isset($_POST['countryorigin']) ? $_POST['countryorigin'] : die();
$user->expiration = isset($_POST['expiration']) ? $_POST['expiration'] : die();
$user->performance = isset($_POST['performance']) ? $_POST['performance'] : die();
$user->size = isset($_POST['size']) ? $_POST['size'] : die();
$user->color = isset($_POST['color']) ? $_POST['color'] : die();

$user->product_category = isset($_POST['product_category']) ? $_POST['product_category'] : die();
$user->product_type = isset($_POST['product_type']) ? $_POST['product_type'] : die();
$user->seller = isset($_POST['seller']) ? $_POST['seller'] : die();
$user->seller_catalogue = isset($_POST['seller_catalogue']) ? $_POST['seller_catalogue'] : die();
// print_r($_POST);
$user->product_description = isset($_POST['product_description']) ? $_POST['product_description'] : die();
$user->productavailability = isset($_POST['productavailability']) ? $_POST['productavailability'] : die();
if($user->product_title == '' || $user->product_category=='' || $user->product_description=='' || $user->productavailability=='' || $user->market=='' || $user->countryorigin=='' || $user->expiration=='' || $user->performance==''){
	header("location: ".$locator."edit_product.php?productid=".$user->productid."&result=One of the field is empty");
	return;
}


// var_dump($_POST);
$user->product_pack0 = isset($_POST['product_pack0']) ? $_POST['product_pack0'] : die();
$user->product_price0 = isset($_POST['product_price0']) ? $_POST['product_price0'] : die();
$user->product_discount0 = isset($_POST['product_discount0']) ? $_POST['product_discount0'] : die();

if($user->product_pack0 == '' || $user->product_price0 == '' || $user->product_discount0 == ''){
	header("location: ".$locator."edit_product.php?productid=".$user->productid."&result=You must add at least one product pack details!");
	return;
}else{
	$user->pack0 = htmlentities($user->product_pack0.'@'.$user->product_price0.'@'.$user->product_discount0);
}


if(isset($_POST['product_pack1'])){
	$user->product_pack1 = isset($_POST['product_pack1']) ? $_POST['product_pack1'] : die();
	$user->product_price1 = isset($_POST['product_price1']) ? $_POST['product_price1'] : die();
	$user->product_discount1 = isset($_POST['product_discount1']) ? $_POST['product_discount1'] : die();

	$user->pack1 = htmlentities($user->product_pack1.'@'.$user->product_price1.'@'.$user->product_discount1);
}else{
	$user->product_pack1 = $user->product_price1 = $user->product_discount1 = 0;
	$user->pack1 = 0;
}

if(isset($_POST['product_pack2'])){
	$user->product_pack2 = isset($_POST['product_pack2']) ? $_POST['product_pack2'] : die();
	$user->product_price2 = isset($_POST['product_price2']) ? $_POST['product_price2'] : die();
	$user->product_discount2 = isset($_POST['product_discount2']) ? $_POST['product_discount2'] : die();

	$user->pack2 = htmlentities($user->product_pack2.'@'.$user->product_price2.'@'.$user->product_discount2);
}else{
	$user->product_pack2 = $user->product_price2 = $user->product_discount2 = 0;
	$user->pack2 = 0;
}

if(isset($_POST['product_pack3'])){
	$user->product_pack3 = isset($_POST['product_pack3']) ? $_POST['product_pack3'] : die();
	$user->product_price3 = isset($_POST['product_price3']) ? $_POST['product_price3'] : die();
	$user->product_discount3 = isset($_POST['product_discount3']) ? $_POST['product_discount3'] : die();

	$user->pack3 = htmlentities($user->product_pack3.'@'.$user->product_price3.'@'.$user->product_discount3);
}else{
	$user->product_pack3 = $user->product_price3 = $user->product_discount3 = 0;
	$user->pack3 = 0;
}

if(isset($_POST['product_pack4'])){
	$user->product_pack4 = isset($_POST['product_pack4']) ? $_POST['product_pack4'] : die();
	$user->product_price4 = isset($_POST['product_price4']) ? $_POST['product_price4'] : die();
	$user->product_discount4 = isset($_POST['product_discount4']) ? $_POST['product_discount4'] : die();

	$user->pack4 = htmlentities($user->product_pack4.'@'.$user->product_price4.'@'.$user->product_discount4);
}else{
	$user->product_pack4 = $user->product_price4 = $user->product_discount4 = 0;
	$user->pack4 = 0;
}

if(isset($_POST['product_pack5'])){
	$user->product_pack5 = isset($_POST['product_pack5']) ? $_POST['product_pack5'] : die();
	$user->product_price5 = isset($_POST['product_price5']) ? $_POST['product_price5'] : die();
	$user->product_discount5 = isset($_POST['product_discount5']) ? $_POST['product_discount5'] : die();

	$user->pack5 = htmlentities($user->product_pack5.'@'.$user->product_price5.'@'.$user->product_discount5);
}else{
	$user->product_pack5 = $user->product_price5 = $user->product_discount5 = 0;
	$user->pack5 = 0;
}

if(isset($_POST['product_pack6'])){
	$user->product_pack6 = isset($_POST['product_pack6']) ? $_POST['product_pack6'] : die();
	$user->product_price6 = isset($_POST['product_price6']) ? $_POST['product_price6'] : die();
	$user->product_discount6 = isset($_POST['product_discount6']) ? $_POST['product_discount6'] : die();

	$user->pack6 = htmlentities($user->product_pack6.'@'.$user->product_price6.'@'.$user->product_discount6);
}else{
	$user->product_pack6 = $user->product_price6 = $user->product_discount6 = 0;
	$user->pack6 = 0;
}

if(isset($_POST['product_pack7'])){
	$user->product_pack7 = isset($_POST['product_pack7']) ? $_POST['product_pack7'] : die();
	$user->product_price7 = isset($_POST['product_price7']) ? $_POST['product_price7'] : die();
	$user->product_discount7 = isset($_POST['product_discount7']) ? $_POST['product_discount7'] : die();

	$user->pack7 = htmlentities($user->product_pack7.'@'.$user->product_price7.'@'.$user->product_discount7);
}else{
	$user->product_pack7 = $user->product_price7 = $user->product_discount7 = 0;
	$user->pack7 = 0;
}
//
if(isset($_POST['product_pack8'])){
	$user->product_pack8 = isset($_POST['product_pack8']) ? $_POST['product_pack8'] : die();
	$user->product_price8 = isset($_POST['product_price8']) ? $_POST['product_price8'] : die();
	$user->product_discount8 = isset($_POST['product_discount8']) ? $_POST['product_discount8'] : die();

	$user->pack8 = htmlentities($user->product_pack8.'@'.$user->product_price8.'@'.$user->product_discount8);
}else{
	$user->product_pack8 = $user->product_price8 = $user->product_discount8 = 0;
	$user->pack8 = 0;
}


$user->file_name0 = @$_FILES['productimg0']['name'];
$user->file_size0 = @$_FILES['productimg0']['size'];
$user->file_tmp0 = @$_FILES['productimg0']['tmp_name'];
$user->file_type0 = @$_FILES['productimg0']['type'];

$user->file_name1 = @$_FILES['productimg1']['name'];
$user->file_size1 = @$_FILES['productimg1']['size'];
$user->file_tmp1 = @$_FILES['productimg1']['tmp_name'];
$user->file_type1 = @$_FILES['productimg1']['type'];

$user->file_name2 = @$_FILES['productimg2']['name'];
$user->file_size2 = @$_FILES['productimg2']['size'];
$user->file_tmp2 = @$_FILES['productimg2']['tmp_name'];
$user->file_type2 = @$_FILES['productimg2']['type'];

$user->file_name3 = @$_FILES['productimg3']['name'];
$user->file_size3 = @$_FILES['productimg3']['size'];
$user->file_tmp3 = @$_FILES['productimg3']['tmp_name'];
$user->file_type3 = @$_FILES['productimg3']['type'];

$user->file_name4 = @$_FILES['productimg4']['name'];
$user->file_size4 = @$_FILES['productimg4']['size'];
$user->file_tmp4 = @$_FILES['productimg4']['tmp_name'];
$user->file_type4 = @$_FILES['productimg4']['type'];

$user->file_name5 = @$_FILES['productimg5']['name'];
$user->file_size5 = @$_FILES['productimg5']['size'];
$user->file_tmp5 = @$_FILES['productimg5']['tmp_name'];
$user->file_type5 = @$_FILES['productimg5']['type'];

$user->file_name6 = @$_FILES['productimg6']['name'];
$user->file_size6 = @$_FILES['productimg6']['size'];
$user->file_tmp6 = @$_FILES['productimg6']['tmp_name'];
$user->file_type6 = @$_FILES['productimg6']['type'];

$product = $user->get_product_details($user->productid);

if($user->file_name0 == ''){

	$user->file_name0 = $file_size0 = $file_tmp0 = $file_type0 = $product->img0;

}else{
	$user->file_name0  = $user->productid."-".$user->file_name0;

}


if($user->file_name1 == ''){
	$user->file_name1 = $file_size1 = $file_tmp1 = $file_type1 = $product->img1;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name1  = $user->productid."-".$rnd.$user->file_name1;
}

if($user->file_name2 == ''){
	$user->file_name2 = $file_size2 = $file_tmp2 = $file_type2 = $product->img2;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name2  = $user->productid."-".$rnd.$user->file_name2;
}

if($user->file_name3 == ''){
	$user->file_name3 = $file_size3 = $file_tmp3 = $file_type3 = $product->img3;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name3  = $user->productid."-".$rnd.$user->file_name3;
}

if($user->file_name4 == ''){
	$user->file_name4 = $file_size4 = $file_tmp4 = $file_type4 = $product->img4;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name4  = $user->productid."-".$rnd.$user->file_name4;
}

if($user->file_name5 == ''){
	$user->file_name5 = $file_size5 = $file_tmp5 = $file_type5 = $product->img5;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name5  = $user->productid."-".$rnd.$user->file_name5;
}

if($user->file_name6 == ''){
	$user->file_name6 = $file_size6 = $file_tmp6 = $file_type6 = $product->img6;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name6  = $user->productid."-".$rnd.$user->file_name6;
}

$userDetails = $user->userDetails($product->userid);

if ($userDetails->role == "Seller"){$role ="seller";}if ($userDetails->role == "International"){$role ="international";}


if(is_uploaded_file($user->file_tmp0) || is_uploaded_file($user->file_tmp1) || is_uploaded_file($user->file_tmp2) || is_uploaded_file($user->file_tmp3) || is_uploaded_file($user->file_tmp4) || is_uploaded_file($user->file_tmp5) || is_uploaded_file($user->file_tmp6) || is_uploaded_file($user->file_tmp7)){
    if($user->file_size0 > 1097152 || $user->file_size1 > 1097152 || $user->file_size2 > 1097152 || $user->file_size3 > 1097152 || $user->file_size4 > 1097152 || $user->file_size5 > 1097152 || $user->file_size6 > 1097152 ){
    	header('Location: '.$locator.'edit_product.php?productid='.$user->productid.'&result=File must not exceed 1MB.');
        return true;
    }else{
    	if($user->edit_product()){
    		if ( !is_dir(  "../../".$role."/productimg/".$user->productid ) ) {
				mkdir( "../../".$role."/productimg/".$user->productid, 0777, true);
				move_uploaded_file($user->file_tmp0, "../../".$role."/productimg/".$user->productid."/".$user->file_name0);
				move_uploaded_file($user->file_tmp1, "../../".$role."/productimg/".$user->productid."/".$user->file_name1);
				move_uploaded_file($user->file_tmp2, "../../".$role."/productimg/".$user->productid."/".$user->file_name2);
				move_uploaded_file($user->file_tmp3, "../../".$role."/productimg/".$user->productid."/".$user->file_name3);
				move_uploaded_file($user->file_tmp4, "../../".$role."/productimg/".$user->productid."/".$user->file_name4);
				move_uploaded_file($user->file_tmp5, "../../".$role."/productimg/".$user->productid."/".$user->file_name5);
				move_uploaded_file($user->file_tmp6, "../../".$role."/productimg/".$user->productid."/".$user->file_name6);

				header('Location: '.$locator.'edit_product.php?productid='.$user->productid.'&result=Product added successfully!');
				return true;

			}else{
				move_uploaded_file($user->file_tmp0, "../../".$role."/productimg/".$user->productid."/".$user->file_name0);
				move_uploaded_file($user->file_tmp1, "../../".$role."/productimg/".$user->productid."/".$user->file_name1);
				move_uploaded_file($user->file_tmp2, "../../".$role."/productimg/".$user->productid."/".$user->file_name2);
				move_uploaded_file($user->file_tmp3, "../../".$role."/productimg/".$user->productid."/".$user->file_name3);
				move_uploaded_file($user->file_tmp4, "../../".$role."/productimg/".$user->productid."/".$user->file_name4);
				move_uploaded_file($user->file_tmp5, "../../".$role."/productimg/".$user->productid."/".$user->file_name5);
				move_uploaded_file($user->file_tmp6, "../../".$role."/productimg/".$user->productid."/".$user->file_name6);

				header('Location: '.$locator.'edit_product.php?productid='.$user->productid.'&result=Product added successfully!');
				return true;
			}

		}else{
			header("location: ".$locator."edit_product.php?productid='.$user->productid.'&result=Fail to add product, try again!");
			return false;
		}
    }

}else{

	if($user->edit_product()){
		header('Location: '.$locator.'edit_product.php?productid='.$user->productid.'&result=Product Edited successfully!');
		return true;

	}else {

		header('Location: '.$locator.'edit_product.php?productid='.$user->productid.'&result=Error saving changes');
		return false;
	}
}

?>
