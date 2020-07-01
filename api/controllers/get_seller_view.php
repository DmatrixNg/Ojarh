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
$id = isset($_GET['id']) ? $_GET['id'] : '';
$uid = isset($_GET['uid']) ? $_GET['uid'] : '';
// $user->get_messages();


$output = "";
if ($view == "access") {

// die(print_r($uid));
  $user->userid = $uid;
  $user->business_id = $id;

  if ($user->requestBAccess()) {
    $output .='
    <div class="home-title style-grid">
        <span>BUSINESS DETAILS</span>
        <!-- <a class="btn-deals" href=" /collections/electronics-computer">View All</a> -->
    </div>
    <div id="pfBody" class="card-body">
    REQUEST ACCESS SENT. CHECK BACK LATER.
    </div>
    ';
  }else {
    $output .='
    <div class="home-title style-grid">
        <span>BUSINESS DETAILS</span>
        <!-- <a class="btn-deals" href=" /collections/electronics-computer">View All</a> -->
    </div>
    <div id="pfBody" class="card-body">
    REQUEST ALREADY SENT. PLEASE CHECK BACK LATER.
    </div>
    ';

  }
print($output);
return;
}
if ($view == "contact") {

  echo '   <div class="home-title style-grid">
      <span>CONTACT SELLER</span>
      <!-- <a class="btn-deals" href=" /collections/electronics-computer">View All</a> -->
  </div>
       <div class="simpAskForm-container" id="simpAskForm_container">
            <div class="form-group">
              <textarea required style="resize:none; min-height:86px;" class="form-control" name="b_message" id="b_message" placeholder="Type your message here"></textarea>
            </div>
            <div class="form-group">
              <input required type="text" name="b_name" value="" placeholder="Your Name" class="form-control" id="b_name">
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <input required type="text" name="b_phone" value="" placeholder="Your Phone Number" class="form-control" id="b_phone">
              </div>
              <div class="col-md-6">
                <input required type="email" name="b_email" value="" placeholder="Your Email" class="form-control" id="b_email">
              </div>
            </div>
            <div class="form-group row mmm">
            </div>
            <div class="simpAskSubmitForm">
              <input type="hidden" id="productid" name="productid" value="">
              <input class="button button-primary btn btn-primary btn btn--fill btn--color" type="button" id="'.$id .'" onclick="sendMseller(this.id)" value=" Submit">
              <a href="javascript:void(0)" class="simpAskForm-cancel-btn button">Cancel</a>
              <div class="clear"></div>
            </div>
        </div>

';
print($output);
return;
}

if ($view == "business") {
  $bizdata = $user->bizDetails($id);
  $userDetails = $user->userDetails($id);
// print_r($row);
if ($bizdata == "empty") {
  echo "Business Not Registered";
  return;
}else {
  $check=$user->get_user_business_access(@$_SESSION['userid']);
  // die(print_r(count($check).'-'));
  if ($bizdata->privacy == "private" && count($check) == 0) {

      $output = '

    <div class="home-title style-grid">
        <span>BUSINESS DETAILS</span>
    </div>
    <div id="pfBody" class="card-body">
        <div class="forms-wizard-vertical">
            <h4>Buiness Details: Private</h4>';
            if (!isset($_SESSION['userid'])) {

              $output .='<a href="'.BASE_URL.'signin.php?redirect='.$_SERVER['REQUEST_URI'].'" class="btn btn-default btn-sm">Signin to Request Access</a>
              ';
            }else {
              // code...
              $output .='  <a href="javascript:getSellerView('.$id.','.'`'.'access'.'`'.','.$_SESSION['userid'].');" style="font-size: 16px">Request Access</a>
              ';
            }

            $output .='
        </div>

    </div>
  ';
  print($output);
  return;
  }else {


  $output = '

  <div class="home-title style-grid">
      <span>BUSINESS DETAILS</span>
      <!-- <a class="btn-deals" href=" /collections/electronics-computer">View All</a> -->
  </div>
  <div class="row">
  <div class="dropdown-menu-header col-md-4" style="height: 300px !important; margin-top: -20px !important;">
      <div class="front-side" style="height: 300px;">
          <div class="color-grid">
              <div class="black"></div>
              <div class="red1"></div>
              <div class="red2"></div>
              <div class="green"></div>
          </div>
          <div class="info-grid text-white">
              <div class="name">
                  <h5>'.ucfirst($userDetails->fname).' '.ucfirst($userDetails->lname).'</h5>
                  <h5>'. strtoupper($bizdata->bizname).'</h5>
              </div>
              <div class="addr">
                  <i class="fa fa-map fa-2x mb-2"></i>
                  <p style="width: 130px;">'.$bizdata->bizaddress.',<br>
                  </p>
              </div>
              <div class="phoneNo">
                  <i class="fa fa-phone fa-2x mb-2"></i>
                  <p><strong>'.$bizdata->bizphone.'</strong></p>
                  <p><strong>'.$userDetails->phone.'</strong></p>
              </div>
              <div class="emailId mb-2">
                  <i class="fa fa-laptop fa-2x mb-2"></i>
                  <p class="email"><strong>'.$bizdata->bizemail.'</strong></p>
                  <p class="web">
                      <strong>'.$bizdata->bizwebsite.'</strong>
                  </p>
              </div>
          </div>
      </div>
  </div>

  <div id="pfBody" class="col-md-8">
      <div class="forms-wizard-vertical">
          <div class="">
              <div class="divider"></div>
              <div id="messer"></div>
              <div class="form-group">
                  <label for="exampleEmail5">Business Name</label>
                  <input type="text" id="bizname" name="bizname"
                         value="'.@$bizdata->bizname.'"
                         class="form-control" disabled>
              </div>
              <div class="form-group row">
                  <div class="col-md-6">
                      <label for="exampleEmail5">Business Phone Number</label>
                      <input type="number" id="bizphone" name="bizphone"
                         value="'.@$bizdata->bizphone.'"
                         class="form-control" disabled>
                  </div>
                  <div class="col-md-6">
                      <label for="exampleEmail5">Business Email</label>
                      <input type="email" id="bizemail" name="bizemail"
                         value="'.@$bizdata->bizemail.'"
                         class="form-control" disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-12">
                      <label>Company registration date</label>
                      <input type="text" id="bizregdate" name="bizregdate" class="form-control"
                     data-toggle="datepicker" value="'.@$bizdata->bizregdate.'" disabled/>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-12">
                      <label>Service</label>
                      <input type="text" id="service" value="'.@$bizdata->service.'" name="service" class="form-control" disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-12">
                      <label for="exampleEmail5">Business State Locations</label>
                      <input name="bizstate" id="bizstate" value="'.@$bizdata->bizstate.'" class="multiselect-dropdown form-control" disabled>

                  </div>
              </div>

              <div class="form-group">
                  <label for="exampleEmail5">Business Address</label>
                  <textarea class="form-control" rows="3" name="bizaddress" id="bizaddress" disabled>'.@$bizdata->bizaddress.'</textarea>
              </div>
              <div class="form-group">
                  <label for="exampleEmail5">Business Website</label>
                  <input type="text" id="bizwebsite" name="bizwebsite"
                         value="'.@$bizdata->bizwebsite.'"
                         class="form-control" disabled>
              </div>
          </div>
      </div>
      </div>

  </div>
';
print($output);
return;
}
}
}
?>
