<div class="section-content  pt-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md12 col-sm-12 col-xs-12">
                <div id="shopify-section-1544955674090" class="shopify-section home-section">
                    <div class="widget-product-carousel style-grid carousel clearfix  show_dot">
                        <div class="widget-content products-listing grid">
                            <div class="home-title style-grid">
                                <span>Top Sales</span>
                                <a class="btn-deals" href="<?= BASE_URL ?>top_sales.php">View All</a>
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
                                                 data-column1="6"
                                                 data-column2="5"
                                                 data-column3="4"
                                                 data-column4="3"
                                                 data-column5="2"
                                                 data-column6="1">


                                                <?php $userClass->top_sales_list(); ?>


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
