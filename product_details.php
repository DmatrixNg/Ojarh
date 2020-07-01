<?php require_once 'inc/header.php'; ?>
<style media="screen">
.loader2 {
  border: 2px solid #f3f3f3;
      border-top: 2px solid #3498db;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
}

@keyframes spin {
0% { transform: rotate(0deg); }
100% { transform: rotate(360deg); }
}
</style>
<?php
  if(isset($_GET['productid'])){
    $productDetails = $userClass->get_product_details($_GET['productid']);
    $categorydetails = $userClass->get_category_id($productDetails->product_category);
    $vendorDetails = $userClass->userDetails($productDetails->userid);
    $vendorBizDetails = $userClass->bizDetails($productDetails->userid);

    $productPack0 = $productDetails->pack0;
    $productPack1 = $productDetails->pack1;
    $productPack2 = $productDetails->pack2;
    $productPack3 = $productDetails->pack3;
    $productPack4 = $productDetails->pack4;
    $productPack5 = $productDetails->pack5;
    $productPack6 = $productDetails->pack6;
    $productPack7 = $productDetails->pack7;
    $productPack8 = $productDetails->pack8;

    $images = [];

    for($x = 0; $x < 7; $x++)
    {
      if($productDetails->{"img".$x})
      {
        $images[] = BASE_URL.strtolower($vendorDetails->role)."/productimg/".$productDetails->productid."/".$productDetails->{"img".$x};
      }
    }
    $productPacks = [$productPack0, $productPack1, $productPack2, $productPack3, $productPack4, $productPack5, $productPack6, $productPack7, $productPack8];
   }else{
    echo '<script> location.replace("index.php"); </script>';
   }
?>
<style type="text/css">
 /* The grid: Four equal columns that floats next to each other */
 .column {
  float: left;
  width: 25%;
  padding: 10px;
}

/* Style the images inside the grid */
.column img {
  opacity: 0.8;
  cursor: pointer;
}

.column img:hover {
  opacity: 1;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The expanding image container (positioning is needed to position the close button and the text) */
/* .container {
  position: relative;
  display: none;
} */

/* Expanding image text */
#imgtext {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  font-size: 20px;
}

/* Closable button inside the image */
.closebtn {
  position: absolute;
  top: 10px;
  right: 15px;
  color: white;
  font-size: 35px;
  cursor: pointer;
}
</style>

