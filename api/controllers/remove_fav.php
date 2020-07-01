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
$productID = isset($_POST['ino']) ? $_POST['ino'] : '';

$userid = $_SESSION['userid'];

if($user->remove_from_fav($userid, $productID)){
    return true;
}

?>