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
$id = isset($_GET['id']) ? $_GET['id'] : '';
// $messageid = isset($_GET['messageid']) ? $_GET['messageid'] : '';
// $user->get_messages();

function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'yr',
                30 * 24 * 60 * 60       =>  'mth',
                24 * 60 * 60            =>  'd',
                60 * 60                 =>  'h',
                60                      =>  'm',
                1                       =>  's'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? '' : '' ) . ' ago';
        }
    }

}
print($user->disputeMessages($id));


?>
