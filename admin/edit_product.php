<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
$pageName = "Edit Product";
?>
<?php include 'inc/header.php'; ?>
<?php $product = $userClass->get_product_details($_GET['productid']);
      $user = $userClass->userDetails($product->userid);

      if ($user->role == "Seller"){$locator = SELLER_URL;}if ($user->role == "International"){$locator = INTERNATIONAL_URL;}

      ?>
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content">
                                    <div class="container-fluid">

                                        <div class="row">
                                                <div class="mb-3 card">

                                                    <div class="card-body row">
                                                        <div class="col-md-5">

                                                          <div class="divider"></div>
                                                          <div class="position-relative form-group row">
                                                          <?php
                                                          // var_dump($item[0]);
                                                          for ($i=0; $i < 7; $i++) {
                                                            $img = "img".$i;
                                                            if (!is_null($product->$img) && !empty($product->$img)) {

                                                            ?>
                                                              <div id="image-<?php echo $product->productid; ?>" class="col-md-6 text-center">
                                                                  <img src="<?php echo $locator."/productimg/".$product->productid.'/'.$product->$img ?>" class="img-fluid" alt="Responsive image">
                                                                  <button class="btn btn-danger btn-sm"  onclick='remove_image("<?php echo $product->$img; ?>","<?php echo $product->productid; ?>")' >Remove</button>

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
                                                                        <form action="<?= BASE_URL ?>api/controllers/edit_product.php" method="POST" enctype="multipart/form-data">
                                                                          <input type="hidden" name="productid" value="<?php echo $product->productid; ?>">
                                                                          <div class="card-body">
                                                                              <div class="position-relative form-group">
                                                                                  <label for="product_title">Product title</label>

                                                                                  <input id="product_title" name="product_title" type="text" value="<?php echo $product->product_title; ?>" placeholder="<?php echo $product->product_title; ?>" class="form-control"  >
                                                                              </div>
                                                                              <div class="form-row">
                                                                                  <div class="col-md-6">
                                                                                      <label for="market">Choose Market</label>
                                                                                      <select class="form-control" id="market" name="market"  >
                                                                                          <option value="">Choose</option>
                                                                                          <?php $userClass->market_dropdown_list($product->market); ?>

                                                                                      </select>
                                                                                  </div>
                                                                                  <div class="col-md-6">
                                                                                      <label for="product_catalogue">Product Category</label>
                                                                                      <select class="form-control" id="product_category" name="product_category"  >
                                                                                        <option value="<?php echo $product->product_category; ?>" selected><?php echo $product->product_category; ?></option>
                                                                                      </select>
                                                                                  </div>
                                                                              </div><br>
                                                                              <div class="form-row">
                                                                                  <div class="col-md-6">
                                                                                      <label for="market">Choose Seller</label>
                                                                                      <select class="form-control" id="seller" name="seller"  required>
                                                                                          <option value="">Choose..</option>
                                                                                          <?php $userClass->seller_dropdown_list($product->userid); ?>
                                                                                      </select>
                                                                                  </div>
                                                                                  <div class="col-md-6">
                                                                                      <label for="product_category">Seller's Catalogue</label>
                                                                                      <select class="form-control" id="seller_catalogue" name="seller_catalogue">
                                                                                        <option value="<?php echo $product->product_catalogue; ?>" selected><?php echo $product->product_catalogue; ?> - Original seller (id)</option>
                                                                                      </select>
                                                                                  </div>
                                                                              </div><br>
                                                                              <div class="form-row">
                                                                                  <div class="col-md-6">
                                                                                      <div class="position-relative form-group">
                                                                                          <label for="productavailability" class="">Product Availability</label>
                                                                                          <select class="form-control" id="productavailability" name="productavailability" >
                                                                                              <option value="<?php echo $product->productavailability; ?>" selected><?php echo $product->productavailability; ?> - Original selection</option>
                                                                                              <option value="In Stock">In Stock</option>
                                                                                              <option value="Out of Stock">Out of Stock</option>
                                                                                          </select>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-6">
                                                                                      <label for="product_catalogue">Country of Origin</label>
                                                                                      <select multiple="multiple" class="multiselect-dropdown form-control" name="countryorigin[]" id="countryorigin[]" required>
                                                                                        <option value="<?php echo $product->countryorigin; ?>" selected><?php echo $product->countryorigin; ?></option>

                                                                                          <?php $userClass->fetchCountries(); ?>
                                                                                      </select>
                                                                                  </div>
                                                                              </div>
                                                                              <hr>
                                                                              <div class="form-row">
                                                                                  <div class="col-md-6">
                                                                                      <div class="position-relative form-group">
                                                                                          <label for="expiration" class="">Expiration Period <small><em>(in months)</em></small></label>
                                                                                          <input type="number" name="expiration" id="expiration" value="<?php echo $product->expiration; ?>" placeholder="<?php echo $product->expiration; ?>" class="form-control" >
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-6">
                                                                                      <div class="position-relative form-group">
                                                                                          <label for="productavailability" class="">Performances/Rating <i class="fa fa-star"></i></label>
                                                                                          <select name="performance" id="performance" class="form-control" >
                                                                                              <option value="<?php echo $product->performance; ?>" selected><?php echo $product->performance; ?> - Original selection</option>
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
                                                                                          <input type="text" name="size" id="size" value="<?php echo $product->size; ?>" placeholder="<?php echo $product->size; ?>"class="form-control multiselect-dropdown" >
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-6">
                                                                                      <div class="position-relative form-group">
                                                                                          <label for="productavailability" class="">Colors <small><em>(Type in the colors, seperated with a comma)</em></small></label>
                                                                                          <input type="text" name="color" value="<?php echo $product->color; ?>" id="color" placeholder="<?php echo $product->color; ?>" class="form-control multiselect-dropdown" >
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                              <hr>
                                                                              <div class="form-row pt-4" id="container1">
                                                                                <div class="col-md-12 pt-4">Add Product Price
                                                                                    <button class="btn btn-danger btn-sm" id="addNewField" type="button"><i class="fa fa-plus"></i></button>
                                                                                </div>
                                                                                  <?php
                                                                                  for ($i=0; $i < 8; $i++) {
                                                                                    $park = "pack".$i;
                                                                                    $price = "price".$i;
                                                                                    $discount = "discount".$i;
                                                                                    if (!is_null($product->$park) && !empty($product->$park)) {
                                                                                      if ( strpos($product->$park, '+') ) {
                                                                                        $item = explode('+',$product->$park);

                                                                                      }elseif (strpos($product->$park, '@') ) {

                                                                                        $item = explode('@',$product->$park);
                                                                                      }else {
                                                                                        $item ="";
                                                                                      }
                                                                                    ?>
                                                                                    <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="product_<?= $park ?>" class="">Product pack</label>
                                                                                            <select class="form-control" id="product_<?= $park ?>" name="product_<?= $park ?>" >
                                                                                                <option value="<?php echo $item[0]; ?>" selected><?php echo @$item[0]; ?></option>
                                                                                                <option value="1">1</option>
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
                                                                                    <div class="col-md-4">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="product_<?= $price ?>" class="">Product Price (in #)</label>
                                                                                            <input id="product_<?= $price ?>" name="product_<?= $price ?>" value="<?php echo @$item[1]; ?>" placeholder="<?php echo @$item[1]; ?>" type="number" class="form-control"  >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="position-relative form-group">
                                                                                            <label for="product_<?= $discount ?>" class="">Discount(in %)</label>
                                                                                            <input id="product_<?= $discount ?>" name="product_<?= $discount ?>" value="<?php echo @$item[2]; ?>" placeholder="<?php echo @$item[2]; ?>" type="number" class="form-control" value="0" >
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php if ($i > 0): ?>

                                                                                      <button class="btn btn-danger btn-sm btn-shadow delete mt-4 mb-5"><i class="fa fa-times"></i></button>
                                                                                    <?php endif; ?>
                                                                                    </div>

                                                                                      <?php
                                                                                    }else {
                                                                                      break;
                                                                                    }
                                                                                  }

                                                                                  ?>
                                                                                  <div id="last" last="<?= $i ?>"></div>

                                                                              </div>
                                                                              <div class="divider"></div>
                                                                              <div class="position-relative form-group">
                                                                                  <label for="product_description">Product Description</label>
                                                                                  <textarea class="form-control" id="editor" value="<?php echo $product->product_description; ?>" name="product_description" rows="5" ><?php echo $product->product_description; ?></textarea>
                                                                              </div>
                                                                              <div class="divider"></div>
                                                                              <div class="position-relative form-group"  id="container4">
                                                                                <?php
                                                                                // var_dump($item[0]);
                                                                                $j = 0;
                                                                                $k = 0;
                                                                                for ($i=0; $i < 7; $i++) {
                                                                                  $img = "img".$i;
                                                                                  if (empty($product->$img)) {
                                                                                    $j++

                                                                                  ?>
                                                                                    <?php if ($j <= 1) {
                                                                                      $k++?>
                                                                                      <div class="row">

                                                                                        <label for="exampleEmail4">More images
                                                                                    <?php if ($j == 1): ?>
                                                                                      <button class="btn btn-danger btn-sm" id="addImgFile4" type="button"><i class="fa fa-plus"></i></button>
                                                                                    <?php endif; ?>
                                                                                  </label>
                                                                                  <input type="file" name="product<?= $img ?>" id="product<?= $img ?>" class="form-control col-md-11">

                                                                                  </div>
                                                                                <?php



                                                                                }else {?>

                                                                                <?php  continue;
                                                                                }
                                                                              }else {

                                                                              }

                                                                            }
                                                                            ?>
                                                                            <div id="lastimg" last="<?= $k ?>"></div>

                                                                              </div>
                                                                              <div class="text-right">
                                                                               <button type="submit" class="btn-shadow btn-wide btn btn-danger btn-lg"> Update Details</button>
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
<?php include 'inc/footer.php'; ?>
<!--
market
product_category
-->

<script type="text/javascript">
    $(document).ready(function() {
        $("#market").change(function(){
            var selectedloc = $("#market option:selected").val();
            $("#product_category").html("<option value=''>Select Product Category</option>");
            $.ajax({
                type: 'POST',
                url: '../api/controllers/process-loc.php',
                data: {
                    loc : selectedloc
                },
                cache: false,
                dataType: 'text',
                success: function (response) {
                    var obj = JSON.parse(response);
                    var areaOption = "<option value=''>Select Product Category</option>";
                    for (var i = 0; i < obj.length; i++) {
                        areaOption += '<option value="' + obj[i] + '">' + obj[i] + '</option>'
                    }
                    $("#product_category").html(areaOption);
                }
            });
            event.preventDefault();
        });
    });
    $(document).ready(function() {
        $("#seller").change(function(){
            var selectedloc = $("#seller option:selected").val();
            $("#seller_catalogue").html("<option value=''>Select Seller Catalogue</option>");
            $.ajax({
                type: 'POST',
                url: '../api/controllers/process-seller.php',
                data: {
                    loc : selectedloc
                },
                cache: false,
                dataType: 'text',
                success: function (response) {
                    var obj = JSON.parse(response);
                    var areaOption = "<option value=''>Select Seller Catalogue</option>";
                    for (var i = 0; i < obj.length; i++) {
                        areaOption += '<option value="' + obj[i] + '">' + obj[i] + '</option>'
                    }
                    $("#seller_catalogue").html(areaOption);
                }
            });
            event.preventDefault();
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){

       // console.log();
        var last = $('#last').attr('last');
        var num = last;
        var max_fields = 9;
        var wrapper = $("#container1");
        var x = last;
        $('#addNewField').click(function(e) {
            // e.preventDefault();
            if (x < max_fields) {
                var num = x++;
                $(wrapper).append('<div class="row"><div class="col-md-3"><div class="position-relative form-group"><label for="product_pack'+num+'" class="">Product pack</label><select class="form-control" id="product_pack'+num+'" name="product_pack'+num+'" required><option value="">Choose...</option><option value="1">1</option><option value="3">3</option><option value="5">5</option><option value="6">6</option><option value="9">9</option><option value="10">10</option><option value="12">12</option><option value="Pack">Pack</option><option value="Carton">Carton</option></select></div></div><div class="col-md-4"><div class="position-relative form-group"><label for="product_price'+num+'" class="">Product Price</label><input id="product_price'+num+'" name="product_price'+num+'" type="number" class="form-control"  required></div></div><div class="col-md-3"><div class="position-relative form-group"><label for="product_discount'+num+'" class="">Discount(in %)</label><input id="product_discount'+num+'" name="product_discount'+num+'" type="number" class="form-control" value="0" required></div></div><button class="btn btn-danger btn-sm btn-shadow delete mt-4 mb-5"><i class="fa fa-times"></i></button></div>'); //add input box
            } else {
                alert('You Reached the limits');
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });

        var last = $('#lastimg').attr('last');
        var nums = last;
        var max_fieldss = 7;
        var wrappers = $("#container4");
        var add_buttons = $("#addImgFile4");

        var xx = last;
        $(add_buttons).click(function(e) {
            e.preventDefault();
            if (xx < max_fieldss) {
                var nums = ++xx;
                $(wrappers).append('<div class="row"><label for="exampleEmail4">More product images</label><input type="file" name="productimg'+nums+'" id="productimg'+nums+'" class="form-control col-md-11"><button class="btn btn-danger btn-sm btn-shadow deletes col-md-1" style=""><i class="fa fa-times"></i></button></div>');
            } else {
                alert('You cannot add more than 7 product picture.');
            }
        });

        $(wrappers).on("click", ".deletes", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            xx--;
        });
    });
    function remove_image(image, id) {

          $.ajax({
              type: 'POST',
              url: '../api/controllers/remove_product_image.php',
              data: {
                  image : image,
                  id : id
                  },
              cache: false,
              dataType: 'text',
              success: function (response) {
                console.log(response);
                $('#image-'+id).hide();

            }

          });
          event.preventDefault();

    };
</script>
