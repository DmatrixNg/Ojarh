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

//get posted data
$data = json_decode(file_get_contents("php://input"));

$user->senderid = $_SESSION['userid'];
$receiverid = isset($_POST['receiverid']) ? $_POST['receiverid'] : die("Receiver is empty");
$rid = explode('-', $receiverid);
$user->receiverid = $rid[1];
// $user->subj = isset($_POST['subj']) ? $_POST['subj'] : die("Subject is empty");
$user->msg = isset($_POST['msg']) ? $_POST['msg'] : die("Message is empty");
$user->messageid = date('ymdhms');
$user->status = 0;

if ($user->send_messager()) {
    echo 'Message sent!';
    return true;
}