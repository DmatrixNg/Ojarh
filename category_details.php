<?php require_once 'inc/header.php'; ?>
<?php $catDetails = $userClass->categoryDetails($_GET['catid']); ?>
                <section id="breadcrumbs" class=" breadcrumbbg">
                    <div class="breadcrumbwrapper">
                        <div class="container">
                            <nav>
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="index.php" title="Back to the frontpage"><span>Home</span></a>
                                    </li>
                                    <li class="active">
                                        <span><span><?php echo $catDetails->catname; ?></span></span>
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
                                    <h1 class="collection-tille"><?php echo $catDetails->catname; ?></h1>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div id="shopify-section-collection-template" class="shopify-section">
                            <div data-section-id="collection-template" data-section-type="collection-template" class="products-collection">
                                <div class="product-wrapper" id="Collection">
                                    <div class="products-listing products-grid grid row default">

                                        <?php $userClass->category_grid($catDetails->catname); ?>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
<?php require_once 'inc/footer.php'; ?>