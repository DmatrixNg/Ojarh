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
                      $values = $user->get_messages($_SESSION['userid']);
                      // print_r(  $value);
                      if($user->message_count($_SESSION['userid'], "inbox") > 0){


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
                        <div class="widget-heading">'.$value['b_name'].'</div>
                        <!-- <div class="widget-subheading">Last seen online 15
                        minutes ago
                        </div> -->
                        </div>
                        </div>
                        </div>
                        </td>
                        <td class="text-left"><a href="javascript:getMessage('.""."{$value['id']}"."".')">'.$value['b_message'].'</a>
                        </td>
                        <td>
                        <i class="fa fa-tags fa-w-20 opacity-4"></i>
                        </td>
                        <td class="text-right">
                        <i class="fa fa-calendar-alt opacity-4 mr-2"></i>
                        '.get_time_ago( strtotime($value['date_submited']) ).'
                        </td>
                        </tr>';
                      }
                    }else{
                      $output .="No New Message";
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
                      $values = $user->get_sent_messages($_SESSION['userid']);
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
                        <div class="widget-heading">'.$value['b_name'].'</div>
                        <!-- <div class="widget-subheading">Last seen online 15
                        minutes ago
                        </div> -->
                        </div>
                        </div>
                        </div>
                        </td>
                        <td class="text-left"><a href="javascript:getMessage('.""."{$value['id']}"."".')">'.$value['b_message'].'</a>
                        </td>
                        <td>
                        <i class="fa fa-tags fa-w-20 opacity-4"></i>
                        </td>
                        <td class="text-right">
                        <i class="fa fa-calendar-alt opacity-4 mr-2"></i>
                        '.get_time_ago( strtotime($value['date_submited']) ).'
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
  $row = $user->get_message($messageid);
// print_r($messageid);
// die(var_dump($row));
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
    <input type="text" class="form-control" id="b_name" value="'.$row->b_name.'" readonly>
  </div>
  <div class="form-group">
    <label for="message-text" class="col-form-label">Message:</label>
    <textarea class="form-control" id="message-text" readonly>'.$row->b_message.'</textarea>
  </div>

  <div class="form-group">
  <input type="hidden" name="receiverid" id="receiverid" value="'.$row->userid.'">

    <label for="message-text" class="col-form-label">Type Reply:</label>
    <textarea id="b_message"class="form-control" name="r_body" id="message-text"></textarea>
  </div>
</form></div>
<button type="button" id="replyBtn'.$row->id.'" onclick="sendMseller()" class="btn btn-danger">Send reply</button>
</div>

</div>
</div>';
print($output);
return;
}
if ($view == "create") {
  $row = $user->get_message('user');
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
    <input type="text" class="form-control" id="receiverid" onclick="fetch_seller(this.id);" onfocus="fetch_seller(this.id);" onkeyup="fetch_seller(this.id);" name="receiverid">
    <div id="searcher"></div>
  </div>


  <div class="form-group">
    <label for="message-text" class="col-form-label">Type New Message:</label>
    <textarea id="b_message"class="form-control" name="r_body" id="message-text"></textarea>
  </div>
</form>
<div id="mmm"/>
</div>

<button type="button" id="replyBtn" onclick="sendMseller()" class="btn btn-danger">Send message</button>
</div>

</div>
</div>';
print($output);
return;
}
?>
