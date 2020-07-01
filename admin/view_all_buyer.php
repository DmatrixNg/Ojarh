<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?Php include_once('inc/header.php'); ?>
  <div class="app-inner-layout app-inner-layout-page">
    <div class="app-inner-layout__wrapper">
      <div class="app-inner-layout__content">
        <div class="tab-content">
          <div class="container-fluid">
            <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
              <div class="card">
                <div class="container">
                  <div class="value m-5">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="heading heading-2 text-center mb-70">
                        <h2 class="heading--title">List of Buyers</h2>
                      </div>
                      <div id="result"></div>
                    </div>
                  </div>
                  <div class="value">
                    <div class="col-md-12">
                      <div class="main-card mb-3 card">
                        <div class="card-body">
                          <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                              <th>Buyer ID</th>
                              <th>Username</th>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Date Registered</th>
                              <th>status</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                              <tbody>
                                  <?php $userClass->view_all('Buyer'); ?>
                              </tbody>
                          </table>
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
  </div>
<?php include_once('inc/footer.php'); ?>
