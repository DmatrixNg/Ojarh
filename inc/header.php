<?php
require_once 'api/config/Database.php';
require_once 'api/models/Controller.php';
$db = getDB();
$userClass = new Users($db);
if(isset($_SESSION['userid']))
	{
		$userid=$_SESSION['userid'];
		$userDetails = $userClass->userDetails($_SESSION['userid']);
    }
?>
<!doctype html>
<!--[if IE 9]>
<html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Basic page -->

    <meta name="viewport" content="width=device-width,user-scalable=1">
    <meta name="theme-color" content="#7796a8">
    <link rel="canonical" href="https://ojarh.com">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo_120x@3x.png?466" type="image/x-icon"/>
    <!-- Title and description -->
    <title>
        OJARH.com - home of wholesalers...
    </title>
    <meta name="description"
          content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Script -->
    <link rel="icon" href="assets/images/logo_120x@3x.png">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css"/>

    <link href="assets/css/for_chat.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/css/theme-config.scss.css?466" rel="stylesheet"
          type="text/css" media="all"/>
    <link href="assets/css/theme-style.scss.css?466" rel="stylesheet"
          type="text/css" media="all"/>
    <link href="assets/css/theme-sections.scss.css?466" rel="stylesheet"
          type="text/css" media="all"/>
    <link href="assets/css/theme-responsive.scss.css?466" rel="stylesheet"
          type="text/css" media="all"/>
    <link href="assets/css/animate.css?466" rel="stylesheet" type="text/css"
          media="all"/>
    <link href="assets/css/owl.carousel.min.css?466" rel="stylesheet"
          type="text/css" media="all"/>
    <link href="assets/css/jquery.fancybox.css?466" rel="stylesheet"
          type="text/css" media="all"/>
<!--    <script id="shopify-features" type="application/json">-->
<!--        {-->
<!--            "accessToken": "c227cfd494728708c39f85b8f84953b5",-->
<!--            "betas": [],-->
<!--            "domain": "rt-aashop-demo.myshopify.com",-->
<!--            "predictiveSearch": true,-->
<!--            "shopId": 5131304995,-->
<!--            "smart_payment_buttons_url": "https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/spb.en.js",-->
<!--            "dynamic_checkout_cart_url": "https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/dynamic-checkout-cart.en.js"-->
<!--        }</script>-->
    <script integrity="sha256-6LRkPKq7iEM0KHCD+fcDYMQJ0xf6KyB1NPgT0P7xsMc=" crossorigin="anonymous"
            data-source-attribution="shopify.loadfeatures" defer="defer"
            src="assets/js/load_feature-e8b4643caabb884334287083f9f70360c409d317fa2b207534f813d0fef1b0c7.js">
    </script>
    <script integrity="sha256-qzPTa4Ven/Yc2yyXr9BKZWCTXSrPTCnbGdWsxA7YCw0="
            data-source-attribution="shopify.dynamic-checkout" defer="defer"
            src="assets/js/features-ab33d36b855e9ff61cdb2c97afd04a6560935d2acf4c29db19d5acc40ed80b0d.js"
            crossorigin="anonymous">
    </script>
    <link rel="stylesheet" media="screen"
          href="assets/css/styles.css?466">
    <link rel="stylesheet" media="screen"
          href="assets/css/biz.css">
    <script id="sections-script" data-sections="home-slider,homepage-product-carousel,ss-tools,ss-facebook-message"
            defer="defer" src="assets/js/scripts.js?466"></script>

        <!-- <link rel="stylesheet" media="all" href="assets/css/v2-ltr-edge-45c5a0665f17c948dd566c307407b5de-477" /> -->
    <style>
        .shadowbox {
            border: none !important;
            padding: 5px;
            box-shadow: 4px 4px 4px 4px #ccc;
        }
    </style>
