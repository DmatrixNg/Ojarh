<div class="section-content pt-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md12 col-sm-12 col-xs-12">
                <!-- Advert layer 1 -->
                <div id="shopify-section-1544955458813" class="shopify-section home-section">
                    <div class="home-title style-grid" style="padding-top: 0px !important; margin-bottom: 5px !important;">
                        <span style="font-size: 16px !important;">Store Ads:</span>
                    </div>
                    <div class="widget_multibanner radius_3">
                        <div class="container-full">
                            <div class="widget-content">
                              <div class="wrap-bg owl-style2">


                                  <div class="collections">
                                      <div class="ss-carousel ss-owl">
                                          <div class="owl-carousel" data-nav="true" data-autoplay="true" data-loop="false" data-margin="40" data-column1="4" data-column2="3" data-column3="2" data-column4="2" data-column5="1">

                                    <?php foreach($userClass->get_ads_home('body') as $key => $value): ?>
<!--                                        <div class="item_banner item1 col-lg-4 col-md-4 col-sm-6 col-12">-->
<!--                                            <div class="banners">-->
                                                <div id="ads-<?= $value['id']; ?>" class="">
                                                    <a href="//<?= $value['link']; ?>" title="<?= $value['link']; ?>">
                                                        <img class="img-responsive lazyload" data-sizes="auto"
                                                            src="assets/images/icon-loadings.svg?466"
                                                            alt="<?= $value['link']; ?>"
                                                            data-src="public/ads/<?= $value['img']; ?>"/>
                                                    </a>
<!--                                                </div>-->
<!--                                            </div>-->
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- <div class="item_banner item1 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="banners">
                                            <div class="">
                                                <a href="#" title="RT AaShop demo">
                                                    <img class="img-responsive lazyload" data-sizes="auto"
                                                         src="assets/images/icon-loadings.svg?466"
                                                         alt="RT AaShop demo"
                                                         data-src="assets/images/banner_01.png?v=1566546131"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item_banner item2 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="banners">
                                            <div class="">
                                                <a href="#" title="RT AaShop demo">
                                                    <img class="img-responsive lazyload" data-sizes="auto"
                                                         src="assets/images/icon-loadings.svg?466"
                                                         alt="RT AaShop demo"
                                                         data-src="assets/images/banner_02.png?v=1566546139"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item_banner item3 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="banners">
                                            <div class="">
                                                <a href="#" title="RT AaShop demo">
                                                    <img class="img-responsive lazyload" data-sizes="auto"
                                                         src="assets/images/icon-loadings.svg?466"
                                                         alt="RT AaShop demo"
                                                         data-src="assets/images/banner_03.png?v=1566546147"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
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
