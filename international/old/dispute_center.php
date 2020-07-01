<?php include 'inc/header.php'; ?>
                    <div class="app-inner-layout">
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
                                <div class="app-inner-layout__top-pane">
                                    <div class="pane-left">
                                        <h5 class="mb-0">Showing all dispute</h5>
                                        <?php if(isset($_GET['result'])){ ?>
                                        <span class="b-radius-0 card-header float-right">
                                            <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <span class="form-heading"><?php echo $_GET['result']; ?></span>
                                            </button>
                                        </span>
                                        <?php } ?>
                                    </div>
                                    <div class="pane-right">
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
                                            <tbody>
                                                <?php $userClass->user_dispute_list($userid); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="app-inner-layout__sidebar card">
                                <ul class="nav flex-column">
                                    <li class="pt-3 pl-3 pr-3 pb-3 nav-item">
                                        <button class="btn-pill btn-shadow btn btn-primary btn-block" data-toggle="modal" data-target="#disputeform">Create Ticket</button>
                                    </li>
                                    <li class="nav-item-header nav-item">My Account</li>
                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i
                                            class="nav-link-icon pe-7s-chat"> </i><span>Pending Dispute</span>
                                        <div class="ml-auto badge badge-pill badge-warning"><?php $ss = 'Pending'; $userClass->dispute_count($userid, $ss); ?></div>
                                    </a></li>
                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i
                                            class="nav-link-icon pe-7s-wallet"> </i><span>In Progress</span>
                                        <div class="ml-auto badge badge-pill badge-info"><?php $ss = 'In Progress'; $userClass->dispute_count($userid, $ss); ?></div>
                                    </a></li>
                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i
                                            class="nav-link-icon pe-7s-wallet"> </i><span>Resolved Dispute</span>
                                        <div class="ml-auto badge badge-pill badge-success"><?php $ss = 'Resolved'; $userClass->dispute_count($userid, $ss); ?></div>
                                    </a></li>
                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i
                                            class="nav-link-icon pe-7s-config"> </i><span>Cancelled Dispute</span>
                                            <div class="ml-auto badge badge-pill badge-danger"><?php $ss = 'Cancelled'; $userClass->dispute_count($userid, $ss); ?></div>
                                    </a></li>
                                    <!-- <li class="nav-item-divider nav-item"></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>