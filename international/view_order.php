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
                                        <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                                            <div class="card">
                                                    <div class="container">
                                                        <div class="row m-5">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="heading heading-2 text-center mb-70">
                                                                    <h2 class="heading--title">Your Orders</h2>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                          <?php $userClass->get_orders($userid); ?>
                                                            <!-- <div class="col-md-6">
                                                                <div class="main-card">
                                                                    <div class="card-body">
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item">
                                                                                <div class="widget-content p-0">
                                                                                    <div class="widget-content-wrapper">
                                                                                        <div class="widget-content-left mr-3">
                                                                                            <img width="100" height="autp" class="rounded" src="productimg/330596/330596-2_1a342131-dbfd-4a82-bfc5-fa47bbc68416_500x500_crop_center.jpg" alt="">
                                                                                        </div>
                                                                                        <div class="widget-content-left flex2">
                                                                                            <div class="widget-heading">Order: 123456</div>
                                                                                            <div class="widget-subheading opacity-10">
                                                                                                <span><b class="text-success">N24,000</b></span><br>
                                                                                                <span class="pr-2"><b>2</b> Bags</span>,
                                                                                                <span class="pr-2"><b>4</b> Shoes</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="widget-content-right text-right mr-3">
                                                                                            <span class="badge badge-success">Delivered</span>
                                                                                            <div class="text"><b>09/04/2020</b></div>
                                                                                            <button onclick="orderdetails();" class="btn btn-dark btn-sm">View Details</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="main-card">
                                                                    <div class="card-body">
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item">
                                                                                <div class="widget-content p-0">
                                                                                    <div class="widget-content-wrapper">
                                                                                        <div class="widget-content-left mr-3">
                                                                                            <img width="100" height="autp" class="rounded" src="productimg/330596/330596-2_1a342131-dbfd-4a82-bfc5-fa47bbc68416_500x500_crop_center.jpg" alt="">
                                                                                        </div>
                                                                                        <div class="widget-content-left flex2">
                                                                                            <div class="widget-heading">Order: 123456</div>
                                                                                            <div class="widget-subheading opacity-10">
                                                                                                <span><b class="text-success">N24,000</b></span><br>
                                                                                                <span class="pr-2"><b>2</b> Bags</span>,
                                                                                                <span class="pr-2"><b>4</b> Shoes</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="widget-content-right text-right mr-3">
                                                                                            <span class="badge badge-danger">Outbound</span>
                                                                                            <div class="text"><b>09/04/2020</b></div>
                                                                                            <button onclick="orderdetails();" class="btn btn-dark btn-sm">View Details</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div> -->
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
