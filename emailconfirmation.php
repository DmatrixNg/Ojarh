<?php
    $auth_id = isset($_GET['auth_id']) ? $_GET['auth_id'] : '';
    $conf_id = isset($_GET['conf_id']) ? $_GET['conf_id'] : '';

    if($auth_id == '' || $conf_id==''){
        header('Location: sign_up?mess=Unable to authenticate your email, contact our online customer care!');
    }else{
        header('Location: api/controllers/confirm_email.php?auth_id='.$auth_id.'&conf_id='.$conf_id);
    }

?>