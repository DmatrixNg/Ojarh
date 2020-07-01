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
                                     
                                        <div class="row">
                                          <div class="col-md-12 col-lg-4 col-xl-7">
                                                  <div class="main-card mb-3 card">
                                                      <div class="card-body"><h5 class="card-title">Create New Category</h5>
                                                        <hr>
                                                          <div class="position-relative form-group">
                                                            <label for="exampleEmail" class="">Category Name</label>
                                                            <select name="catname" id="catname" class="form-control">
                                                                <?php $userClass->category_dropdown(); ?>
                                                            </select>
                                                          </div>
                                                          <div class="position-relative form-group">
                                                              <label for="catdetail" class="">Category Description</label>
                                                              <textarea class="form-control" rows="3" id="catdescription" name="catdescription"></textarea>
                                                          </div>
                                                          <div id="result"></div>
                                                          <button class="mt-1 btn btn-danger btn-sm" id="catBtn">Create Category</button>
                                                      </div>
                                                  </div>
                                              </div>
                                            <div class="col-md-12 col-lg-6 col-xl-5">
                                                <div class="main-card mb-3 card">
                                                    <div class="card-body">
                                                        <h6 class="text-muted text-uppercase font-size-md opacity-7 mb-3 font-weight-normal">
                                                            Your Category List</h6>
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
