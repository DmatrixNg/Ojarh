<?php include 'inc/header.php'; ?>

                    <div class="app-inner-layout__wrapper ml-4 mr-4 mb-4">
                        <?php $userClass->bizDetails($userid); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="app-inner-layout__sidebar card">
                                    <ul class="nav flex-column">
                                        <li class="pt-3 pl-3 pr-3 pb-3 nav-item">
                                            <button class="btn-pill btn-shadow btn btn-primary btn-block">Write New Email
                                            </button>
                                        </li>
                                        <li class="nav-item-header nav-item">My Account</li>
                                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i
                                                        class="nav-link-icon pe-7s-chat"> </i><span>Inbox</span>
                                                <div class="ml-auto badge badge-pill badge-info">8</div>
                                            </a></li>
                                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i
                                                        class="nav-link-icon pe-7s-wallet"> </i><span>Sent Items</span></a></li>
                                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i
                                                        class="nav-link-icon pe-7s-config"> </i><span>All Messages</span>
                                                <div class="ml-auto badge badge-success">New</div>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="app-inner-layout__content card pt-4 pl-4 pr-4 pb-4">
                                    <div class="app-inner-layout__top-pane row mb-2">
                                        <div class="pane-left col-md-4">
                                            <div class="mobile-app-menu-btn">
                                                <button type="button" class="hamburger hamburger--elastic">
                                                <span class="hamburger-box">
                                                    <span class="hamburger-inner"></span>
                                                </span>
                                                </button>
                                            </div>
                                            <h4 class="mb-0">Inbox</h4>
                                        </div>
                                        <div class="pane-right col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-search fa-w-16 "></i>
                                                    </div>
                                                </div>
                                                <input placeholder="Search..." type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="bg-white">
                                        <div class="table-responsive">
                                            <table class="text-nowrap table-lg mb-0 table table-hover">
                                                <tbody>
                                                <tr>
                                                    <td class="text-center" style="width: 78px;">
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" id="eCheckbox1"
                                                                   class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                   for="eCheckbox1">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-left pl-1">
                                                        <i class="fa fa-star"></i>
                                                    </td>
                                                    <td>
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    <img width="42" class="rounded-circle"
                                                                         src="assets/images/avatars/1.jpg" alt="">
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Alina Mcloughlin</div>
                                                                    <div class="widget-subheading">Last seen online 15
                                                                        minutes ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-left">Nullam dictum felis eu pede mollis pretium.
                                                    </td>
                                                    <td>
                                                        <i class="fa fa-tags fa-w-20 opacity-4"></i>
                                                    </td>
                                                    <td class="text-right">
                                                        <i class="fa fa-calendar-alt opacity-4 mr-2"></i>
                                                        7 Dec
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>