<section id="breadcrumbs" class=" breadcrumbbg">
  <div class="breadcrumbwrapper">
    <div class="container">
      <nav>
        <ol class="breadcrumb">
          <li>
            <a href="index.php" title="Back to the frontpage">
              <span itemprop="name">Home</span>
            </a>
          </li>
          <li>
            <a href="category_list.php?categoryid=<?php echo $categorydetails->catid; ?>" title="Category List">
              <span itemprop="name"><?php echo $productDetails->product_category; ?></span>
            </a>
          </li>
          <li class="active">
            <span><span itemprop="name"><?php echo $productDetails->product_title; ?></span></span>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<div class="container positon-sidebar">
  <div class="row">
    <div class="col-sidebar sidebar-fixed col-lg-3">
      <span id="close-sidebar" class="btn-fixed d-lg-none"><i class="fa fa-times"></i></span>
        <div class="block block-category spaceBlock">
            <h3 class="block-title">
                Categories
            </h3>
            <div class="widget-content">
                <ul class="toggle-menu list-menu">
                    <?php $userClass->get_all_category_list(); ?>
                </ul>
            </div>
        </div>
      <!-- <div class="block sidebar-html">
        <h3 class="block-title"><strong><span>Custom Services</span></strong></h3>
        <div class="widget-content">
          <div class="rte-setting">
              <div class="services-sidebar">
                  <ul>
                      <li>
                          <div class="service-content">
                              <div class="service-icon" style="font-size: 30px;">
                                  <em class="fa fa-truck"></em>
                              </div>

                              <div class="service-info">
                                  <h4><a href="#" title="Free Delivery">Free Delivery</a></h4>
                                  <p>From $59.89</p>
                              </div>
                          </div>
                      </li>

                      <li>
                          <div class="service-content">
                              <div class="service-icon" style="font-size: 30px;">
                                  <em class="fa fa-support"></em>
                              </div>

                              <div class="service-info">
                                  <h4><a href="#" title="Support 24/7">Support 24/7</a></h4>
                                  <p>Online 24 hours</p>
                              </div>
                          </div>
                      </li>

                      <li>
                          <div class="service-content">
                              <div class="service-icon" style="font-size: 30px;">
                                  <em class="fa fa-refresh"></em>
                              </div>

                              <div class="service-info">
                                  <h4><a href="#" title="Free return">Free return</a></h4>
                                  <p>365 a day</p>
                              </div>
                          </div>
                      </li>

                      <li>
                          <div class="service-content">
                              <div class="service-icon" style="font-size: 25px; position: relative; top: 4px;">
                                  <em class="fa fa-cc-paypal"></em>
                              </div>

                              <div class="service-info">
                                  <h4><a href="#" title="payment method">payment method</a></h4>
                                  <p>Secure payment</p>
                              </div>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>
        </div>
      </div> -->
        <div class="block sidebar-banner spaceBlock banners">
            <div>
                <a href="//<?= @$userClass->get_ads_home_one('sidebar')[0]['link'] ?? '#';?>">
                    <img class="img-responsive lazyload" data-sizes="auto"  src="public/ads/<?= @$userClass->get_ads_home_one('sidebar')[0]['img'] ?? "//cdn.shopify.com/s/files/1/0051/3130/4995/t/2/assets/icon-loadings.svg?466"; ?>"
                         srcset="public/ads/<?= @$userClass->get_ads_home_one('sidebar')[0]['img'] ?? "//cdn.shopify.com/s/files/1/0051/3130/4995/t/2/assets/icon-loadings.svg?466"; ?>"
                         alt="Top Ads">
                </a>

            </div>
        </div>
    </div>
    <div class="sidebar-overlay"></div>
    <div class="col-main col-lg-9 col-12">
      <a href="javascript:void(0)" class="open-sidebar d-lg-none"><i class="fa fa-bars"></i> Sidebar</a>
      <div id="shopify-section-product-template" class="shopify-section main-product">
        <div id="ProductSection-product-template" class="product-template__containe product" itemscope itemtype="http://schema.org/Product">
        <div class="product-single ">
          <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-12  horizontal">
               <div class="container">
                  <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
                  <?php
                                                          // var_dump($item[0]);
                                                          for ($i=0; $i < 7; $i++) {
                                                            $img = "img".$i;
                                                            if (!is_null($productDetails->$img) && !empty($productDetails->$img)) {

                                                            ?>
                                                                  <img id="expandedImg" src="<?= BASE_URL.strtolower($vendorDetails->role)?>/productimg/<?php echo $productDetails->productid; ?>/<?php echo $productDetails->$img; ?>" style="width:100%">



                                                          <?php
                                                          break;
                                                        }else {
                                                          continue;
                                                        }
                                                      }
                                                      ?>
                  <div id="imgtext"></div>
                </div>
                <div class="row">
                  <?php
                // die(print_r($productDetails));
                  for ($i=0; $i < 7; $i++) {
                    $img = "img".$i;
                    if (!is_null($productDetails->$img) && !empty($productDetails->$img)) {
                    ?>

                      <div class="column"><img src="<?= BASE_URL.strtolower($vendorDetails->role) ?>/productimg/<?php echo $productDetails->productid; ?>/<?php echo $productDetails->$img; ?>" onclick="myFunction(this);"></div>


                  <?php
                  break;
                }else {
                  continue;
                }
              }
              ?>

                </div>
            </div>
            <?php

            if ( strpos(@$productPacks[0], '+') ) {
              $productPack22  = explode('+',@$productPacks[0]);

            }elseif (strpos(@$productPacks[0], '@') ) {

              $productPack22  = explode('@',@$productPacks[0]);
            }else {
              $productPack22  ="";
            }
                $price = @$productPack22[1];
                // print_r($vendorBizDetails);
                $currency  = @$vendorDetails->currency;


            ?>
            <div class="col-lg-7 col-md-12 col-sm-12 col-12 product-single__detail grid__item ">
              <div class="product-single__meta">
                <h1 itemprop="name" class="product-single__title"><?php echo $productDetails->product_title; ?></h1>
                <div class="custom-reviews a-left hidden-xs d-flex justify-content-between">
                  <span class="shopify-product-reviews-badge" data-id="1871372910627"></span>
                </div>
                <div class="product-info">
                  <p class="product-single__alb instock"><label>Availability</label>: <?php if($productDetails->productavailability == 'In Stock'){ echo '<i class="fa fa-check-square-o"></i> ' . $productDetails->productavailability; }else{ echo '<i class="fa fa-times-o"></i> ' . $productDetails->productavailability; } ?></p>
                  <p class="product-single__type"><label>Product Category</label>:  <a href="<?= BASE_URL ?>category_list.php?catid=<?php echo $categorydetails->catid; ?>" title="Category List"><?php echo $productDetails->product_category; ?></a></p>
                  <p itemprop="brand" class="product-single__vendor"><label>Vendor</label>: <a href="<?= BASE_URL ?>seller_details.php?sellerid=<?php echo @$productDetails->userid; ?>" title="Home2"><?php echo ucfirst(@$vendorBizDetails->bizname).'[  '.Ucfirst($vendorDetails->username).' ]'; ?></a></p>
                </div>
                <div class="clearfix"  >
                  <meta itemprop="priceCurrency" content="USD">
                  <link itemprop="availability" href="#">
                </div>
                <div>
                  <?php    //print_r($productPacks);
 ?>
                    <div class="product-options-bottom">
                      <div class="product-form__item product-form__item--quantity pt-1">
                        <label for="Quantity"  class="quantity-selector">Pack Type</label>
                        <div class="form_qty">
                          <select class="form-control" id="pack" onchange="updatePricing($('#qty').val(), $('#pack').val(),<?= $price ?>); return false;">
                            <option value="1@@0">Choose...</option>
                            <?php
                            $i = 1;
                              foreach($productPacks as $productPack){
                                $i++;
                              $productPack22 = explode("@", $productPack);

                                if($productPack22[0] == 0){}else{ echo '<option value="'.$productPack.'">'.$productPack22[0].'</option>';}
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="product-form__item product-form__item--quantity">
                        <label for="Quantity" class="quantity-selector">Qty:</label>
                        <div class="form_qty">
                          <input type="text" id="qty" name="quantity" value="1" min="1" class="quantity-selector">
                          <div class="inline">
                            <div class="increase items" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++; updatePricing($('#qty').val(), $('#pack').val(),<?= $price ?>); return false;"></div>
                            <div class="reduced items" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 1 ) result.value--; updatePricing($('#qty').val(), $('#pack').val(),<?= $price ?>); return false;"></div>
                          </div>
                        </div>
                      </div>
                      <div class="product-form__item product-form__item--submit">
                        <?php $cart = array(
                          "sellerid" => $productDetails->userid,
                          "productID" => $productDetails->productid,
                          "action" => "1");
                          // die(print_r($_COOKIE['cart']));
                          if (isset($_COOKIE['cart'])) {
                            $stored = [];
                            foreach (json_decode($_COOKIE['cart'], true) as $id) {

                              $stored[] = array(
                                'sellerid' => $id['sellerid'],
                                'productID' => $id['productID'],
                                'action' => $id['action']
                              );
                            }
                          }
                          if(isset($stored) && in_array($cart, $stored)){?>
                            <button type="submit" name="add" id="<?php echo $productDetails->userid; ?>" onclick="AddCart(this.id, <?php echo $productDetails->productid; ?>, $('#qty').val(),$('#price').val(),$('#pack').val(),0)" class="btn product-form__cart-submit product-form__cart-submit--small">
                              <span>
                                Remove Item
                              </span>
                            </button>
                        <?php  }else {?>
                            <button type="submit" name="add" id="<?php echo $productDetails->userid; ?>" onclick="AddCart(this.id, <?php echo $productDetails->productid; ?>, $('#qty').val(),$('#price').val(),$('#pack').val(),1)" class="btn product-form__cart-submit product-form__cart-submit--small">
                              <span id="AddToCartText-product-template">
                                Add to cart
                              </span>
                            </button>
                        <?php   }?>
                      </div>
                    </div>
                    <input type="hidden" name="form_type" value="product"><input type="hidden" name="utf8" value="✓">
                    <div data-shopify="payment-button" class="shopify-payment-button"><div>
                  </div>
                </div>
                <?php
                  if($userClass->isFavExist($productDetails->userid, $productDetails->productid)){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                  }else{
                    $fav = '';
                    $favo = '';
                  }
                ?>
                <div class="add-to-wishlist">
                  <div class="default-wishbutton-headphone loading">
                    <a class="add-in-wishlist-js"  <?php echo $fav; ?> href="#" onclick="addFav(<?php echo $productDetails->productid; ?>)"><i <?php echo $favo; ?> class="fa fa-heart-o"></i><span class="tooltip-label">Add to favourite</span></a>
                  </div>
                </div>
                <div class="clearfix product-price">
                  <p class="price-box product-single__price-product-template">
                    <h4>TOTAL:
                        <span id="ProductPrice-product-template">
                        <span class='money text-danger'>
                          <input type="hidden" id="price" name="" value="<?= $price ?>">
                          <?= $currency.'<span id="newP">'.number_format($price, 2).'</span>' ?>
                        </span>
                      </span>
                    </h4>

                  </p>
                </div>
            </div>
            <div class="clearfix error-message"></div>
                <div class="simpAsk-container" id="simpAskQuestion">
                  <div class="simpAsk-title-container">
                    <h2>QUESTIONS & ANSWERS</h2>
                    <div class="simpAsk-error-msg" style="display:none"></div>
                    <div class="simpAsk-success-msg" style="display:none"></div>
                  </div>
                  <div class="simp-ask-question-header">
                    <div class="row">
                      <div class="col-md-7">
                        <h5>Interested in this product?</h5>
                        <p>Contact seller to purchase in large quantity.</p>
                      </div>
                      <div class="col-md-5">
                        <?php if (!isset($_SESSION['userid'])) { ?>
                          <a href="<?= BASE_URL ?>/signin.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-default btn-sm">Signin to Message Seller <i class="fa fa-envelope"></i></a>
                          <a href="<?= BASE_URL ?>/signin.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-danger btn-sm">Signin to Chat <i class="fa fa-comments"></i></a>

                        <?php  }else {  ?>
                        <button class="btn btn-default btn-sm simpAskQuestionForm-btnOpen"> Message Seller <i class="fa fa-envelope"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="openForm(this.id)" id="<?php echo $productDetails->userid ?>"> Live Chat <i class="fa fa-comments"></i></button>

                      <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="simpAskForm-container" id="simpAskForm_container" style="display:none;">
                      <div class="form-group">
                        <textarea required style="resize:none; min-height:86px;" class="form-control" name="b_message" id="b_message" placeholder="Type your message here"></textarea>
                      </div>
                      <div class="form-group">
                        <input required type="text" name="b_name" value="" placeholder="Your Name" class="form-control" id="b_name">
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <input required type="text" name="b_phone" value="" placeholder="Your Phone Number" class="form-control" id="b_phone">
                        </div>
                        <div class="col-md-6">
                          <input required type="email" name="b_email" value="" placeholder="Your Email" class="form-control" id="b_email">
                        </div>
                      </div>
                      <div class="form-group row mmm">
                      </div>
                      <div class="simpAskSubmitForm">
                        <?php //print_r($productDetails) ?>
                        <input type="hidden" id="productid" name="productid" value="<?php echo $productDetails->productid; ?>">
                        <input class="button button-primary btn btn-primary btn btn--fill btn--color" type="button" id="<?php echo $productDetails->userid ?>" onclick="sendMseller(this.id)" value=" Submit">
                        <a href="javascript:void(0)" class="simpAskForm-cancel-btn button">Cancel</a>
                        <div class="clear"></div>
                      </div>
                  </div>
                </div>
                <div class="product-wrap">
                  <div class="wrap__social social_share_detail clearfix">
                    <label class="">Share:</label>
                    <ul>
                      <div class="addthis_inline_share_toolbox"></div>
                      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-529be2200cc72db5"></script>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-group detail-bottom">
            <div class="tab-hozizoltal">
              <ul class="nav nav-tabs font-ct">
                <li class="nav-item"><a class="nav-link active" href="#tabs1" data-toggle="tab">Product Details</a></li>
                <li class="nav-item"><a class="nav-link" href="#tabs2" data-toggle="tab">Shipping &amp; Returns</a></li>
                <li class="nav-item"><a class="nav-link" href="#tabs3" data-toggle="tab">Time &amp; Delivery</a></li>
                <li class="nav-item"><a class="nav-link" href="#tabs4" data-toggle="tab">Reviews</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tabs1">
                  <div class="rte description">
                    <label  class="d-none">Quick Overview</label>
                    <?php echo html_entity_decode($productDetails->product_description); ?>
                  </div>
                </div>
                <div class="tab-pane" id="tabs2">
                  <?php echo $vendorBizDetails->returnpolicy; ?>
                </div>
                <div class="tab-pane" id="tabs3">
                <?php echo $vendorBizDetails->timedelivery; ?>
                </div>
                <div class="tab-pane" id="tabs4">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="spr-header-title">Customer Reviews</h2>
                      <button class='btn btn-dark pull-right' style="margin-top: -30px !important;" id="<?php echo $productDetails->userid.'-'.$productDetails->productid; ?>" onclick='reviewproduct(this.id)'>Write a review</button>
                    </div>
                    <div class="col-md-12" id="review_list">
                      <?php $userClass->fetch_review($productDetails->productid); ?>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
<!-- <section class="section-related">
  <div id="related" class="related-products">
    <h3 class="detail-title font-ct"><strong><span>Related Products</span></strong></h3>
  <div class="products-listing grid ss-carousel ss-owl">
    <div class="product-layout owl-carousel" data-nav="true" data-margin="20" data-lazyLoad="true" data-column1="	3" data-column2="	3" data-column3="	3" data-column4="	2" data-column5="	2">
      <div class="">
        <div class="product-item" data-id="product-1873558405155">
          <div class="product-item-container grid-view-item   ">
            <div class="left-block">
              <div class="product-image-container product-image">
                <a class="grid-view-item__link image-ajax" href="<?= BASE_URL ?>products/3-piece-suit">
                  <img class="img-responsive s-img lazyload" data-sizes="auto" src="//cdn.shopify.com/s/files/1/0051/3130/4995/t/2/assets/product-loading.svg?466" data-src="//cdn.shopify.com/s/files/1/0051/3130/4995/products/product8_fa39984c-ec58-40fc-b5d7-53f930f7368d_large_crop_center.png?v=1566616573" alt="3 piece suit" />
                </a>
              </div>
              <div class="box-labels"></div>
              <div class="button-link">
                <div class="add-to-wishlist">
                    <div class="default-wishbutton-3-piece-suit loading"><a class="add-in-wishlist-js " href="3-piece-suit"><i class="fa fa-heart-o"></i><span class="tooltip-label">Add to wishlist</span></a></div>
                  <div class="loadding-wishbutton-3-piece-suit loading" style="display: none; pointer-events: none"><a class="add_to_wishlist" href="3-piece-suit"><i class="fa fa-circle-o-notch fa-spin"></i></a></div>
                    <div class="added-wishbutton-3-piece-suit loading" style="display: none;"><a class="added-wishlist  add_to_wishlist" href="<?= BASE_URL ?>pages/wishlist"><i class="fa fa-heart"></i><span class="tooltip-label">View Wishlist</span></a></div>
                </div>
                <div class="btn-button add-to-cart action  ">
                  <form action="/cart/add" method="post" class="variants" data-id="AddToCartForm-1873558405155" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="15567062237219" />
                    <a class="btn-addToCart grl btn_df" href="javascript:void(0)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                  </form>
                </div>
                <div class="quickview-button">
                  <a class="quickview iframe-link d-none d-xl-block btn_df" href="javascript:void(0)" data-variants_id="15567062237219" data-toggle="modal" data-target="#myModal" data-id="3-piece-suit" title="Quick View"><i class="fa fa-search"></i><span class="hidden">Quick View</span></a>
                </div>
              </div>
            </div>
            <div class="right-block">
              <div class="caption">
                <h4 class="title-product text-truncate"><a class="product-name" href="<?= BASE_URL ?>products/3-piece-suit">3 piece suit</a></h4>
                <div class="custom-reviews">
                  <span class="shopify-product-reviews-badge" data-id="1873558405155"></span>
                </div>
                <div class="price">
                  <span class="visually-hidden">Regular price</span>
                  <span class="price-new"><span class=money>$47.00</span></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section> -->
<div class="chat-popup" id="myForm">
  <div class="form-container">
    <h6 style="padding-top: 7px; padding-bottom: 7px;">Message Seller/Admin/Buyer</h6>
    <hr>
    <div class="form-group">
        <label for="msg"><b>User/Seller</b></label>
        <input type="hidden" class="form-control" id="userid"  onclick="fetch_seller(this.id);"  onfocus="fetch_seller(this.id);" onkeyup="fetch_seller(this.id);" readonly>
        <input type="hidden" id="userid-<?php echo $productDetails->userid ?>" value="<?php echo $productDetails->userid ?>" placeholder="'.ucfirst($row['lname']).' '.ucfirst($row['fname']).'" readonly>

    </div>
    <div id="chat-box<?php echo $productDetails->userid ?>" class="chatbox" style="overflow: scroll;
    max-height: 150px;"></div>
    <div class="form-group">
        <label for="msg"><b>Message</b></label>
        <textarea placeholder="Type message.." id="c_message" name="c_message" onfocus="loadChatbox(<?php echo $productDetails->userid ?>)" rows="2" required></textarea>
    </div>
    <button type="submit" onclick="ReplyChatbox(<?php echo $productDetails->userid ?>)"class="btn btn-sm">Send</button>
    <button type="button" class="btn btn-sm cancel" onclick="closeForm()">Close</button>

</div>
</div>
</div>
</div>
</div>
    </div>
  </div>
</div>
<script>
  function myFunction(imgs) {
  // Get the expanded image
  var expandImg = document.getElementById("expandedImg");
  // Get the image text
  var imgText = document.getElementById("imgtext");
  // Use the same src in the expanded image as the image being clicked on from the grid
  expandImg.src = imgs.src;
  // Use the value of the alt attribute of the clickable image as text inside the expanded image
  imgText.innerHTML = imgs.alt;
  // Show the container element (hidden with CSS)
  expandImg.parentElement.style.display = "block";
}
</script>

</div>
<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
function sendmessage(uid){
  $('#messenger').modal('show');
}

function openForm(id) {
  // console.log(id);
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script>
var slider = function() {
  if (!$('.slider-for').hasClass('slick-initialized') && !$('.slider-nav').hasClass('slick-initialized')) {
    $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      nextArrow: '<div class="slick-next"><i class="fa fa-angle-right"></i></div>',
      prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left"></i></div>',
      fade: true,
      accessibility:false,
      verticalSwiping: false,
      arrows : false,

      asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
      infinite: true,
      slidesToShow: 4,


      slidesToScroll: 1,
      asNavFor: '.slider-for',
      verticalSwiping: false,
      dots: false,

      accessibility:false,
      focusOnSelect: true,


      nextArrow: '<div class="slick-next"><i class="fa fa-angle-right"></i></div>',
      prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left"></i></div>',


      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1
          }
        },

        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1
          }
        },

        {
          breakpoint: 768,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false
          }
        },
        {
          breakpoint: 321,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 2,
            dots: false
          }
        },

        ]

      });
    }
  };

  var timer;
  var winW = $(window).width();

  $(window).on('resize.refreshSlick', function() {
    clearTimeout(timer);
    timer = setTimeout(function() {
      var curW = $(window).width();
      if (curW >= 768 && winW < 768) {
        $('.slider-for').slick('unslick');
        $('.slider-nav').slick('unslick');
        $('.slider-nav').find('.slick-list').removeAttr('style');
        $('.slider-nav').find('.slick-track').removeAttr('style');
        $('.slider-nav').find('.slick-slide').removeAttr('style');
        $('.slider-nav').find('button.slick-arrow').remove();

        slider();
      }
      winW = curW;
    }, 500);
  });

  $(".tab-vertical>ul>li").on('click', function () {
    $(".tab-vertical>ul>li").removeClass("active");
    $(this).addClass("active");
  });

</script>
