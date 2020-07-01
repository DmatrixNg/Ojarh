<?php include 'inc/header.php'; ?>
                    <div class="app-inner-layout app-inner-layout-page">
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__content">
                                <div class="tab-content">
                                    <div class="container-fluid">
                                    <?php
                                        if($acctType->account_type == 'Buyer'){
                                            echo '<div class="card-body row">
                                                 <div class="alert alert-danger show col-md-12" role="alert">
                                                    You can do more when you upgrade your account when you become a seller!
                                                    <a href="#"><button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModal">Become a seller</button></a>
                                                 </div>
                                             </div>';
                                        }
                                     ?>
                                        <!-- <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3 widget-content bg-danger">
                                                        <div class="widget-content-wrapper text-white">
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading">Total Orders</div>
                                                                <div class="widget-subheading">Total users order</div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span>0</span></div>
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
                                                            <div class="widget-content-left mr-5">
                                                                <div class="widget-heading">Total Purchase</div>
                                                                <div class="widget-subheading">Total purchase made</div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="widget-numbers text-white"><span>#0</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                                            <div class="card">
                                                    <div class="container">
                                                        <div class="row m-5">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="heading heading-2 text-center mb-70">
                                                                    <h2 class="heading--title">Your Favourite Product</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <?php $userClass->fetch_auth_user_fav($userid); ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="ml-4 mb-4">
                                                                <a href="favourites.php"><button class="btn btn-success btn-sm">View all favourites </button></a>
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