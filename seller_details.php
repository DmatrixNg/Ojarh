<?php require_once 'inc/header.php'; ?>
<?php
    $businesCheck = (array) $userClass->bizDetails($_GET['sellerid']);
    if(empty($businesCheck)){
        echo 'yes';
    }else{
      if(!isset($_GET['sellerid'])){
        header("Location: ".BASE_URL);
      }

        $bcheck = $userClass->bizDetails($_GET['sellerid']);
        $userDetails = $userClass->userDetails($_GET['sellerid']);
    }
?>
<!-- <section id="breadcrumbs" class=" breadcrumbbg">
  <div class="breadcrumbwrapper">
    <div class="container">
      <nav>
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
          <li itemprop="itemlistelement" itemscope itemtype="http://schema.org/ListItem">
            <a href="<?= BASE_URL ?>" title="Back to the frontpage" itemprop="item">
              <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
          </li>

          <li itemprop="itemlistelement" itemscope itemtype="http://schema.org/ListItem">
            <a href="#" title="Beauty" itemprop="item">
              <span itemprop="name">Beauty</span>
            </a>
            <meta itemprop="position" content="2" />
          </li>
          <li class="active" itemprop="itemlistelement" itemscope itemtype="http://schema.org/ListItem">
            <span itemprop="item"><span itemprop="name">It uses a dictionary of over 200 Latin words</span></span>
            <meta itemprop="position" content="3" />
          </li>

        </ol>
      </nav>
    </div>
  </div>
</section> -->

