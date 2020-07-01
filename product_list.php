<?php require_once 'inc/header.php'; ?>
<?php
if(isset($_GET['marketid'])){
  $marketDetails = @$userClass->marketDetails($_GET['marketid']);
  $searchDetails = @$marketDetails->marketname;
}elseif(isset($_GET['state'])){
  $searchDetails = ucfirst($_GET['state']);
}

?>

<section id="breadcrumbs" class=" breadcrumbbg">
  <div class="breadcrumbwrapper">
    <div class="container">
      <nav>
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
          <li itemprop="itemlistelement" itemscope itemtype="http://schema.org/ListItem">
            <a href="index.php" title="Back to the frontpage" itemprop="item">
              <span itemprop="name">Home</span>
            </a>
          </li>
          <li class="active" itemprop="itemlistelement" itemscope itemtype="http://schema.org/ListItem">
            <span itemprop="item"><span itemprop="name"><?php echo @$searchDetails; ?></span></span>
            <meta itemprop="position" content="2" />
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
      <div class="block block-category spaceBlock">
        <h3 class="block-title">
          filter
        </h3>
        <div class="widget-content">
          <ul class="toggle-menu list-menu">
            <div class="swit form">
              <form method="get" action="<?php echo $_SERVER['REQUEST_URI'] ?>&">
                <div class="">
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Product Category</label>
                      <select name="product_category" class="form-control" id="select_category">
                        <option value="">Select Category</option>
                        <?php if(isset($_GET['product_category'])){$id=$_GET['product_category'];}else{$id="";}?>

                        <?php $userClass->products_cat_dropdown_list($id); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Product Type</label>
                      <input name="product_type" type="text" class="form-control" value="<?php if(isset($_GET['product_type'])){$id= $_GET['product_type'];}else{$id="";}?>" id="product_type">

                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Product Size</label>
                      <input name="size" type="text" class="form-control" value="<?php if(isset($_GET['size'])){$id= $_GET['size'];}else{$id="";}?>" id="select_category">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Product Color</label>
                      <input name="color" value="<?php if(isset($_GET['color'])){$id= $_GET['color'];}else{$id="";}?>" type="text" class="form-control" id="select_category">

                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Product Seller</label>
                      <select name="userid" class="form-control" id="select_category">
                        <option value="">Select seller</option>
                        <?php if(isset($_GET['userid'])){$id= $_GET['userid'];}else{$id="";}?>

                        <?php $userClass->seller_dropdown_list(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Product location</label>
                      <select name="location" class="form-control" id="select_category">
                        <option value="">Select Product Location</option>
                        <option value="local">Local</option>
                        <option value="international">International</option>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Market</label>
                      <select class="form-control" id="market" name="marketid">
                        <option value="">Choose Market</option>
                        <?php if(isset($_GET['marketid'])){$id=$_GET['marketid'];}else{$id="";}?>
                        <?php $userClass->market_dropdown_list($id); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Product area</label>
                      <input name="area" type="text" class="form-control" value="<?php if(isset($_GET['area'])){$id= $_GET['area'];}else{$id="";}?>" id="select_category">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Min Price</label>
                        <input class="form-control" type="number" name="min_price" min="0">
                      </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Max Price</label>
                        <input class="form-control" type="number" name="max_price" min="0">
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="page" value="1">

                </div>

                <button type="submit" class="btn btn-primary">Search</button>
              </form>
            </div>
          </ul>
        </div>
      </div>
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
      <div id="shopify-section-collection-infos" class="shopify-section">
        <div class="collection-info banners">
          <div class="collection-info-full">
            <h1 class="collection-tille"><?php echo @$searchDetails; ?></h1>
          </div>
        </div>
        <hr>
      </div>
      <div id="shopify-section-collection-template" class="shopify-section">

        <div data-section-id="collection-template" data-section-type="collection-template" class="products-collection">
          <div class="product-wrapper" id="Collection">
            <div class="products-listing products-grid grid row default">
              <?php
              if(isset($_GET['marketid']) && !isset($_GET['product_type'])){
                  $catDetails = $userClass->product_by_market($_GET['marketid']);

              }elseif(isset($_GET['state']) && !isset($_GET['product_type'])){
                  $catDetails = $userClass->product_by_state($_GET['state']);

              }else{

              $catDetails = $userClass->product_by_filter($_GET);


              }

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

</div>
<?php require_once 'inc/footer.php'; ?>
