<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
$pageName = "Profile Setting";
?>
<?php include 'inc/header.php'; ?>
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content pt-1">
                            <div class="tab-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-primary">
                                                        <div class="menu-header-content">
                                                            <div class="avatar-icon-wrapper btn-hover-shine mb-2 avatar-icon-xl">
                                                                <div class="avatar-icon rounded">
                                                                    <img src="images/avatars/1.jpg" width="104" alt="Avatar 6"></div>
                                                            </div>
                                                            <div><h5 class="menu-header-title"><?php echo ucfirst($userDetails->username); ?></h5></div>
                                                            <div class="menu-header-btn-pane pt-2">
                                                                <div role="group" class="btn-group text-center">
                                                                    <div class="nav">
                                                                        <a href="#tab-2-eg1" data-toggle="tab"
                                                                           class="active btn btn-dark">Update profile picture</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-user fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?php echo ucfirst($userDetails->lname) . ' ' . ucfirst($userDetails->fname); ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-envelope fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left" style="margin-left: -15px !important;">
                                                                    <div class="widget-heading"><?php echo $userDetails->email; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-mobile fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?php echo $userDetails->phone; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-5">
                                                                    <i class="fa fa-map-pin fa-2x"></i>
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?php echo $userDetails->address; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-8">
                                            <div class="main-card mb-3 card">
                                                <div id="pfBody" class="card-body">
                                                    <div class="forms-wizard-vertical">
                                                        <div class="card-body">
                                                            <h3>Profile Information</h3>
                                                            <div class="divider"></div>
                                                            <div class="form-group">
                                                                <label for="exampleEmail5">Username</label>
                                                                <input type="text" id="username" name="username"
                                                                       value="<?php echo $userDetails->username; ?>"
                                                                       class="form-control" disabled>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">First Name</label>
                                                                    <input type="text" id="fname" name="fname"
                                                                       value="<?php echo $userDetails->fname; ?>"
                                                                       class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Last Name</label>
                                                                    <input type="text" id="lname" name="lname"
                                                                       value="<?php echo $userDetails->lname; ?>"
                                                                       class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Email</label>
                                                                    <input type="text" id="email" name="email"
                                                                       value="<?php echo $userDetails->email; ?>"
                                                                       class="form-control" disabled>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Phone</label>
                                                                    <input type="text" id="phone" name="phone"
                                                                       value="<?php echo $userDetails->phone; ?>"
                                                                       class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleEmail5">Address</label>
                                                                <input type="text" id="address" name="address"
                                                                       value="<?php echo $userDetails->address; ?>"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <!--<div id="step-322">
                                                            <div class="">
                                                                <div
                                                                    class="swal2-icon swal2-success swal2-animate-success-icon">
                                                                    <div class="swal2-success-circular-line-left"
                                                                         style="background-color: rgb(255, 255, 255);"></div>
                                                                    <span class="swal2-success-line-tip"></span>
                                                                    <span class="swal2-success-line-long"></span>
                                                                    <div class="swal2-success-ring"></div>
                                                                    <div class="swal2-success-fix"
                                                                         style="background-color: rgb(255, 255, 255);"></div>
                                                                    <div class="swal2-success-circular-line-right"
                                                                         style="background-color: rgb(255, 255, 255);"></div>
                                                                </div>
                                                                <div class="results-subtitle mt-4">Finished!</div>
                                                                <div class="results-title">You arrived at the last
                                                                    form
                                                                    wizard step!
                                                                </div>
                                                                <div class="mt-3 mb-3"></div>
                                                                <div class="text-center">
                                                                    <button
                                                                        class="btn-shadow btn-wide btn btn-success btn-lg">
                                                                        Finish
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="clearfix">
                                                        <button type="button" id="next-btn22"
                                                                class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                            Update
                                                        </button>
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