<div class="container positon-sidebar">
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide col-md-12" style="height: 350px; overflow: hidden;" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="height: 350px !important;">

              <?php

              $storeimgs = json_decode(@$bcheck->storeimage);

              for ($i=0; $i < 4; $i++) {
                $picture = 'picture'.$i;
                // die(var_dump($bcheck));
                if (isset($storeimgs->$picture) && @$storeimgs->$picture != '') {?>

                <div class="carousel-item <?php if($i == 0){ echo 'active';} ?>" style="height: 350px !important;">
                    <img width="100%" height="350" src="<?= BASE_URL.strtolower($userDetails->role).'/storepicture/'.$_GET['sellerid'].'/'.$storeimgs->$picture ?>" alt="First slide">
                    <div class="carousel-caption d-md-block" style="background-color: rgba(50, 50, 50, 0.6);">
                        <h1><strong><?php echo @$bcheck->bizname; ?></strong></h1>
                        <h4><?php echo @$bcheck->bizphone; ?></h4>
                        <h4><?php echo @$bcheck->bizemail; ?></h4>
                        <h4><a href="//<?php echo isset($bcheck->bizwebsite) ? $bcheck->bizwebsite : ''; ?>" class="text-white" target="_blank">
                        <?php echo isset($bcheck->bizwebsite) ? $bcheck->bizwebsite : ''; ?></a></h4>
                    </div>
                </div>
                <?php    }else { ?>
                <div class="carousel-item  <?php if($i == 0){ echo 'active';} ?>" style="height: 350px !important;">
                <img width="100%" height="350" src="//cdn.shopify.com/s/files/1/0051/3130/4995/articles/4.png?v=1566550577" alt="First slide">
                    <div class="carousel-caption d-md-block" style="background-color: rgba(50, 50, 50, 0.6);">
                      <h1><strong><?php echo @$bcheck->bizname; ?></strong></h1>
                      <h4><?php echo @$bcheck->bizphone; ?></h4>
                      <h4><?php echo @$bcheck->bizemail; ?></h4>
                      <h4><a href="//<?php echo isset($bcheck->bizwebsite) ? $bcheck->bizwebsite : ''; ?>" class="text-white" target="_blank">
                      <?php echo isset($bcheck->bizwebsite) ? $bcheck->bizwebsite : ''; ?></a></h4>
                    </div>
                </div>
              <?php }
            } ?>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
  <div class="row mt-5">
    <div class="col-sidebar sidebar-fixed col-lg-3">
      <span id="close-sidebar" class="btn-fixed d-lg-none"><i class="fa fa-times"></i></span>
        <div class="block widget-blogs spaceBlock">
            <h3 class="block-title">
            <strong><span>Seller Informations</span></strong>
            </h3>
            <ul class="block-content">
                <li >
                <a href="javascript:window.location.reload();" style="font-size: 16px">Product Catalogue List<span class="count"></span></a>
                </li>
                <li  class="active">
                <a href="javascript:getSellerView(<?php echo $_GET['sellerid']; ?>,'business');" style="font-size: 16px">Business Details<span class="count"></span></a>
                </li>
                <li >
                <a href="javascript:getSellerView(<?php echo $_GET['sellerid']; ?>,'contact');" style="font-size: 16px">Contact Seller<span class="count"></span></a>
                </li>
                <li >
                <a href="javascript:openForm(<?php echo $_GET['sellerid']; ?>)" style="font-size: 16px">Live Chat<span class="count"></span></a>
                </li>
            </ul>
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

    <div id="shopify-section-1544955674090" class="shopify-section home-section">
                    <div class="widget-product-carousel style-grid carousel clearfix  show_dot">
                        <div id="sellerview" class="widget-content products-listing grid">
                            <div class="home-title style-grid">
                                <span>PRODUCT CATALOGUE LIST</span>
                                <!-- <a class="btn-deals" href=" /collections/electronics-computer">View All</a> -->
                            </div>
                            <div class="widget-product__item">
                                <div class="products-listing grid">
                                    <div class="product-layout block-content">
                                        <div class="ss-carousel ss-owl">
                                            <div class="owl-carousel"

                                                 data-nav="true"
                                                 data-margin="20"
                                                 data-autoplay="false"
                                                 data-autospeed="10000"
                                                 data-speed="300"
                                                 data-column1="4"
                                                 data-column2="3"
                                                 data-column3="2"
                                                 data-column4="1">

                                                 <?php $userClass->user_catalogue_pgrid($_GET['sellerid']); ?>

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
  <div class="chat-popup" id="myForm">
    <div class="form-container">
      <h6 style="padding-top: 7px; padding-bottom: 7px;">Message Seller/Admin/Buyer</h6>
      <hr>
      <div class="form-group">
          <label for="msg"><b>User/Seller</b></label>
          <input type="hidden" class="form-control" id="userid"  onclick="fetch_seller(this.id);"  onfocus="fetch_seller(this.id);" onkeyup="fetch_seller(this.id);" readonly>
          <input type="hidden" id="userid-<?php echo $_GET['sellerid'] ?>" value="<?php echo $_GET['sellerid'] ?>" placeholder="" readonly>

      </div>
      <div id="chat-box<?php echo $_GET['sellerid'] ?>" class="chatbox" style="overflow: scroll;
      max-height: 150px;"></div>
      <div class="form-group">
          <label for="msg"><b>Message</b></label>
          <textarea placeholder="Type message.." id="c_message" name="c_message" onfocus="loadChatbox(<?php echo $_GET['sellerid'] ?>)" rows="2" required></textarea>
      </div>
      <button type="submit" onclick="ReplyChatbox(<?php echo $_GET['sellerid'] ?>)"class="btn btn-sm">Send</button>
      <button type="button" class="btn btn-sm cancel" onclick="closeForm()">Close</button>

  </div>
  </div>
</div>

</div>
<?php require_once 'inc/footer.php'; ?>
<script>
$(".open-sidebar").click(function(e){

  $(".sidebar-overlay").toggleClass("show");
  $(".sidebar-fixed").toggleClass("active");
});
$( ".open-fiter" ).click(function() {
  $('.sidebar-fixed').slideToggle(200);
  $(this).toggleClass('active');
});
$(".sidebar-overlay").click(function(e){

  $(".sidebar-overlay").toggleClass("show");
  $(".sidebar-fixed").toggleClass("active");
});
$('#close-sidebar').click(function() {
  $('.sidebar-overlay').removeClass('show');
  $('.sidebar-fixed').removeClass('active');

});
function openForm(id) {
  // console.log(id);
  document.getElementById("myForm").style.display = "block";
}
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
