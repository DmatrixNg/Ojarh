<?php
include('../api/config/Database.php');
include('../api/models/session.php');
if(!isset($_SESSION['role']) || empty($_SESSION['role'])  || $_SESSION['role']!='International')
    {
        session_destroy();
        session_unset();
        header("Location: " . BASE_URL);
    }
?>
<?php include 'inc/header.php'; ?>
                    <div class="app-inner-layout chat-layout">
                        <?php
                            if($acctType->account_type == 'Starter'){
                                echo '<div class="card-body row">
                                     <div class="alert alert-danger show col-md-12" role="alert">
                                        You can do more when you upgrade your account to BASIC &amp; PREMIUM!
                                        <a href="#"><button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
                                     </div>
                                 </div>';
                            }elseif($acctType->account_type == 'Basic'){
                                echo '<div class="card-body row">
                                     <div class="alert alert-danger show col-md-12" role="alert">
                                        You can do more when you upgrade your account to PREMIUM!
                                        <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
                                     </div>
                                 </div>';
                            }
                         ?>
                         <?php
                            if($acctType->account_type == 'Premium' && $userClass->bizDetails($userid) == 'empty'){
                                echo '<div class="card-body row">
                                            <div class="alert alert-danger show col-md-12" role="alert">
                                            You have to update your business information <a href="business_setting.php"><button class="btn btn-info btn-sm">Update business profile</button></a>
                                            </div>
                                        </div>';
                            }else{

                            }
                        ?>
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__content card">
                                <div class="table-responsive" style="    height: 500px; overflow-y: scroll; margin-bottom: 100px;">
                                    <div class="app-inner-layout__top-pane">
                                        <div class="pane-right">
                                            <div class="btn-group">
                                                <a href="dispute_center.php"><button type="button" class="ml-2 btn btn-primary">
			                                        <span class="opacity-7 mr-1">
			                                            <i class="fa fa-arrow-left"></i>
			                                        </span> Back
                                                </button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-wrapper">
                                      <div id="chat-box" >

                                        <?php $disputeid = $_GET['disputeid'];
                                        $userClass->disputeMessages($disputeid);

                                        $user = $userClass->dispute_users($disputeid);
                                        $senderDetails = $userClass->userDetails($user->senderid);
                                        $againstDetails = $userClass->userDetails($user->againstid);
                                        ?>
                                        </div>
                                    </div>
                                    <div class="app-inner-layout__bottom-pane d-block text-center" style="width: 100%; position: absolute; bottom: 0; left: 0;">
                                        <div class="mb-0 position-relative row form-group">
                                            <div class="col-sm-12 row">
                                              <input type="hidden" id="senderusername" name="senderusername" value="<?php echo $senderDetails->username ?>">
                                              <input type="hidden" id="againstusername" name="againstusername" value="<?php echo $againstDetails->username  ?>">
                                              <input type="hidden" id="disputeid" name="disputeid" value="<?php echo $disputeid ?>">
                                              <input type="hidden" id="senderid" name="senderid" value="<?php echo $_SESSION['userid'] ?>">
                                              <input type="hidden" id="againstid" name="dispute_message" value="<?php echo $againstDetails->userid ?>">
                                                <?php if ($user->status == "Pending" ){ ?>
                                                  <div class="col-12">
                                                  <input id="b_message" placeholder="Awaiting Admin Approval" type="text"
                                                  class="form-control-lg form-control" readonly>
                                                </div>

                                                <?php } ?>
                                                <?php if ($user->status == "In Progress" ){ ?>
                                                  <div class="col-10">

                                                  <input id="b_message" placeholder="Write here and hit enter to send..." type="text"
                                                  class="form-control-lg form-control">
                                                </div>
                                                <div class="col-2">
                                                  <input class="button button-primary btn btn-primary btn btn--fill btn--color" type="button"  onclick="reply_dispute_chat(<?php echo $_SESSION['userid'] ?>)" value=" Submit">
                                                </div>
                                                <?php } ?>
                                                <?php if ($user->status == "Resolved" ){ ?>
                                                  <div class="col-10">

                                                  <input id="b_message" placeholder="Dispute Resolved, Reply to Re-open case" type="text"
                                                  class="form-control-lg form-control">
                                                </div>
                                                <div class="col-2">
                                                  <input class="button button-primary btn btn-primary btn btn--fill btn--color" type="button"  onclick="reply_dispute_chat(<?php echo $_SESSION['userid'] ?>)" value=" Submit">
                                                </div>
                                                <?php } ?>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="app-inner-layout__sidebar card">
                                <div class="app-inner-layout__sidebar-header">
                                    <ul class="nav flex-column">
                                        <li class="pt-4 pl-3 pr-3 pb-3 nav-item">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-search"></i>
                                                    </div>
                                                </div>
                                                <input placeholder="Search..." type="text" class="form-control"></div>
                                        </li>
                                        <li class="nav-item-header nav-item">Messaging</li>
                                    </ul>
                                </div>
                                <ul class="nav flex-column">
                                    <?php $disputeid = $_GET['disputeid']; $userClass->disputeinvolver($disputeid); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>
