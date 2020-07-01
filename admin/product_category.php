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
                                        <div class="row">
                                          <div class="col-md-12 col-lg-4 col-xl-7">
                                          <?php if(isset($_GET['result'])){ echo '<div class="alert alert-danger">'.$_GET['result'].'</div>'; } ?>
                                                <form action="../api/controllers/category_add.php" method="post" enctype="multipart/form-data">
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body"><h5 class="card-title">Add New Category</h5>
                                                            <hr>
                                                            <div class="position-relative form-group">
                                                                <label for="exampleEmail" class="">Category Name</label>
                                                                <input name="catname" id="catname" type="text" class="form-control">
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="catdetail" class="">Category Description</label>
                                                                <textarea class="form-control" rows="3" id="catdescription" name="catdescription"></textarea>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="catimage" class="">Upload Icon</label>
                                                                <input name="catimage" id="catimage" type="file" class="form-control-file">
                                                                    <p class="form-text text-danger"><em>Icon image must be in png, jpg or gif, and must be 50 X 50 in dimension.</em></p>
                                                                </div>
                                                                <div id="result"></div>
                                                            <button class="mt-1 btn btn-danger btn-sm" type="submit">Create Category</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-12 col-lg-6 col-xl-5">
                                                <div class="main-card mb-3 card">
                                                    <div class="card-body">
                                                        <h6 class="text-muted text-uppercase font-size-md opacity-7 mb-3 font-weight-normal">
                                                            Category List</h6>
                                                            <span class="pull-right" id="intoto"></span>
                                                        <div class="border-light card-border card">
                                                            <ul class="list-group list-group-flush">
                                                                <?php $userClass->category_list(); ?>
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
<?Php include_once('inc/footer.php'); ?>
