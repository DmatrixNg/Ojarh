<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?php include 'inc/header.php'; ?>
<?php $product = $userClass->get_product_details($_GET['productid']);
      $user = $userClass->userDetails($product->userid);

      if ($user->role == "Seller"){$locator = SELLER_URL;}if ($user->role == "International"){$locator = INTERNATIONAL_URL;}

      ?>
<div class="app-inner-layout app-inner-layout-page">
    <div class="app-inner-layout__wrapper">
        <div class="app-inner-layout__content">
            <div class="tab-content">
                <div class="container-fluid">

                                        <div class="row">
                                                <div class="mb-3 card">

                                                    <div class="card-body row">
                                                        <div class="col-md-5">
                                                            <h3 class="text-danger">Product</h3>
                                                            <div class="divider"></div>
                                                            <div class="position-relative form-group row">
                                                            <?php
                                                            // var_dump($item[0]);
                                                            for ($i=0; $i < 7; $i++) {
                                                              $img = "img".$i;
                                                              if (!is_null($product->$img) && !empty($product->$img)) {

                                                              ?>
                                                                <div class="col-md-6">
                                                                    <img src="<?php echo $locator."/productimg/".$product->productid.'/'.$product->$img ?>" class="img-fluid" alt="Responsive image">

                                                                </div>


                                                            <?php
                                                          }else {
                                                            continue;
                                                          }
                                                        }
                                                        ?>
                                                      </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="card-body">
                                                                    <div class="card">
                                                                        <?php if(isset($_GET['result'])){ ?>
                                                                            <div class="b-radius-0 card-header">
                                                                                <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                                                    <span class="form-heading"><?php echo $_GET['result']; ?></span>
                                                                                </button>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <?php //var_dump($userClass->get_product_details($_GET['productid'])) ?>

                                                                        <!-- <form action="../api/controllers/add_product.php" method="POST" enctype="multipart/form-data"> -->
                                                                            <div class="card-body">
                                                                                <div class="position-relative form-group">
                                                                                    <label for="product_title">Product title</label>

                                                                                    <input id="product_title" name="product_title" type="text" placeholder="<?php echo $product->product_title; ?>" class="form-control" disabled >
                                                                                </div>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <label for="market">Choose Market</label>
                                                                                        <select class="form-control" id="market" name="market"  disabled>
                                                                                            <option value=""><?php echo $product->market; ?></option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="product_catalogue">Product Category</label>
                                                                                        <select class="form-control" id="product_catalogue" name="product_catalogue"  disabled>
                                                                                          <option value=""><?php echo $product->product_category; ?></option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div><br>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Product Availability</label>
                                                                                            <select class="form-control" id="productavailability" name="productavailability" disabled>
                                                                                                <option value=""><?php echo $product->productavailability; ?></option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="product_catalogue">Country of Origin</label>
                                                                                        <select class="form-control" name="countryorigin[]" id="countryorigin[]" disabled>
                                                                                            <option value=""><?php echo $product->countryorigin; ?></option>
                                                                                          </select>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="expiration" class="">Expiration Period <small><em>(in months)</em></small></label>
                                                                                            <input type="number" name="expiration" id="expiration" placeholder="<?php echo $product->expiration; ?>" class="form-control" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Performances/Rating <i class="fa fa-star"></i></label>
                                                                                            <select name="performance" id="performance" class="form-control" disabled>
                                                                                                <option value=""><?php echo $product->performance; ?></option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Sizes <small><em>(Type in the sizes, seperated with a comma)</em></small></label>
                                                                                            <input type="text" name="size" id="size" placeholder="<?php echo $product->size; ?>"class="form-control multiselect-dropdown" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="productavailability" class="">Colors <small><em>(Type in the colors, seperated with a comma)</em></small></label>
                                                                                            <input type="text" name="color" id="color" placeholder="<?php echo $product->color; ?>" class="form-control multiselect-dropdown" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="form-row pt-4" id="container1">
                                                                                  <div class="col-md-12">Product Price
                                                                                  </div>
                                                                                    <?php
                                                                                    for ($i=0; $i < 8; $i++) {
                                                                                      $park = "pack".$i;
                                                                                      if (!is_null($product->$park) && !empty($product->$park)) {
                                                                                        if ( strpos($product->$park, '+') ) {
                                                                                          $item = explode('+',$product->$park);

                                                                                        }elseif (strpos($product->$park, '@') ) {

                                                                                          $item = explode('@',$product->$park);
                                                                                        }else {
                                                                                          $item ="";
                                                                                        }
                                                                                      ?>
                                                                                      <div class="col-md-3">
                                                                                          <div class="position-relative form-group">
                                                                                              <label for="product_pack0" class="">Product pack</label>
                                                                                              <select class="form-control" id="product_pack0" name="product_pack0" disabled>
                                                                                                  <option value="<?php echo $item[0]; ?>"><?php echo @$item[0]; ?></option>
                                                                                              </select>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col-md-5">
                                                                                          <div class="position-relative form-group">
                                                                                              <label for="product_price0" class="">Product Price (in #)</label>
                                                                                              <input id="product_price0" name="product_price0"  placeholder="<?php echo @$item[1]; ?>" type="number" class="form-control"  disabled>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col-md-4">
                                                                                          <div class="position-relative form-group">
                                                                                              <label for="product_discount0" class="">Discount(in %)</label>
                                                                                              <input id="product_discount0" name="product_discount0" placeholder="<?php echo @$item[2]; ?>" type="number" class="form-control" value="0" disabled>
                                                                                          </div>
                                                                                      </div>

                                                                                        <?php
                                                                                      }else {
                                                                                        break;
                                                                                      }
                                                                                    }
                                                                                    ?>

                                                                                </div>
                                                                                <div class="divider"></div>
                                                                                <div class="position-relative form-group">
                                                                                    <label for="product_description">Product Description</label>
                                                                                    <textarea class="form-control" id="editor" name="product_description" rows="5" disabled><?php echo $product->product_description; ?></textarea>
                                                                                </div>
                                                                                <div class="text-right">
                                                                                <a href="edit_product.php?productid=<?php echo $product->productid; ?>">  <button class="btn-shadow btn-wide btn btn-danger btn-lg"> Edit Product Details</button></a>
                                                                                </div>
                                                                            </div>
                                                                        <!-- </form> -->
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
<!--
market
product_catalogue
-->