</head>
<body class="template-index">
<div id="wrapper" class="page-wrapper wrapper-full effect_10">
      <!-- Loading Site
    <div id="loadingSite">
        <div class="cssload-loader">
            <span class="block-1"></span>
            <span class="block-2"></span>
            <span class="block-3"></span>
            <span class="block-4"></span>
            <span class="block-5"></span>
            <span class="block-6"></span>
            <span class="block-7"></span>
            <span class="block-8"></span>
            <span class="block-9"></span>
            <span class="block-10"></span>
            <span class="block-11"></span>
            <span class="block-12"></span>
            <span class="block-13"></span>
            <span class="block-14"></span>
            <span class="block-15"></span>
            <span class="block-16"></span>
        </div>
    </div> -->
    <header id="header" class="header header-style1">
        <div class="sidebar-top d-none d-lg-block">
            <div class="container" style="text-align:center">
							<?php //die(print_r($userClass->get_ads_home_one('top'))) ?>
                <a href="//<?= @$userClass->get_ads_home_one('top')[0]['link']; ?>" class="site-header-banner-image">
                    <img src="public/ads/<?= @$userClass->get_ads_home_one('top')[0]['img']; ?>"
                         srcset="public/ads/<?= @$userClass->get_ads_home_one('top')[0]['img']; ?>"
                         alt="Top Ads">
                </a>
            </div>
        </div>
        <div class="header-top d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="header-top-left col-xl-7 col-lg-7 d-none d-lg-block">
                        <div class="welcome-msg d-none d-lg-block">
                            Welcome to OJARH.com, Home of Wholesalers, Importers, and Brand Owners.
                        </div>
                    </div>
                    <div class="header-top-right no__at col-xl-5 col-lg-5 col-sm-12 col-12">
                        <div id="menu-menu-top-right">
                            <div class="toplink-item language no__at">
                                <!-- language start -->
                                <div class="language-theme ">
                                    <button class="btn btn-primary dropdown-toggle" type="button">English
                                        <i class="fa fa-angle-down"></i></button>
                                    <ul class="dropdown-menu dropdown-content">
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">French</a></li>
                                    </ul>
                                </div>
                                <!-- language end -->
                            </div>
                            <div class="toplink-item checkout currency">
                                <div class="currency-wrapper">
                                    <label class="currency-picker__wrapper">
                                        <select class="currency-picker" name="currencies"
                                                style="display: inline; width: auto; vertical-align: middle; margin-top: -25px !important;">
                                            <option value="NAIRA" selected="selected">NAIRA</option>
                                            <option value="USD">USD</option>
                                            <option value="EUR">EUR</option>
                                        </select>
                                    </label>
                                    <div class="pull-right currency-Picker">
                                        <a class="dropdown-toggle" href="#" title="NAIRA">NAIRA</a>
                                        <ul class="drop-left dropdown-content">
                                            <li><a href="#" title="NAIRA" data-value="NAIRA">NAIRA</a></li>
                                            <li><a href="#" title="USD" data-value="USD">USD</a></li>
                                            <li><a href="#" title="EUR" data-value="EUR">EUR</a></li>
                                            <li><a href="#" title="YUAN" data-value="YUAN">YUAN</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="toplinks-wrapper">
                        </ul>
                        <div class="telephone d-none d-lg-block">
                            <i class="fa fa-phone-square"></i> Hotline:
                            <a href="tel:09082244668" style="color: #ffffff !important;">090 8224 4668</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-center">
            <div class="container">
                <div class="row">
                    <div class="navbar-logo col-xl-2 col-lg-2 d-none d-lg-block">
                        <div class="site-header-logo title-heading">
                            <a href="index.php" itemprop="url" class="site-header-logo-image">
                                <img src="assets/images/logo_149x.png?v=1566553564"
                                     srcset="assets/images/logo_149x.png?v=1566553564"
                                     alt="Ojarh.com"
                                     itemprop="logo">
                            </a>
                        </div>
                    </div>
                    <div class="bottom2 col-xl-7 col-lg-8 d-none d-lg-block mx-auto" style="padding-top: 20px !important;">
                        <div class="header-search">
                            <div class="search-header-w">
                                <div class="btn btn-search-mobi hidden">
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="form_search">
                                    <form class="formSearch" action="search_result.php" method="get">
                                        <input class="form-control" type="search" name="search" id="search" value="" placeholder="Enter keywords here... " autocomplete="off"/>
                                        <button class="btn btn-search btn-danger" type="submit" style="font-size: 12px; font-weight: bold;">
                                            <span class="btnSearchText d-none ">GO OJARH</span> GO OJARH
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(!empty($_SESSION['userid']) && !empty($_SESSION['role'])){
                    ?>
                    <div class="middle-right col-xl-3 col-lg-2 d-none d-lg-block pt-lg-3">
                        <div class="minicart-header">
                            <a href="#" class="site-header__carts shopcart dropdown-toggle">
                            <span class="cart_ico">
                                <!-- <img width="52" class="rounded-circle"
                                     src="seller/profilepicture/avatars/avatar.jpg" alt=""> -->
                                     <?php $profilepicD = $userClass->readProfilePix3($userDetails->userid); ?>
                            </span>
                                <span class="cart_info">
                                    <span class="cart-title"><span class="title-cart"><?php echo ucfirst($userDetails->username); ?></span>
                                </span>
                            </span>
                            </a>
                            <?php if($_SESSION['role'] == 'Seller'){ ?>
                                <div class="block-content dropdown-content" style="display: none;">
                                    <div class="p-2">
                                        <p class="text-continue btn"><a href="seller/index.php">Dashboard</a></p>
                                        <p class="text-continue btn"><a href="seller/message.php">Message</a></p>
                                        <p class="text-continue btn"><a href="seller/personal_setting.php">Setting</a></p>
                                        <p class="text-continue btn"><a href="api/controllers/logout.php">Sign Out</a></p>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="block-content dropdown-content" style="display: none;">
                                    <div class="p-2">
                                        <p class="text-continue btn"><a href="buyer/index.php">Dashboard</a></p>
                                        <p class="text-continue btn"><a href="buyer/message.php">Message</a></p>
                                        <p class="text-continue btn"><a href="buyer/personal_setting.php">Setting</a></p>
                                        <p class="text-continue btn"><a href="api/controllers/logout.php">Sign Out</a></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="middle-right col-xl-3 col-lg-2 d-none d-lg-block" style="padding-top: 20px !important;">
                        <div class="my-account">
                            <div class="s-login">
                                <a href="signin.php">
                                    <button class="btn btn-danger btn-lg"><small>Login</small></button>
                                </a>
                                <a href="signup.php">
                                    <button class="btn btn-ouline-warning btn-lg"><small>Register</small></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="header-mobile d-lg-none">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="logo-mobiles">
                        <div class="site-header-logo title-heading" itemscope itemtype="http://schema.org/Organization">

                            <a href="#" itemprop="url" class="site-header-logo-image">
                                <img src="assets/images/logo_120x@3x.png?v=1566553564"
                                     srcset="assets/images/logo_120x@3x.png?v=1566553564"
                                     alt="RT AaShop demo"
                                     itemprop="logo">
                            </a>

                        </div>
                    </div>
                    <div class="group-nav">
                        <div class="group-nav__ico group-nav__search no__at">
                            <div class="btn-search-mobi dropdown-toggle">
                                <i class="fa fa-search" style="font-size: 26px;"></i>
                            </div>
                            <div class="form_search dropdown-content" style="display: none;">
															<form class="formSearch" action="search_result.php" method="get">
                                    <!-- <input type="hidden" name="type" value="product"> -->
                                    <input class="form-control" type="search" name="search" value=""
                                           placeholder="Enter keywords here... " autocomplete="off"/>
                                    <button class="btn btn-search" type="submit"
                                            style="font-size: 12px; font-weight: bold;">
                                        <span class="btnSearchText hidden">GO OJARH</span>
                                        GO OJARH
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="group-nav__ico group-nav__account no__at" style="padding-bottom: 10px !important;">
                            <a class="dropdown-toggle" onclick="call_cart()">
                                <i class="fa fa-cart-plus" style="font-size: 26px;"></i>
                            </a>
                        </div>
                        <div class="group-nav__ico group-nav__cart no__at">
                            <?php if (isset($_SESSION['userid']) && isset($_SESSION['role'])) {
                                ?>
                                <div class="minicart-header">
                                    <a href="<?= BASE_URL ?>cart" class="site-header__carts shopcart dropdown-toggle">
                                        <span class="cart_ico" style="padding-left: 20px;"><img width="42" class="rounded-circle" src="<?= $userClass->readProfilePixController($userDetails->userid); ?>" alt=""></span><br>
                                        <span class="cart_info"><span class="cart-title"><span class="title-cart"><?php echo ucfirst($userDetails->username); ?></span></span></span>
                                    </a>
                                     <?php if($_SESSION['role'] == 'Seller'){ ?>
                                        <div class="block-content dropdown-content" style="display: none;">
                                            <div class="p-2">
                                                <p class="text-continue btn"><a href="seller/index.php">Dashboard</a></p>
                                                <p class="text-continue btn"><a href="seller/message.php">Message</a></p>
                                                <p class="text-continue btn"><a href="seller/setting.php">Setting</a></p>
                                                <p class="text-continue btn"><a href="api/controllers/logout.php">Sign Out</a></p>
                                            </div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="block-content dropdown-content" style="display: none;">
                                            <div class="p-2">
                                                <p class="text-continue btn"><a href="index.php">Dashboard</a></p>
                                                <p class="text-continue btn"><a href="buyer/message.php">Message</a></p>
                                                <p class="text-continue btn"><a href="buyer/setting.php">Setting</a></p>
                                                <p class="text-continue btn"><a href="api/controllers/logout.php">Sign Out</a></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php } else { ?>
                                <div class="my-account">
                                    <div class="s-login">
                                        <a href="signin.php">
                                            <button class="btn btn-outline-success btn-sm">Login</button>
                                        </a>
                                        <a href="signup.php">
                                            <button class="btn btn-ouline-warning btn-sm">Register</button>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="vertical_menu col-xl-2 col-lg-3">
                        <div id="shopify-section-ss-vertical-menu" class="shopify-section">
                            <div class="widget-verticalmenu">
                                <div class="vertical-content">
                                    <div class="navbar-vertical">
                                        <button style="background: rgba(0,0,0,0)" type="button" id="show-verticalmenu"
                                                class="navbar-toggles">
                                            <i class="fa fa-bars"></i>
                                            <span class="title-nav">All Categories</span>
                                        </button>
                                    </div>
                                    <div class="vertical-wrapper" style="background: url(assets/images/no-image-2048-5e88c1b20e087fb7bbe9a3771824e743c244f437e4f8ba93bbf7b11b53f7824c.gif)">
                                        <div class="menu-remove d-block d-lg-none">
                                            <div class="close-vertical"><i class="material-icons">&#xE14C;</i></div>
                                        </div>
                                        <ul class="vertical-group">
                                            <?php $userClass->sub_main_state(); ?>
                                            <li class="last all_cate">
                                                <a href="all_category.php" title="More Categories">More Categories</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-screen d-block d-lg-none">&nbsp;</div>
                        </div>
                    </div>
                    <div class="horizontal_menu col-xl-7 col-lg-8">
                        <div id="shopify-section-ss-mainmenu" class="shopify-section">
                            <div class="main-megamenu">
                                <nav class="main-wrap">
                                    <ul class="main-navigation nav" style="padding-top:10px">
                                        <li class="ss_menu_lv1 menu_item">
                                            <a href="dispute_center.php" title="">
                                                <span class="ss_megamenu_title">Dispute Center</span>
                                            </a>
                                        </li>
                                        <li class="ss_menu_lv1 menu_item">
                                            <a href="market_type.php?type=International" title="">
                                                <span class="ss_megamenu_title">International Market</span>
                                            </a>
                                        </li>
                                        <li class="ss_menu_lv1 menu_item">
                                            <a href="market_type.php?type=Local" title="">
                                                <span class="ss_megamenu_title">Local Market</span>
                                            </a>
                                        </li>
                                        <li class="ss_menu_lv1 menu_item menu_item_drop arrow">
                                            <a href="#" title=""><span class="ss_megamenu_title">Agents</span></a>
                                            <div class="ss_megamenu_dropdown megamenu_dropdown width-custom right">
                                                <ul class="tt-megamenu-submenu">
                                                    <li><a href="all_agents.php"><span style="font-size: 15px;" class="text-danger"><strong>All Agents</strong></span></a></li>
                                                    <li><a data-toggle="modal" data-target=".registerAgent" style="cursor: pointer;"><span style="font-size: 16px;" class="text-danger"><strong>Become and Agents</strong></span></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="bottom3 row d-none d-xl-block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="minicart-header">
                                        <a onclick="call_cart()" style="cursor: pointer;" class="site-header__carts shopcart dropdown-toggle">
                                            <span class="cart_info">
                                                <span class="cart-title" title="Your Wishlist">
                                                  <i class="fa fa-cart-plus fa-2x" style="color: #ffffff !important; padding-top: 5px;"></i>
                                                  <span class="badge badge-success" cart="" style="float: right" id="total_item"></span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="minicart-header">
                                        <a href="<?= BASE_URL ?>blog" class="site-header__carts shopcart dropdown-toggle">
                                            <span class="cart_info">
                                                  <span class="cart-title" title="Our Blog" style="color: #ffffff !important; font-size: 14px !important; padding-top: 10px;">Blog</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="minicart-header">
                                        <a href="contact.php" class="site-header__carts shopcart">
                                            <span class="cart_info">
                                                  <span class="cart-title" title="Contact OJARH.com" style="color: #ffffff !important; font-size: 14px !important; padding-top: 10px;">Contact</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="quick-view"></div>
    <div class="page-container" id="PageContainer">
        <div class="main-content" id="MainContent">
