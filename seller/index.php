<?php
include('../api/config/Database.php');
include('../api/models/session.php');
if(!isset($_SESSION['role']) || empty($_SESSION['role'])  || $_SESSION['role']!='Seller')
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
                                    <?php
                                        if($userAcctType != 'Starter'){ ?>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-danger">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading">Total Orders</div>
                                                                <div class="widget-subheading">Total users order</div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span><?php $userClass->totaluserOrder($userid); ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-success">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading">Total Product</div>
                                                                <div class="widget-subheading">Total product added</div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span> <?php $userClass->totaluserproduct($userid); ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-secondary">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-heading">Total Sales</div>
                                                                <div class="widget-subheading">Total sales made</div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span><?php $userClass->totaluserSales($userid); ?></span></div>
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
                                                                    <h2 class="heading--title">Your Products Catalogue</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class=" mb-3 ">
                                                                    <div class="">
                                                                        <div class="slick-slider-responsive" data-slick='{"slidesToShow": 4, "slidesToScroll": 1}'>
                                                                            <?php $userClass->user_catalogue_grid($userid); ?>
                                                                        </div>
                                                                    </div>
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
                                                                    <h2 class="heading--title">Your Recently Added Products</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <?php $userClass->user_product_grid($userid); ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="ml-4 mb-4">
                                                                <a href="view_all.php"><button class="btn btn-success btn-sm">View All Products </button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                                            <div class="main-card mb-3 card">
                                                <div class="card-body"><h5 class="card-title">You have to upgrade your account to enjoy most of our features</h5></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>
