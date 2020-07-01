<?php require_once 'inc/header.php'; ?>
        <section id="breadcrumbs" class=" breadcrumbbg">
            <div class="breadcrumbwrapper">
                <div class="container">
                    <nav>
                        <ol class="breadcrumb" >
                            <li>
                                <a href="<?= BASE_URL ?>" title="Back to the frontpage" itemprop="item">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="active">
                                <span itemprop="item">All Category</span>
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

                                <h1 class="collection-tille">Top Sales</h1>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div id="shopify-section-collection-template" class="shopify-section">
                        <div class="widget-product__item">
                            <div class="products-listing grid">
                                <div class="product-layout block-content">
                                    <div class="row">
                                    <?php $userClass->selling_products(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
        <?php require_once 'inc/footer.php'; ?>
