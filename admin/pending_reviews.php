<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?Php include_once('inc/header.php'); ?>
<style media="screen">
  .app-main {
    z-index: auto;
  }
  .app-main .app-main__outer{
    z-index: auto;
  }
</style>
                    <div class="app-inner-layout app-inner-layout-page">
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__content">
                                <div class="tab-content">
                                  <div class="container-fluid">
                                      <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                                          <div class="card">
                                                  <div class="container">
                                                      <div class="row m-5">
                                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                                              <div class="heading heading-2 text-center mb-70">
                                                                  <h2 class="heading--title">List of all Product Reviews</h2>
                                                              </div>
                                                              <div id="result"></div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="main-card mb-3 card">
                                                                  <div class="card-body">
                                                                      <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                                                          <thead>
                                                                          <tr>
                                                                              <th>Product ID</th>
                                                                              <th>Product Title</th>
                                                                              <th>Seller Username</th>
                                                                              <th>No. of Stock </th>
                                                                              <th>Status</th>
                                                                              <th>Date Added</th>
                                                                              <th>Action</th>
                                                                          </tr>
                                                                          </thead>
                                                                          <tbody>
                                                                              <?php $userClass->view_pending_reviews(); ?>
                                                                          </tbody>
                                                                          <!-- <tfoot>
                                                                              <tr>
                                                                                  <th>Product ID</th>
                                                                                  <th>Product title</th>
                                                                                  <th>Product Category</th>
                                                                                  <th>Product Availability</th>
                                                                                  <th>Status</th>
                                                                                  <th>Created On</th>
                                                                              </tr>
                                                                          </tfoot> -->
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
<?Php include_once('inc/footer.php'); ?>
