<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?Php include_once('inc/header.php'); ?>
<div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content">
                                    <div class="container-fluid">
                                        <div class="row">
                                                <div class="mb-3 card">
                                                    <div class="card-body row">
                                                        <div class="col-md-3">
                                                            <h3 class="text-danger">Create a Product</h3>
                                                            <div class="divider"></div>
                                                            <span class="text-success">NB: Please fill out the form on the right careful.<br>Approval may take up to 48hrs after submission.</span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="card-body">
                                                                    <div class="card">
                                                                        <div class="b-radius-0 card-header">
                                                                            <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                                                <span class="form-heading">                                                                            <?php if(isset($_GET['result'])){ echo $_GET['result']; } ?></span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="../api/controllers/add_product.php" method="POST" enctype="multipart/form-data">
                                                                            <div class="card-body">
                                                                                <div class="position-relative form-group">
                                                                                    <label for="product_title">Product title</label>
                                                                                    <input id="product_title" name="product_title" type="text" class="form-control" required >
                                                                                </div>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <label for="market">Choose Market</label>
                                                                                        <select class="form-control" id="market" name="market"  required>
                                                                                            <option value="">Choose...</option>
                                                                                            <?php $userClass->market_dropdown_list(); ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="product_category">Product Category</label>
                                                                                        <select class="form-control" id="product_category" name="product_category"  required>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Product Availability</label>
                                                                                            <select class="form-control" id="productavailability" name="productavailability" required>
                                                                                                <option value="">Choose...</option>
                                                                                                <option value="In Stock">In Stock</option>
                                                                                                <option value="Out of Stock">Out of Stock</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="product_category">Country of Origin</label>
                                                                                        <select multiple="multiple" class="multiselect-dropdown form-control" name="countryorigin[]" id="countryorigin[]" required>
                                                                                            <option value="">Choose...</option>
                                                                                            <?php $userClass->fetchCountries(); ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="expiration" class="">Expiration Period <small><em>(in months)</em></small></label>
                                                                                            <input type="number" name="expiration" id="expiration" class="form-control" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Performances/Rating <i class="fa fa-star"></i></label>
                                                                                            <select name="performance" id="performance" class="form-control" required>
                                                                                                <option value="">Choose...</option>
                                                                                                <option value="Low">Low</option>
                                                                                                <option value="Medium">Medium</option>
                                                                                                <option value="High">High</option>
                                                                                                <option value="Very High">Very High</option>
                                                                                                <option value="Excellent">Excellent</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Sizes <small><em>(Type in the sizes, seperated with a comma)</em></small></label>
                                                                                            <input type="text" name="size" id="size" class="form-control multiselect-dropdown" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Colors <small><em>(Type in the colors, seperated with a comma)</em></small></label>
                                                                                            <input type="text" name="color" id="color" class="form-control multiselect-dropdown" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="form-row" id="container1">
                                                                                    <div class="col-md-12 pt-4">Add Product Price
                                                                                        <button class="btn btn-danger btn-sm" id="add" type="button"><i class="fa fa-plus"></i></button>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="product_pack0" class="">Product pack</label>
                                                                                            <select class="form-control" id="product_pack0" name="product_pack0" required>
                                                                                                <option value="">Choose...</option>
                                                                                                <option value="3">3</option>
                                                                                                <option value="5">5</option>
                                                                                                <option value="6">6</option>
                                                                                                <option value="9">9</option>
                                                                                                <option value="10">10</option>
                                                                                                <option value="12">12</option>
                                                                                                <option value="Pack">Pack</option>
                                                                                                <option value="Carton">Carton</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-5">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="product_price0" class="">Product Price</label>
                                                                                            <input id="product_price0" name="product_price0" type="number" class="form-control"  required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="product_discount0" class="">Discount(in %)</label>
                                                                                            <input id="product_discount0" name="product_discount0" type="number" class="form-control" value="0" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-md-1" style="padding-top: 34px;">
                                                                                        <button class="btn btn-danger btn-sm btn-shadow"><i class="fa fa-times"></i></button>
                                                                                    </div> --><!--
                                                                                    <div class="col-md-12" id="demo">
                                                                                    </div> -->
                                                                                </div>
                                                                                <div class="divider"></div>
                                                                                <div class="position-relative form-group">
                                                                                    <label for="product_description">Product Description</label>
                                                                                    <textarea class="form-control" id="editor" name="product_description" rows="5"></textarea>
                                                                                </div>
                                                                                <div class="divider"></div>
                                                                                <div class="position-relative form-group"  id="container2">
                                                                                    <div class="row">
                                                                                        <label for="exampleEmail4">Upload product images <button class="btn btn-danger btn-sm" id="addImgFile" type="button"><i class="fa fa-plus"></i></button>
                                                                                        <br><small class="text-danger"><em>(This field is enabled for multiple image selection)</em></small>
                                                                                        </label>
                                                                                        <input type="file" name="productimg0" id="productimg0" class="form-control col-md-11" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-right">
                                                                                    <input type="submit" name="submit" value="Add Product" class="btn-shadow btn-wide btn btn-danger btn-lg">
                                                                                </div>
                                                                            </div>
                                                                        </form>
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
