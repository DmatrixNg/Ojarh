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
                                <div class="table-responsive" style="height: 100%; overflow-y: scroll; margin-bottom: 100px;">
                                    <div class="app-inner-layout__top-pane">
                                        <div class="pane-right">
                                            <div class="btn-group">
                                                <a href="all_dispute.php"><button type="button" class="ml-2 btn btn-primary">
			                                        <span class="opacity-7 mr-1">
			                                            <i class="fa fa-arrow-left"></i>
			                                        </span> Back
                                                </button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-wrapper">
                                        <?php $disputeid = $_GET['disputeid']; $userClass->disputeMessages($disputeid); ?>
                                    </div>
                                    <div class="app-inner-layout__bottom-pane d-block text-center" style="width: 100%; position: absolute; bottom: 0; left: 0;">
                                        <div class="mb-0 position-relative row form-group">
                                            <div class="col-sm-12">
                                                <input placeholder="Write here and hit enter to send..." type="text"
                                                       class="form-control-lg form-control">
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