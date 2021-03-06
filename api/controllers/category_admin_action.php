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

$catid = isset($_POST['catid']) ? $_POST['catid'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

if($_SESSION['role'] == 'Admin'){
    if($action == 'edit_category'){
        if($user->edit_category($catname, $catdescription, $catImage, $catid)){
            return true;
        }
    }elseif($action == 'delete_category'){
        if($user->delete_category($catid)){
            return true;
        }
    }

}

?>