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
                                                            <div class="col-md-12">
                                                                <div class="main-card mb-3 card">
                                                                    <div class="card-body">
                                                                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                                                                        <thead>
                                                                                            <tr role="row">
                                                                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 48.2px;" aria-sort="ascending" aria-label="ID: activate to sort column descending">ID</th>
                                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Product Title: activate to sort column ascending">Product Title</th>
                                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 42.2px;" aria-label="Price: activate to sort column ascending">Price</th>
                                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 26.2px;" aria-label="Status: activate to sort column ascending">Availability</th>
                                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 26.2px;" aria-label="Status: activate to sort column ascending">Status</th>
                                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 56.2px;" aria-label="Created On: activate to sort column ascending">Created On</th>
                                                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 49.2px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php $userClass->user_product_list($userid); ?>
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
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>