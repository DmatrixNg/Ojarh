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



$user->userid =  $_SESSION['userid'];

$userDetails = $user->userDetails($user->userid);

if ($userDetails->role == "Seller"){$role ="seller";}if ($userDetails->role == "International"){$role ="international";}

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

if(empty($_FILES)){
	header("Location: ".BASE_URL.$role."/shop_gallery.php?result=You must add at least one store image!");
	return;
}else{
	// $user->file_name0  = $user->userid."-".$user->file_name0;
}
$bizdata = $user->bizDetails($user->userid);

$storeimgs = json_decode(@$bizdata->storeimage);

// die(var_dump($storeimgs->picture0));

if($user->file_name0 == ''){
	$user->file_name0 = $file_size0 = $file_tmp0 = $file_type0 = $storeimgs->picture0;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name0  = $user->userid."-".$rnd.$user->file_name0;
}

if($user->file_name1 == ''){
	$user->file_name1 = $file_size1 = $file_tmp1 = $file_type1 = $storeimgs->picture1;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name1  = $user->userid."-".$rnd.$user->file_name1;
}

if($user->file_name2 == ''){
	$user->file_name2 = $file_size2 = $file_tmp2 = $file_type2 = $storeimgs->picture2;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name2  = $user->userid."-".$rnd.$user->file_name2;
}

if($user->file_name3 == ''){
	$user->file_name3 = $file_size3 = $file_tmp3 = $file_type3 = $storeimgs->picture3;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name3  = $user->userid."-".$rnd.$user->file_name3;
}

if($user->file_name4 == ''){
	$user->file_name4 = $file_size4 = $file_tmp4 = $file_type4 = $storeimgs->picture4;
}else{
	$rnd = rand(000000, 999999);
	$user->file_name4  = $user->userid."-".$rnd.$user->file_name4;
}

$user->pictures = [
					"picture0" => $user->file_name0,
					"picture1" => $user->file_name1,
					"picture2" => $user->file_name2,
					"picture3" => $user->file_name3,
					"picture4" => $user->file_name4
				];
$user->storeimage = json_encode($user->pictures);

if(is_uploaded_file($user->file_tmp0) || is_uploaded_file($user->file_tmp1) || is_uploaded_file($user->file_tmp2) || is_uploaded_file($user->file_tmp3) || is_uploaded_file($user->file_tmp4)){
    if($user->file_size0 > 1097152 || $user->file_size1 > 1097152 || $user->file_size2 > 1097152 || $user->file_size3 > 1097152 || $user->file_size4 > 1097152){
    	header('Location: '.BASE_URL.$role.'/shop_gallery.php?result=File must not exceed 1MB.');
        return true;
    }else{
    	if($user->addstoreimage()){

    		if ( !is_dir( "../../".$role."/storepicture/".$user->userid) ) {
				// mkdir( "../../".$role."/storepicture/$user->userid");
				mkdir('../../'.$role.'/storepicture/'.$user->userid, 0777, true);
				move_uploaded_file($user->file_tmp0,"../../".$role."/storepicture/".$user->userid."/".$user->file_name0);
				move_uploaded_file($user->file_tmp1,"../../".$role."/storepicture/".$user->userid."/".$user->file_name1);
				move_uploaded_file($user->file_tmp2,"../../".$role."/storepicture/".$user->userid."/".$user->file_name2);
				move_uploaded_file($user->file_tmp3,"../../".$role."/storepicture/".$user->userid."/".$user->file_name3);
				move_uploaded_file($user->file_tmp4,"../../".$role."/storepicture/".$user->userid."/".$user->file_name4);

				header('Location: '.BASE_URL.'seller/shop_gallery.php?result=Store pictures added successfully!');
				return true;

			}else{
				move_uploaded_file($user->file_tmp0,"../../".$role."/storepicture/".$user->userid."/".$user->file_name0);
				move_uploaded_file($user->file_tmp1,"../../".$role."/storepicture/".$user->userid."/".$user->file_name1);
				move_uploaded_file($user->file_tmp2,"../../".$role."/storepicture/".$user->userid."/".$user->file_name2);
				move_uploaded_file($user->file_tmp3,"../../".$role."/storepicture/".$user->userid."/".$user->file_name3);
				move_uploaded_file($user->file_tmp4,"../../".$role."/storepicture/".$user->userid."/".$user->file_name4);

				header('Location: '.BASE_URL.$role.'/shop_gallery.php?result=Store pictures added successfully!');
				return true;
			}

		}else{
			header("Location: ".BASE_URL.$role."/shop_gallery.php?result=Fail to add store pictures, try again!");
			return false;
		}
    }

}else{
	header('Location: '.BASE_URL.$role.'/shop_gallery.php?result=Please upload at least one store picture!');
	return false;
}

?>
