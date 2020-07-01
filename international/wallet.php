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
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-danger">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading">Total Income</div>
                                                                <div class="widget-subheading"></div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span><?php $userClass->totaluserWalletIncome($userid); ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-success">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading">Total Payout</div>
                                                                <div class="widget-subheading"></div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span> <?php $userClass->totaluserPayout($userid); ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-secondary">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading">Net balance</div>
                                                                <div class="widget-subheading"></div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span><?php $userClass->totaluserSales($userid); ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-secondary">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading"><button onclick="requestP()" class="btn btn-primary-sm">Request Payout</button></div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                                            <div class="card">
                                                    <div class="container">
                                                        <div class="row m-5">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="heading heading-2 text-center mb-70">
                                                                    <h2 class="heading--title">Transaction History</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="main-card mb-3 card">
                                                                  <?php if(isset($_GET['result'])): ?>
                                                                    <div class="alert alert-success"><?= $_GET['result'] ?></div>
                                                                  <?php endif; ?>
                                                                    <div class="card-body table-responsive">
                                                                        <table style="width: 100%; " id="example" class="table table-hover table-striped table-bordered">
                                                                            <thead>
                                                                              <tr role="row">
                                                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 48.2px;" aria-sort="ascending" aria-label="Producid:">Product ID</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Buyer's Name:">Buyer's Name</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Billing Address:">Billing Address</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Seller ID:">Seller ID</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Qty:">Qty</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Product Pricing:">Product Pricing</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Totaln:">Total</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Location:">Location</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Payment Method:">Payment Method</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Paid Date:">Paid Date</th>
                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Payment Status:">Payment Status</th>
                                                                              </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php $userClass->view_seller_wallet($userid); ?>
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

<?php include 'inc/footer.php'; ?>
