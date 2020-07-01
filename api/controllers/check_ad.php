<?php

header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT, GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Controller.php';
include_once '../models/core.php';

$db = getDB();

$user = new Users($db);

$data = json_decode(file_get_contents("php://input"));

$returnLocation = strtolower($_SESSION['role']);

// die(var_dump($_FILES['adimg']));
$adslocation = $_POST['adslocation'];
$file_name = @$_FILES['adimg']['name'];
$file_size = @$_FILES['adimg']['size'];
$file_tmp = @$_FILES['adimg']['tmp_name'];
$file_type = @$_FILES['adimg']['type'];

$file_name  = mt_rand(100000, 999999)."-".$file_name;
if(is_uploaded_file($file_tmp)){
 if ($adslocation == "top" ) {
   $image_info = getimagesize($_FILES['adimg']['tmp_name']);
   $image_width = $image_info[0];
   $image_height = $image_info[1];
    if ($image_height < 90 && $image_width > 300) {
      echo "<b class='text-success'>Congratulation Ads Format Accepted</b>";
        return true;
    }
    else {
      echo "<b class='text-danger'>Ads shape not supported, Please try another Ads location.</b>";
        return true;
    }

 }
 if ($adslocation == "body") {

   $image_info = getimagesize($_FILES['adimg']['tmp_name']);
   $image_width = $image_info[0];
   $image_height = $image_info[1];
    if ($image_height < 250 && $image_width < 300) {
      echo "<b class='text-success'>Congratulation Ads Format Accepted</b>";
        return true;
    }else {
      echo "<b class='text-danger'>Ads shape not supported, Please try another Ads location.</b>";
        return true;
    }
 }
 if ($adslocation == "sidebar") {

   $image_info = getimagesize($_FILES['adimg']['tmp_name']);
   $image_width = $image_info[0];
   $image_height = $image_info[1];
    if (($image_height > 600 && $image_width < 270) || ($image_height < 600 && $image_width < 270)) {
      echo "<b class='text-success'>Congratulation Ads Format Accepted</b>";

        return true;
    }else {
      echo "<b class='text-danger'>Ads shape not supported, Please try another Ads location.</b>";
        return true;
    }
 }
 if ($adslocation == "footer") {
   $image_info = getimagesize($_FILES['adimg']['tmp_name']);
   $image_width = $image_info[0];
   $image_height = $image_info[1];
    if ($image_height < 90 && $image_width > 300) {
      echo "<b class='text-success'>Congratulation Ads Format Accepted</b>";
        return true;
    }else {
      echo "<b class='text-danger'>Ads shape not supported, Please try another Ads location.</b>";
        return true;
    }
 }

}
 else{
   echo "<b class='text-danger'>Please Input Ads image First.</b>";

 	return false;
 }

?>
