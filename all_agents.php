<?php require_once 'inc/header.php'; ?>
    <section id="breadcrumbs" class=" breadcrumbbg">
    <div class="breadcrumbwrapper">
        <div class="container">
        <nav>
            <ol class="breadcrumb" itemscope itemtype="#">
            <li itemprop="itemlistelement" itemscope itemtype="#">
                <a href="index.php" title="Back to the frontpage" itemprop="item">
                <span itemprop="name">Home</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="active" itemprop="itemlistelement" itemscope itemtype="#">
                <span itemprop="item"><span itemprop="name">All Verified Agents</span></span>
                <meta itemprop="position" content="2" />
            </li>
            </ol>
        </nav>
        </div>
    </div>
    </section>
    <div class="container">
        <div class="col-main col-full">
            <div id="shopify-section-collection-infos" class="shopify-section">
                <div class="collection-info banners">
                    <div class="collection-info-full">
                        <h1 class="collection-tille">List of our verified agents</h1>
                        <?php if(isset($_GET['result'])){ ?>
                            <span class="text-danger" style="font-size: 18px; float:right; right: 0; margin-top: -20px;"><em><?php echo $_GET['result']; ?></em></span>
                        <?php } ?>
                    </div>
                </div>
                <hr>
            </div>
            <div id="shopify-section-collection-template" class="shopify-section">
                <div data-section-id="collection-template" data-section-type="collection-template" class="products-collection">
                <div class="product-wrapper" id="Collection">
                    <div class="products-listing products-grid grid row default">
                        <div class="col-xl-12 col-lg-12 col-md12 col-sm-12 col-xs-12">
                            <div id="shopify-section-1544956418650" class="shopify-section home-section clearfix">
                                <div class="widget-collection">
                                    <div class="wrap-bg owl-style2">
                                        <div class="collections row">
                                            <?php $userClass->view_verified_agents(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="d-flex justify-content-center col-12">
                        <div class="toolbar-bottom"><!--
                            <ul class="pagination a-center">
                                <li class="page-item disabled"><span class="page-link"><i class="fa fa-angle-left" ></i> </span></li>
                                <li class="page-item active"><span class="page-link">1</span></li>
                                <li class="page-item next"><a class="page-link" href="#" title="Next &raquo;"><i class="fa fa-angle-right" ></i></a></li>
                            </ul> -->
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
