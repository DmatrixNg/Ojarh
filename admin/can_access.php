<?php
  if(
  	!isset($_SESSION['role']) || 
  	empty($_SESSION['role'])  || 
  	($_SESSION['role']!='Admin' && $_SESSION['role']!='Sub Admin' )
  )
  {
    session_destroy();
    session_unset();
    header("Location: " . BASE_URL);
  }

  // if(isset($_POST['marketname'])){
  //   $userClass->market_list();
  // }
?>