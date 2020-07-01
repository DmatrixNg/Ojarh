<php>

    <div class="row">
        <div class="col-md-3">
            <div class="app-inner-layout__sidebar card">

                <ul class="nav flex-column">
                    <li class="pt-3 pl-3 pr-3 pb-3 nav-item">
                        <button onclick="getview('create')" class="btn-pill btn-shadow btn btn-primary btn-block">Write New Email
                        </button>
                    </li>
                    <li class="nav-item-header nav-item">My Account</li>
                    <li class="nav-item"><a href="javascript:getview('inbox');" class="nav-link"><i
                                class="nav-link-icon pe-7s-chat"> </i><span>Inbox</span>
                            <div class="ml-auto badge badge-pill badge-info"><?php $ss = 'inbox'; echo $userClass->message_count($_SESSION['userid'], $ss); ?></div>
                        </a></li>
                    <li class="nav-item"><a href="javascript:getview('sent');" class="nav-link"><i
                                class="nav-link-icon pe-7s-wallet"> </i><span>Sent Items</span></a></li>
                    <li class="pt-3 pl-3 pr-3 pb-3 nav-item">
                        <!-- <button class="btn-pill btn-shadow btn btn-danger open-button" onclick="openForm(this.id)" id="<?php echo $userid; ?>" ><i class="fa fa-comment"></i>
                                                    </button> -->
                        <?php  if ($_SESSION['role'] =="buyer "): ?>
                        <button class="btn btn-danger open-button" onclick="openForm(this.id)" id="<?php echo $userid; ?>" style="z-index:9"><i class="fa fa-comment"></i></button>
                        <?php endif; ?>
                    </li>
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

                            <ul class="nav flex-column">
                                <li class="pt-3 pl-3 pr-3 pb-3 nav-item">
                                    <button onclick="getview('create')" class="btn-pill btn-shadow btn btn-primary btn-block">Write New Email
                                    </button>
                                </li>
                                <li class="nav-item-header nav-item">My Account</li>
                                <li class="nav-item"><a href="javascript:getview('inbox');" class="nav-link"><i
                                            class="nav-link-icon pe-7s-chat"> </i><span>Inbox</span>
                                        <div class="ml-auto badge badge-pill badge-info"><?php $ss = 'inbox'; echo $userClass->message_count($_SESSION['userid'], $ss); ?></div>
                                    </a></li>
                                <li class="nav-item"><a href="javascript:getview('sent');" class="nav-link"><i
                                            class="nav-link-icon pe-7s-wallet"> </i><span>Sent Items</span></a></li>
                                <li class="pt-3 pl-3 pr-3 pb-3 nav-item">
                                    <!-- <button class="btn-pill btn-shadow btn btn-danger open-button" onclick="openForm(this.id)" id="<?php echo $userid; ?>" ><i class="fa fa-comment"></i>
                                                                      </button> -->
                                    <button class="btn btn-danger open-button" onclick="openForm(this.id)" id="<?php echo $userid; ?>" style="z-index:9"><i class="fa fa-comment"></i></button>
                                </li>
                            </ul>
                        </div>
                        <h4 id="viewTitle" class="mb-0">Inbox</h4>
                    </div>

                </div>
                <div id="view"></div>
            </div>
        </div>
    </div>
</php>