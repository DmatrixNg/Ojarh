<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?php include 'inc/header.php'; ?>
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
                                                                    <h2 class="heading--title">Your Products</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                                <div class="card-shadow-primary card-border mb-3 card">
                                                                    <div class="dropdown-menu-header">
                                                                        <img src="images/dropdown-header/city1.jpg"
                                                                             width="100%"
                                                                             alt="Avatar 5">
                                                                    </div>
                                                                    <div class="p-3">
                                                                        <ul class="rm-list-borders list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                <div class="widget-content p-0">
                                                                                    <div class="widget-content-wrapper">
                                                                                        <div class="widget-content-left">
                                                                                            <div class="widget-heading">
                                                                                                Ella-Rose Henry
                                                                                            </div>
                                                                                            <div class="widget-subheading">
                                                                                                Web
                                                                                                Developer
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="widget-content-right">
                                                                                            <div class="font-size-xlg text-muted">
                                                                                                <span>N129</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="text-center d-block card-footer">
                                                                        <button class="btn btn-warning btn-sm">View Details
                                                                        </button>
                                                                        <button class="btn btn-danger btn-sm">Edit Product
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                                <div class="card-shadow-primary card-border mb-3 card">
                                                                    <div class="dropdown-menu-header">
                                                                        <img src="images/dropdown-header/city1.jpg"
                                                                             width="100%"
                                                                             alt="Avatar 5">
                                                                    </div>
                                                                    <div class="p-3">
                                                                        <ul class="rm-list-borders list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                <div class="widget-content p-0">
                                                                                    <div class="widget-content-wrapper">
                                                                                        <div class="widget-content-left">
                                                                                            <div class="widget-heading">
                                                                                                Ella-Rose Henry
                                                                                            </div>
                                                                                            <div class="widget-subheading">
                                                                                                Web
                                                                                                Developer
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="widget-content-right">
                                                                                            <div class="font-size-xlg text-muted">
                                                                                                <span>N129</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="text-center d-block card-footer">
                                                                        <button class="btn btn-warning btn-sm">View Details
                                                                        </button>
                                                                        <button class="btn btn-danger btn-sm">Edit Product
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                                <div class="card-shadow-primary card-border mb-3 card">
                                                                    <div class="dropdown-menu-header">
                                                                        <img src="images/dropdown-header/city1.jpg"
                                                                             width="100%"
                                                                             alt="Avatar 5">
                                                                    </div>
                                                                    <div class="p-3">
                                                                        <ul class="rm-list-borders list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                <div class="widget-content p-0">
                                                                                    <div class="widget-content-wrapper">
                                                                                        <div class="widget-content-left">
                                                                                            <div class="widget-heading">
                                                                                                Ella-Rose Henry
                                                                                            </div>
                                                                                            <div class="widget-subheading">
                                                                                                Web
                                                                                                Developer
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="widget-content-right">
                                                                                            <div class="font-size-xlg text-muted">
                                                                                                <span>N129</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="text-center d-block card-footer">
                                                                        <button class="btn btn-warning btn-sm">View Details
                                                                        </button>
                                                                        <button class="btn btn-danger btn-sm">Edit Product
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-6 col-xl-3">
                                                                <div class="card-shadow-primary card-border mb-3 card">
                                                                    <div class="dropdown-menu-header">
                                                                        <img src="images/dropdown-header/city1.jpg"
                                                                             width="100%"
                                                                             alt="Avatar 5">
                                                                    </div>
                                                                    <div class="p-3">
                                                                        <ul class="rm-list-borders list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                <div class="widget-content p-0">
                                                                                    <div class="widget-content-wrapper">
                                                                                        <div class="widget-content-left">
                                                                                            <div class="widget-heading">
                                                                                                Ella-Rose Henry
                                                                                            </div>
                                                                                            <div class="widget-subheading">
                                                                                                Web
                                                                                                Developer
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="widget-content-right">
                                                                                            <div class="font-size-xlg text-muted">
                                                                                                <span>N129</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="text-center d-block card-footer">
                                                                        <button class="btn btn-warning btn-sm">View Details
                                                                        </button>
                                                                        <button class="btn btn-danger btn-sm">Edit Product
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
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>