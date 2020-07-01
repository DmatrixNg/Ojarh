<div class="section-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div id="shopify-section-1544518576765" class="shopify-section home-section">
                    <div class="widget-slideshow">
                        <div class="coll-slider heroCarousel-slider ss-owl">
                            <div class="owl-carousel"
                                    data-margin="0"
                                    data-nav="false"
                                    data-dots="true"
                                    data-autoplay="true"
                                    data-autospeed="100000"
                                    data-speed="800000"
                                    data-loop="true"
                                    data-column1="1"
                                    data-column2="1"
                                    data-column3="1"
                                    data-column4="1"
                                    data-column5="1">
                                <div class="heroCarousel--item item-1"><a href="#"
                                                                            class="heroCarousel-item">
                                        <img class="collection-img img-responsive lazyload"
                                                data-sizes="auto"
                                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                alt="RT AaShop demo"
                                                data-src="assets/images/slider-3.png?v=1566545070)"/>
                                        <div class="heroCarousel-content text-black">
                                            <h1 class="heroCarousel-title"
                                                style="color: #000000 !important;">The Winter</h1>
                                            <h3 class="tilte" style="color: #000000 !important;">
                                                Essentials</h3>
                                            <p class="heroCarousel-description"
                                                style="color: #000000 !important;">It’s on you how you want
                                                to
                                                live your life. Everyone has a choice.</p>
                                            <span class="heroCarousel-action" style="color: #ffffff !important;"> Shop Now </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="heroCarousel--item item-2"><a href="#"
                                                                            class="heroCarousel-item">
                                        <img class="collection-img img-responsive lazyload"
                                                data-sizes="auto"
                                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                alt="RT AaShop demo"
                                                data-src="assets/images/slider-1.png"/>
                                        <!--<div class="heroCarousel-content">
                                            <h1 class="heroCarousel-title"
                                                style="color: #000000 !important;">Soni - 1000x</h1>
                                            <h3 class="tilte" style="color: #000000 !important;">wireless
                                                noise cancelling<br> headphones -
                                                black</h3>
                                            <p class="heroCarousel-description"
                                                style="color: #000000 !important;">It’s on you how you want
                                                to
                                                live your life. Everyone has a choice.</p>
                                            <span class="heroCarousel-action "> Shop Now </span>
                                        </div>-->
                                    </a>
                                </div>
                                <!--<div class="heroCarousel--item item-3"><a href="#" class="heroCarousel-item">
                                        <img class="collection-img img-responsive lazyload"
                                                data-sizes="auto"
                                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                alt="RT AaShop demo"
                                                data-src="assets/images/slider-1_7a6771c5-8d62-40f3-bd93-e49b501454b5.png?v=1566545092)"/>
                                        <div class="heroCarousel-content">
                                            <h1 class="heroCarousel-title"
                                                style="color: #000000 !important;">Facecare Edition</h1>
                                            <h3 class="tilte" style="color: #000000 !important;">new <br>body
                                                yogurts</h3>
                                            <span class="heroCarousel-action "
                                                    style="color: #ffffff !important;"> Shop Now </span>
                                        </div>
                                    </a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div id="shopify-section-home-product-deals" class="shopify-section home-section"
                        style="height: 90% !important; background-image: url(assets/images/side_bg.jpg); background-position: center center;">
                        <?php if(!isset($_SESSION['userid'])){?>

                      <div class="formaccount formlogin block">
                        <h2 class="page-title">Become A Seller</h2>
                        <div class="formcontent">
                            <div class="registerdescription">
                                <p>Sign up for a free account. Registration is quick and easy.</p>
                            </div>
                            <div class="submit">
                                <a href="signin.php">
                                    <button class="btn btn-info btn-block"><i class="fa fa-sign-in"></i>
                                        Sign In
                                    </button>
                                </a>
                            </div>
                            <br>
                            <div class="submit">
                                <a href="signin.php">
                                    <button class="btn btn-info btn-block"><i class="fa fa-sign-up"></i>
                                        Sign Up
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                  <?php  }else{ ?>
                    <div class="formaccount formlogin block">
                      <h2 class="page-title">Welcome back</h2>
                      <div class="formcontent">
                          <div class="registerdescription">
                              <!-- <p>Sign up for a free account. Registration is quick and easy.</p> -->
                          </div>
                          <div class="submit">

                              <a href="<?= BASE_URL.strtolower($_SESSION['role']).'/' ?>">
                                  <button class="btn btn-info btn-block"><i class="fa fa-sign-in"></i>
                                    Enter Dashboard
                                  </button>
                              </a>
                          </div>
                          <br>
                          <div class="submit">
                              <a href="<?= BASE_URL.'api/controllers/logout.php' ?>">
                                  <button class="btn btn-info btn-block"><i class="fa fa-sign-up"></i>
                                      Logout
                                  </button>
                              </a>
                          </div>
                      </div>
                  </div>
                  <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md12 col-sm-12 col-xs-12">
                <div id="shopify-section-1544956756018" class="shopify-section home-section"
                    style="padding-bottom: 40px !important;">
                    <div class="widget-logolist">
                        <div class="home-title style-grid">
                            <span>BRANDS</span>
                        </div>
                        <div class="wrap">
                            <div class="ss-carousel ss-owl logo-bars">
                                <div class="product-layout owl-carousel"
                                    data-nav="true"
                                    data-margin="30"
                                    data-loop="true"
                                    data-autoplay="true"
                                    data-autospeed="10000"
                                    data-speed="300"
                                    data-column1="6"
                                    data-column2="4"
                                    data-column3="3"
                                    data-column4="3"
                                    data-column5="2">

                                    <?php foreach($userClass->getBrands() as $key => $value): ?>
                                        <div class="logo-item">
                                            <a href="#" class="logo-bar__link">
                                                <img class="img-responsive" alt="RT AaShop demo"
                                                    src="admin/images/brands/<?= $value['img']; ?>"/>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
