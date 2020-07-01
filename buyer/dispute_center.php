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
  
  <div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content card">
      <div class="row">

        <div class="col-md-12">
          <div class="">
            <div class="card-body">
              <div id="view">


                <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Dispute ID</th>
                      <th>Complainant</th>
                      <th>Against</th>
                      <th>Subject</th>
                      <th>Priority</th>
                      <th>Date Added</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $userClass->user_dispute_list($_SESSION['userid']) ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="app-inner-layout__sidebar card">
        <ul class="nav flex-column">
          <li class="pt-3 pl-3 pr-3 pb-3 nav-item">
            <button class="btn-pill btn-shadow btn btn-primary btn-block" data-toggle="modal" data-target="#disputeform">Create Ticket</button>
          </li>
          <li class="nav-item-header nav-item">My Account</li>
          <li class="nav-item"><a href="javascript:getDispute('Pending');" class="nav-link"><i
            class="nav-link-icon pe-7s-chat"> </i><span>Pending Dispute</span>
            <div class="ml-auto badge badge-pill badge-warning"><?php $ss = 'Pending'; $userClass->dispute_count($userid, $ss); ?></div>
          </a></li>
          <li class="nav-item"><a href="javascript:getDispute('In Progress');" class="nav-link"><i
            class="nav-link-icon pe-7s-wallet"> </i><span>In Progress</span>
            <div class="ml-auto badge badge-pill badge-info"><?php $ss = 'In Progress'; $userClass->dispute_count($userid, $ss); ?></div>
          </a></li>
          <li class="nav-item"><a href="javascript:getDispute('Resolved');" class="nav-link"><i
            class="nav-link-icon pe-7s-wallet"> </i><span>Resolved Dispute</span>
            <div class="ml-auto badge badge-pill badge-success"><?php $ss = 'Resolved'; $userClass->dispute_count($userid, $ss); ?></div>
          </a></li>
          <li class="nav-item"><a href="javascript:getDispute('Cancelled');" class="nav-link"><i
            class="nav-link-icon pe-7s-config"> </i><span>Cancelled Dispute</span>
            <div class="ml-auto badge badge-pill badge-danger"><?php $ss = 'Cancelled'; $userClass->dispute_count($userid, $ss); ?></div>
          </a></li>
          <!-- <li class="nav-item-divider nav-item"></li> -->
        </ul>
      </div>
    </div>
  </div>
  <?php include 'inc/footer.php'; ?>
