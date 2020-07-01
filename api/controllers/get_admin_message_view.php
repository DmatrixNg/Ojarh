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
$view = isset($_GET['view']) ? $_GET['view'] : '';
$messageid = isset($_GET['messageid']) ? $_GET['messageid'] : '';
// $user->get_messages();
$user->admin = $_SESSION['userid'];
$user->role = $_SESSION['role'];


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
if($user->admin == 1111 AND $user->role == 'Admin'){

$output = "";
if ($view == "inbox") {

  $output .='<div class="app-inner-layout__content card pt-4 pl-4 pr-4 pb-4">
          <div class="app-inner-layout__top-pane row mb-2">
              <div class="pane-left col-md-4">
                  <div class="mobile-app-menu-btn">
                      <button type="button" class="hamburger hamburger--elastic">
                      <span class="hamburger-box">
                          <span class="hamburger-inner"></span>
                      </span>
                      </button>
                  </div>
                  <h4 class="mb-0">Inbox</h4>
              </div>
              <div class="pane-right col-md-8">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">
                              <i class="fa fa-search fa-w-16 "></i>
                          </div>
                      </div>
                      <input placeholder="Search..." type="text" class="form-control"></div>
              </div>
          </div>
          <div class="bg-white">
              <div class="table-responsive">
                  <table class="text-nowrap table-lg mb-0 table table-hover">
                      <tbody>';
                      $values = $user->get_admin_messages();
                      
                      foreach ($values as $value) {

                        $output .='
                        <tr>
                        <td class="text-center" style="width: 78px;">
                        <div class="custom-checkbox custom-control">
                        <input type="checkbox" id="eCheckbox'.$value['id'].'"
                        class="custom-control-input">
                        <label class="custom-control-label"
                        for="eCheckbox'.$value['id'].'">&nbsp;</label>
                        </div>
                        </td>
                        <td class="text-left pl-1">
                        <i class="fa fa-star"></i>
                        </td>
                        <td>
                        <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-3">
                        <img width="42" class="rounded-circle"
                        src="assets/images/avatars/1.jpg" alt="">
                        </div>
                        <div class="widget-content-left">
                        <div class="widget-heading">'.$value['complainer_fullname'].'</div>
                        <!-- <div class="widget-subheading">Last seen online 15
                        minutes ago
                        </div> -->
                        </div>
                        </div>
                        </div>
                        </td>
                        <td class="text-left"><a href="javascript:getMessage('.""."{$value['id']}"."".')">'.$value['subject_request'].'</a>
                        </td>
                        <td>
                        <i class="fa fa-tags fa-w-20 opacity-4"></i>
                        </td>
                        <td class="text-right">
                        <i class="fa fa-calendar-alt opacity-4 mr-2"></i>
                        '.get_time_ago( strtotime($value['date_created']) ).'
                        </td>
                        </tr>';
                      }
                    $output .='  </tbody>
                  </table>
              </div>
          </div>
      </div>
';
print($output);
return;
}
if ($view == "sent") {
  echo '    <div class="app-inner-layout__content card pt-4 pl-4 pr-4 pb-4">
          <div class="app-inner-layout__top-pane row mb-2">
              <div class="pane-left col-md-4">
                  <div class="mobile-app-menu-btn">
                      <button type="button" class="hamburger hamburger--elastic">
                      <span class="hamburger-box">
                          <span class="hamburger-inner"></span>
                      </span>
                      </button>
                  </div>
                  <h4 class="mb-0">Sent Messages</h4>
              </div>
              <div class="pane-right col-md-8">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">
                              <i class="fa fa-search fa-w-16 "></i>
                          </div>
                      </div>
                      <input placeholder="Search..." type="text" class="form-control"></div>
              </div>
          </div>
          <div class="bg-white">
              <div class="table-responsive">
                  <table class="text-nowrap table-lg mb-0 table table-hover">
                      <tbody>';
                      $values = $user->get_admin_sent_messages($_SESSION['userid']);
                      // print_r(  $value);
                      if ($values->fetchColumn() > 0) {


                      foreach ($values as $value) {

                        $output .='
                        <tr>
                        <td class="text-center" style="width: 78px;">
                        <div class="custom-checkbox custom-control">
                        <input type="checkbox" id="eCheckbox'.$value['id'].'"
                        class="custom-control-input">
                        <label class="custom-control-label"
                        for="eCheckbox'.$value['id'].'">&nbsp;</label>
                        </div>
                        </td>
                        <td class="text-left pl-1">
                        <i class="fa fa-star"></i>
                        </td>
                        <td>
                        <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-3">
                        <img width="42" class="rounded-circle"
                        src="assets/images/avatars/1.jpg" alt="">
                        </div>
                        <div class="widget-content-left">
                        <div class="widget-heading">'.$value['complainer_fullname'].'</div>
                        <!-- <div class="widget-subheading">Last seen online 15
                        minutes ago
                        </div> -->
                        </div>
                        </div>
                        </div>
                        </td>
                        <td class="text-left"><a href="javascript:getview('."'seen'".')">'.$value['subject_request'].'</a>
                        </td>
                        <td>
                        <i class="fa fa-tags fa-w-20 opacity-4"></i>
                        </td>
                        <td class="text-right">
                        <i class="fa fa-calendar-alt opacity-4 mr-2"></i>
                        '.get_time_ago( strtotime($value['date_created']) ).'
                        </td>
                        </tr>';
                      }
                    }else {
                      $output .='No Sent Message';
                    }
                    $output .='

                      </tbody>
                  </table>
              </div>
          </div>
      </div>
';
print($output);
return;
}

if ($view == "seen") {
  $row = $user->get_admin_message($messageid);
// print_r($row);
  $output = '
  <div class="app-inner-layout__content card pt-4 pl-4 pr-4 pb-4">
        <div class="app-inner-layout__top-pane row mb-2">
            <div class="pane-left col-md-4">
                <div class="mobile-app-menu-btn">
                    <button type="button" class="hamburger hamburger--elastic">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                    </button>
                </div>
                <h4 class="mb-0">View Messages</h4>
            </div>
            <div class="pane-right col-md-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search fa-w-16 "></i>
                        </div>
                    </div>
                    <input placeholder="Search..." type="text" class="form-control"></div>
            </div>
        </div>
  <div class="bg-white">
  <div id="mmm"/>
<form action="" method="post" id="result'.$row->id.'">
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">Message By:</label>
    <input type="text" class="form-control" id="complainer_fullname" value="'.$row->complainer_fullname.'" readonly>
  </div>
  <div class="form-group">
    <label for="recipient-email" class="col-form-label">Email:</label>
    <input type="text" class="form-control" id="complainer_email" value="'.$row->complainer_email.'" readonly>
  </div>
  <div class="form-group">
    <label for="recipient-email" class="col-form-label">Phone no:</label>
    <input type="text" class="form-control" id="complainer_phone" value="'.$row->complainer_phone.'" readonly>
  </div>
  <div class="form-group">
    <label for="recipient-email" class="col-form-label">Against:</label>
    <input type="text" class="form-control" id="against" value="'.$row->against.'" readonly>
  </div>
  <div class="form-group">
    <label for="recipient-email" class="col-form-label">Report File:</label>
    ';
    if($row->evidencefile == "")
    {
      $output .="NO EVIDENCE";
    }else {
      $output .='<a target="_blank" href="../disputefile/'.$row->evidencefile.'/'.$row->evidencefile.'">Click to view Evidence</a>';
    }
$output .='  </div>
  <div class="form-group">
    <label for="message-text" class="col-form-label">Subject:</label>
    <textarea class="form-control" id="message-text" readonly>'.$row->subject_request.'</textarea>
  </div>
  <div class="form-group">
    <label for="message-text" class="col-form-label">Message:</label>
    <textarea class="form-control" id="message_inform" readonly>'.$row->message_inform.'</textarea>
  </div>

  <div class="form-group">

    <label for="message-text" class="col-form-label">Response via Email:</label>
    <textarea id="subject_request"class="form-control" name="r_body" id="message-text"></textarea>
  </div>
</form></div>
<button type="button" id="replyBtn'.$row->id.'"  class="btn btn-danger">Send Email</button>
</div>

</div>
</div>';
print($output);
return;
}
if ($view == "create") {
  $row = $user->get_admin_message('user');
// print_r($row);
  $output = '
  <div class="app-inner-layout__content card pt-4 pl-4 pr-4 pb-4">
        <div class="app-inner-layout__top-pane row mb-2">
            <div class="pane-left col-md-4">
                <div class="mobile-app-menu-btn">
                    <button type="button" class="hamburger hamburger--elastic">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                    </button>
                </div>
                <h4 class="mb-0">New Message</h4>
            </div>
            <div class="pane-right col-md-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search fa-w-16 "></i>
                        </div>
                    </div>
                    <input placeholder="Search..." type="text" class="form-control"></div>
            </div>
        </div>
  <div class="bg-white">
<form action="" method="post" id="result">
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">Message to:</label>
    <input type="text" class="form-control" id="receiverid" name="receiverid" value="" >
  </div>


  <div class="form-group">
    <label for="message-text" class="col-form-label">Type New Message:</label>
    <textarea id="subject_request"class="form-control" name="r_body" id="message-text"></textarea>
  </div>
</form></div>
<button type="button" id="replyBtn" onclick="sendMseller()" class="btn btn-danger">Send message</button>
</div>

</div>
</div>';
print($output);
return;
}
}else{
	echo 'You have no permission to perform this task!';
	return;
}
?>
