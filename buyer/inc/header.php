<?php
include('../api/config/Database.php');
include('../api/models/session.php');
if(!isset($_SESSION['role']) || empty($_SESSION['role'])  || $_SESSION['role']!='Buyer')
    {
        session_destroy();
        session_unset();
        header("Location: " . BASE_URL);
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>OJARH.com - Home of wholesalers.</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <link rel="icon" href="../assets/images/logo_120x@3x.png">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="css/main.css" rel="stylesheet">
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/biz.css" rel="stylesheet">
    <link href="css/for_chat.css" rel="stylesheet">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

    <style type="text/css">
        .ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br{
            z-index: 9999 !important;
        }
    </style>
</head>

<body>
<div class="app-container app-theme-gray">
    <div class="app-main">
        <!-- Side nav -->
        <div class="app-sidebar-wrapper">
            <div class="app-sidebar sidebar-shadow"  style="background-image: url('images/dropdown-header/bgg.jpg'); background-size: contain;">
                <div class="app-header__logo">
                    <a href="index.php" data-toggle="tooltip" data-placement="bottom" title="Ojarh Logo"><img
                                src="../assets/images/logo_120x@3x.png" width="70px" height="auto"/></a>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
                <div class="scrollbar-sidebar scrollbar-container mb-5">
                    <div class="dropdown-menu-header">
                        <div class="dropdown-menu-header-inner bg-danger text-center" style="height: 185px !important;">
                            <div class="avatar-icon-wrapper btn-hover-shine mb-2 avatar-icon-xl">
                                <div class="avatar-icon">
                                    <?php $profilepicD = $userClass->readProfilePix($userid); ?>
                                    <!-- <img src="images/avatars/avatar.jpg" width="150" alt="Avatar 6"> -->
                                  </div>
                            </div>
                            <div>
                                <h5 class="menu-header-title"><?php echo ucfirst($userDetails->lname. ' ' .$userDetails->fname); ?></h5>
                                <?php
                                if($userAcctType == "Buyer"){
                                  echo '<h6 class="menu-header-subtitle text-white pb-1">'.ucfirst($userAcctType).'</h6>';
                                  echo '<button class="btn btn-shadow btn-success btn-shadow btn-shine btn-hover-shine btn-sm mt-2">Become a Seller</button>';
                                }
                                ?>

                            </div>
                            <!--<div class="menu-header-image opacity-2" style="background-image: url('images/dropdown-header/city1.jpg');"></div>-->
                        </div>
                    </div>
                    <div class="app-sidebar__inner pt-3">
                        <ul class="vertical-nav-menu">
                            <li class="mm-active"><a href="index.php"><i class="metismenu-icon fa fa-dashboard"></i>Dashboard</a></li>
                            <li class="mm-active"><a href="purchase_history.php"><i class="metismenu-icon fa fa-credit-card"></i>Purchase History</a></li>
                            <li class="mm-active"><a href="favourites.php"><i class="metismenu-icon fa fa-heart"></i>Favourites</a></li>
                            <li class="mm-active"><a href="dispute_center.php"><i class="metismenu-icon fa fa-archive"></i>Dispute</a></li>
                            <li class="mm-active"><a href="message.php"><i class="metismenu-icon fa fa-envelope"></i>Message</a></li>
                            <li class="mm-active"><a href="profile_setting.php"><i class="metismenu-icon fa fa-user"></i>Profile Setting</a></li>
                            <li><a href="#"><i class="metismenu-icon fa fa-retweet"></i>Adverts<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                                <ul>
                                    <li><a href="create_ads.php"><i class="metismenu-icon fa fa-cog"></i>Create Ads</a></li>
                                    <li><a href="ads.php"><i class="metismenu-icon fa fa-cogs"></i>My Ads</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Side nav -->
        <div class="app-sidebar-overlay d-none animated fadeIn"></div>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="header-mobile-wrapper">
                    <div class="app-header__logo">
                        <a href="index.php" data-toggle="tooltip" data-placement="bottom"
                           title="OJARH.com - home of wholesalers." class="logo-src" style="margin-top: -40px !important;">
                           <img src="images/logo-inverse.png" width="70px" height="auto"/>
                         </a>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-sidebar-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                        </button>
                        <div class="app-header__menu">
                          <a href="#" class="mobile-toggle-header-nav avatar-icon">
                              <?php $profilepicD = $userClass->readProfilePix2($userid); ?>
                          </a>
                        </div>
                    </div>
                </div>
                <div class="app-header">
                    <div class="page-title-heading">
                        <?php
                        $witExt = basename($_SERVER['PHP_SELF']);
                        $withoutExt = pathinfo($witExt, PATHINFO_FILENAME);
                        if($withoutExt == 'index'){
                            $withoutExt = "Dashboard";
                        } else if ($withoutExt == 'profile_setting') {
                            $withoutExt = 'Personal Settings';
                        } else if ($withoutExt == 'purchase_history') {
                            $withoutExt = 'Purchase History';
                        } else if ($withoutExt == 'favourites') {
                          $withoutExt = 'Favourites';
                        }else if($withoutExt == 'message'){
                          $withoutExt = 'Message';
                        } else if($withoutExt == 'dispute_center'){
                          $withoutExt = 'Dispute Center';
                        }else if($withoutExt == 'Dispute_details'){
                        $withoutExt = 'Dispute Details';
                        }
                        echo ucfirst($withoutExt);
                        ?>
                    </div>
                    <div class="app-header-right">
                      <div class="search-wrapper">
                        <form class="formSearch" action="<?= BASE_URL ?>/search_result.php" method="get" onsubmit="handle">

                          <i class="search-icon-wrapper pe-7s-search"></i>
                          <input type="search" name="search" id="search" placeholder="Search...">

                        </form>

                        <script>
                        function handle(e){
                          e.preventDefault(); // Otherwise the form will be submitted

                        }
                        </script>
                      </div>
                        <div class="header-btn-lg pr-0">
                            <h5 class="badge badge-info"><?php if($userDetails->role == 'Buyer'){echo 'Buyer\'s Dashboard';} ?></h5>
                        </div>
                        <div class="header-btn-lg pr-0">
                            <div class="header-dots">
                                <div class="dropdown">
                                  <?php
                                  if($userAcctType == "Buyer"){
                                    echo '<a href="#"  data-toggle="modal" data-target="#exampleModal" type="button" class=" btn btn-success text-white btn-sm" style="font-size: 13px !important; width: auto !important; height: 30px; margin-top: 7px;">
                                        <i class="fa fa-arrow-up"></i> Become a Seller
                                    </a>';
                                  } ?>

                                </div>
                                <div class="dropdown">
                                  <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dot-btn-wrapper btn-link">
                                      <i class="dot-btn-icon  text-danger pe-7s-bell"></i>
                                      <div class="badge badge-dot badge-abs badge-dot-sm badge-danger">Danger</div>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true"
                                       class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                      <div class="dropdown-menu-header mb-0">
                                          <div class="dropdown-menu-header-inner bg-danger">
                                              <div class="menu-header-image opacity-5"
                                                   style="background-image: url('images/dropdown-header/city4.jpg');"></div>
                                              <div class="menu-header-content text-light">
                                                  <h5 class="menu-header-title">Notifications</h5>
                                                  <h6 class="menu-header-subtitle">You have <b>0</b> unread messages
                                                  </h6>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="tab-content">
                                          <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                              <div class="scroll-area-sm">
                                                  <div class="scrollbar-container">
                                                      <div class="p-3">
                                                          <div class="notifications-box">
                                                              <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                              <?php $userClass->fetch_notify($userid); ?>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <ul class="nav flex-column">
                                          <li class="nav-item-divider nav-item"></li>
                                          <li class="nav-item-btn text-center nav-item">
                                            
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                               class="p-0 btn avatar-icon">
                                                <?php $profilepicD = $userClass->readProfilePix2($userid); ?>
                                                <i class="pe-7s-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                 class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-danger">
                                                        <div class="menu-header-image opacity-2" style="background-image: url('images/dropdown-header/city1.jpg');"></div>
                                                        <div class="menu-header-content text-left">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3 avatar-icon">
                                                                        <!-- <img width="42" class="rounded-circle"
                                                                             src="images/avatars/avatar.jpg" alt=""> -->
                                                                             <?php $profilepicD = $userClass->readProfilePix2($userid); ?>
                                                                    </div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading"><?php echo $userDetails->username; ?>
                                                                        </div>
                                                                        <div class="widget-subheading opacity-5"><?php echo $userDetails->lname . ' ' . $userDetails->fname; ?></div><div class="widget-subheading opacity-8"><?php if($userDetails->role == 'Buyer'){echo 'Buyer\'s Profile';} ?></div>
                                                                    </div>
                                                                    <div class="widget-content-right mr-2">
                                                                        <button class="btn-pill btn-shadow btn-shine btn-danger btn btn-focus" id="logoutBtn">
                                                                            Logout
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="scroll-area-xs" style="height: 200px;">
                                                    <div class="scrollbar-container ps">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item">
                                                                <a href="../index.php" class="nav-link">Home Store</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="profile_setting.php" class="nav-link">Profile Setting</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="Business_setting.php" class="nav-link">Business Setting</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="message.php" class="nav-link">Messages</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider nav-item">
                                                    </li>
                                                    <li class="nav-item-btn text-center nav-item">
                                                      <?php
                                                      if($userAcctType == "Buyer"){
                                                        echo '<button class="btn-wide btn btn-success btn-sm btn-shadow btn-shine btn-hover-shine">Become a Seller</button>';
                                                      }
                                                      ?>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-header-overlay d-none animated fadeIn"></div>
                </div>
