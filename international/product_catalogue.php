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
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content">
                            <div class="tab-content">
                                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                    <div class="container-fluid">
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
                                        <div class="row">
                                          <div class="col-md-12 col-lg-4 col-xl-7">
                                                  <div class="main-card mb-3 card">
                                                      <div class="card-body"><h5 class="card-title">Create New Catalogue</h5>
                                                        <hr>
                                                        <div class="position-relative form-group">
                                                          <label for="exampleEmail" class="">Catalogue Name</label>
                                                          <input type="text" name="catname" id="catname" class="form-control">

                                                        </div>
                                                          <div class="position-relative form-group">
                                                              <label for="catdetail" class="">Catalogue Description</label>
                                                              <textarea class="form-control" rows="3" id="catdescription" name="catdescription"></textarea>
                                                          </div>
                                                          <div id="result"></div>
                                                          <button class="mt-1 btn btn-danger btn-sm" id="catBtn">Create Catalogue</button>
                                                      </div>
                                                  </div>
                                              </div>
                                            <div class="col-md-12 col-lg-6 col-xl-5">
                                                <div class="main-card mb-3 card">
                                                    <div class="card-body">
                                                        <h6 class="text-muted text-uppercase font-size-md opacity-7 mb-3 font-weight-normal">
                                                            Your Catalogue List</h6>
                                                        <div class="border-light card-border card">
                                                            <ul class="list-group list-group-flush">
                                                                <?php $userClass->user_category_list($userid); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php include 'inc/footer.php'; ?>
