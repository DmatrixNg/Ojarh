<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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
$data = json_decode(file_get_contents("php://input"));

$data = serialize($_POST);
foreach($_POST as $i => $item) {
    echo $item[$i]['sellerid'];
    echo $item[$i]['productid'];

    // $array[$i] is same as $item
}
// print_r($data);

// $user->grand_total_dollar = isset($_POST['grand_total_dollar']) ? $_POST['grand_total_dollar'] : die();
// $user->grand_total_naira = isset($_POST['grand_total_naira']) ? $_POST['grand_total_naira'] : die();

// $user->orderid = date('ymdhms');
// $user->status = 0;
// $user->addordertemp();


