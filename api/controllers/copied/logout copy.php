<?php
// include_once '../config/Database.php';
// include_once '../models/all.php';
// include_once '../models/core.php';


// $db = getDB();

// $user = new Users($db);

// $user->logout();

// header('location: index.php');

include('../config/Database.php');
$userid='';
$_SESSION['userid']='';
session_destroy();
session_unset();
if(empty($useruid) && empty($_SESSION['userid']))
	{
		$url=BASE_URL . 'index.php';
		header("Location: $url");
		//echo "<script>window.location='$url'</script>";
	}
?>