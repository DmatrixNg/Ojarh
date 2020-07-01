<?php
include('../api/config/Database.php');
include('../api/models/session.php');
?>
<?php include 'inc/header.php'; ?>
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content pt-1">
                            <div class="tab-content">
                                <div class="container-fluid">
                                    <?php
                                        if($acctType->account_type == 'Starter'){
                                            echo '<div class="card-body row">
                                                 <div class="alert alert-danger show col-md-12" role="alert">
                                                    You can do more when you upgrade your account to BASIC &amp; PREMIUM!
                                                    <a href="#"><button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
                                                 </div>
                                             </div>';
                                        }elseif($acctType->account_type == 'Basic'){
                                            echo '<div class="card-body row">
                                                 <div class="alert alert-danger show col-md-12" role="alert">
                                                    You can do more when you upgrade your account to PREMIUM!
                                                    <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
                                                 </div>
                                             </div>';
                                        }
                                     ?>
                                     <?php
                                        if($acctType->account_type == 'Premium' && $userClass->bizDetails($userid) == 'empty'){
                                            echo '<div class="card-body row">
                                                        <div class="alert alert-danger show col-md-12" role="alert">
                                                        You have to update your business information <a href="business_setting.php"><button class="btn btn-info btn-sm">Update business profile</button></a>
                                                        </div>
                                                    </div>';
                                        }else{

                                        }
                                    ?>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card-shadow-primary profile-responsive card-border card">
                                                <?php if($userClass->bizDetails($userid) == 'empty'){ ?>
                                                    <div class="dropdown-menu-header" style="height: 270px !important; margin-top: -20px !important;">
                                                        <div class="front-side">
                                                            <div class="color-grid">
                                                                <div class="black"></div>
                                                                <div class="red1"></div>
                                                                <div class="red2"></div>
                                                                <div class="green"></div>
                                                            </div>
                                                            <div class="info-grid">
                                                                <div class="name">
                                                                    <h2>YOUR NAME</h2>
                                                                    <h5>CREATIVE GRAPHIC DESIGNER</h5>
                                                                </div>
                                                                <div class="addr">
                                                                    <i class="fa fa-map fa-2x mb-2"></i>
                                                                    <p>1/2 Street,
                                                                        <strong> City</strong>, State,
                                                                        <strong> Country</strong>
                                                                    </p>
                                                                </div>
                                                                <div class="phoneNo">
                                                                    <i class="fa fa-phone fa-2x mb-2"></i>
                                                                    <p>+000
                                                                        <strong>1234</strong> 4567 7896</p>
                                                                </div>
                                                                <div class="emailId mb-2">
                                                                    <i class="fa fa-laptop fa-2x mb-2"></i>
                                                                    <p class="email">yourusername@
                                                                        <strong>email</strong>.com</p>
                                                                    <p class="web">
                                                                        <strong>www</strong>.yourwebsite.
                                                                        <strong>com</strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="dropdown-menu-header" style="height: 270px !important; margin-top: -20px !important;">
                                                        <div class="front-side">
                                                            <div class="color-grid">
                                                                <div class="black"></div>
                                                                <div class="red1"></div>
                                                                <div class="red2"></div>
                                                                <div class="green"></div>
                                                            </div>
                                                            <div class="info-grid">
                                                                <div class="name">
                                                                    <h5><?php echo ucfirst($userDetails->fname).' '.ucfirst($userDetails->lname); ?></h5>
                                                                    <h5><?php echo strtoupper($bizdata->bizname); ?></h5>
                                                                </div>
                                                                <div class="addr">
                                                                    <i class="fa fa-map fa-2x mb-2"></i>
                                                                    <p style="width: 130px;"><?php echo $bizdata->bizaddress; ?>,<br>
                                                                    </p>
                                                                </div>
                                                                <div class="phoneNo">
                                                                    <i class="fa fa-phone fa-2x mb-2"></i>
                                                                    <p><strong><?php echo $bizdata->bizphone; ?></strong></p>
                                                                    <p><strong><?php echo $userDetails->phone; ?></strong></p>
                                                                </div>
                                                                <div class="emailId mb-2">
                                                                    <i class="fa fa-laptop fa-2x mb-2"></i>
                                                                    <p class="email"><strong><?php echo $bizdata->bizemail; ?></strong></p>
                                                                    <p class="web">
                                                                        <strong><?php echo $bizdata->bizwebsite; ?></strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <ul class="list-group list-group-flush">
                                                    <li class="p-0 list-group-item">
                                                        <div class="grid-menu grid-menu-2col">
                                                            <div class="no-gutters row">
                                                                <div class="col-sm-6">
                                                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" id="profileSet">
                                                                        <i class="fa fa-user-plus btn-icon-wrapper btn-icon-lg mb-3"> </i> Business Information
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" id="returnPolicy">
                                                                        <i class="fa fa-map btn-icon-wrapper btn-icon-lg mb-3"> </i> T&C
                                                                        for Return Policy
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" id="disclaimer">
                                                                        <i class="fa fa-cogs btn-icon-wrapper btn-icon-lg mb-3"> </i> Disclaimer
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" id="timeDelivery">
                                                                        <i class="fa fa-clock btn-icon-wrapper btn-icon-lg mb-3"> </i> Time
                                                                        & Delivery
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" id="storepic">
                                                                        <i class="fa fa-image btn-icon-wrapper btn-icon-lg mb-3"> </i> Store Picture
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" id="storevid">
                                                                        <i class="fa fa-play btn-icon-wrapper btn-icon-lg mb-3"> </i> Store Video
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-shadow-primary profile-responsive card-border card p-4">
                                                <div class="position-relative form-group">
                                                    <div>
                                                        <h5 class="text-danger">Business Card privacy</h4>
                                                        <div class="divider"></div>
                                                        <div class="custom-radio custom-control custom-control-inline">
                                                            <input type="radio" id="privacy" name="customRadio" class="custom-control-input" <?php if(@$bizdata->privacy == "private") {echo "Checked";}?>>
                                                            <label class="custom-control-label" for="privacy" >Private</label>
                                                        </div>
                                                        <div class="custom-radio custom-control custom-control-inline">
                                                            <input type="radio" id="privacy2" name="customRadio" class="custom-control-input" <?php if(@$bizdata->privacy == "public") {echo "Checked";}?>>
                                                            <label class="custom-control-label" for="privacy2">Public</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-8">
                                            <div class="main-card mb-3 card">
                                                <?php if(isset($_GET['result'])){ ?>
                                                <div class="b-radius-0 card-header">
                                                    <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                        <span class="form-heading"><?php echo $_GET['result']; ?></span>
                                                    </button>
                                                </div>
                                                <?php } ?>
                                                <?php if($userClass->bizDetails($userid) == 'empty'){ ?>
                                                <div id="pfBody" class="card-body">
                                                    <div class="forms-wizard-vertical">
                                                        <div class="card-body">
                                                            <h3>Business Information</h3>
                                                            <div class="divider"></div>
                                                            <div id="messer"></div>
                                                            <div class="form-group">
                                                                <label for="exampleEmail5">Business Name</label>
                                                                <input type="text" id="bizname" name="bizname" class="form-control">
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Business Phone Number</label>
                                                                    <input type="number" id="bizphone" name="bizphone" class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleEmail5">Business Email</label>
                                                                    <input type="email" id="bizemail" name="bizemail" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label>Company registration date</label>
                                                                    <input type="text" id="bizregdate" name="bizregdate" class="form-control"
                                                                   data-toggle="datepicker"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label>Service</label>
                                                                    <input type="text" id="service" name="service" class="form-control"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label for="exampleEmail5">Business State Locations</label>
                                                                    <select multiple="multiple" name="bizstate" id="bizstate" class="multiselect-dropdown form-control">
                                                                        <option value="Abia" label="Abia">Abia</option>
                                                                        <option value="Abuja" label="Abuja">Abuja</option>
                                                                        <option value="Adamawa" label="Adamawa">Adamawa</option>
                                                                        <option value="Akwa Ibom" label="Akwa Ibom">Akwa Ibom</option>
                                                                        <option value="Anambra" label="Anambra">Anambra</option>
                                                                        <option value="Bauchi" label="Bauchi">Bauchi</option>
                                                                        <option value="Bayelsa" label="Bayelsa">Bayelsa</option>
                                                                        <option value="Benue" label="Benue">Benue</option>
                                                                        <option value="Borno" label="Borno">Borno</option>
                                                                        <option value="Cross River" label="Cross River">Cross River</option>
                                                                        <option value="Delta" label="Delta">Delta</option>
                                                                        <option value="Ebonyi" label="Ebonyi">Ebonyi</option>
                                                                        <option value="Edo" label="Edo">Edo</option>
                                                                        <option value="Ekiti" label="Ekiti">Ekiti</option>
                                                                        <option value="Enugu" label="Enugu">Enugu</option>
                                                                        <option value="Gombe" label="Gombe">Gombe</option>
                                                                        <option value="Imo" label="Imo">Imo</option>
                                                                        <option value="Jigawa" label="Jigawa">Jigawa</option>
                                                                        <option value="Kaduna" label="Kaduna">Kaduna</option>
                                                                        <option value="Kano" label="Kano">Kano</option>
                                                                        <option value="Katsina" label="Katsina">Katsina</option>
                                                                        <option value="Kebbi" label="Kebbi">Kebbi</option>
                                                                        <option value="Kogi" label="Kogi">Kogi</option>
                                                                        <option value="Kwara" label="Kwara">Kwara</option>
                                                                        <option value="Lagos" label="Lagos">Lagos</option>
                                                                        <option value="Nasarawa" label="Nasarawa">Nasarawa</option>
                                                                        <option value="Niger" label="Niger">Niger</option>
                                                                        <option value="Ogun" label="Ogun">Ogun</option>
                                                                        <option value="Ondo" label="Ondo">Ondo</option>
                                                                        <option value="Osun" label="Osun">Osun</option>
                                                                        <option value="Oyo" label="Oyo">Oyo</option>
                                                                        <option value="Plateau" label="Plateau">Plateau</option>
                                                                        <option value="Rivers" label="Rivers">Rivers</option>
                                                                        <option value="Sokoto" label="Sokoto">Sokoto</option>
                                                                        <option value="Taraba" label="Taraba">Taraba</option>
                                                                        <option value="Yobe" label="Yobe">Yobe</option>
                                                                        <option value="Zamfara" label="Zamfara">Zamfara</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label for="exampleEmail5">Markets</label>
                                                                    <select multiple="multiple" class="multiselect-dropdown form-control" name="bizmarket" id="bizmarket" required="required">
                                                                        <?php $userClass->market_dropdown_list(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleEmail5">Business Address</label>
                                                                <textarea class="form-control" rows="3" name="bizaddress" id="bizaddress"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleEmail5">Business Website</label>
                                                                <input type="text" id="bizwebsite" name="bizwebsite" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="clearfix">
                                                        <button type="button" id="updatebizbtn"
                                                                class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php }elseif($bizdata->status == 'Updated'){ ?>
                                                    <div id="pfBody" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>Business Information</h3>
                                                                <div class="divider"></div>
                                                                <div id="messer"></div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Business Name</label>
                                                                    <input type="text" id="bizname" name="bizname"
                                                                           value="<?php echo @$bizdata->bizname; ?>"
                                                                           class="form-control" disabled>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <label for="exampleEmail5">Business Phone Number</label>
                                                                        <input type="number" id="bizphone" name="bizphone"
                                                                           value="<?php echo @$bizdata->bizphone; ?>"
                                                                           class="form-control" disabled>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="exampleEmail5">Business Email</label>
                                                                        <input type="email" id="bizemail" name="bizemail"
                                                                           value="<?php echo @$bizdata->bizemail; ?>"
                                                                           class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label>Company registration date</label>
                                                                        <input type="text" id="bizregdate" name="bizregdate" class="form-control"
                                                                       data-toggle="datepicker" value="<?php echo @$bizdata->bizregdate; ?>" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label>Service</label>
                                                                        <input type="text" id="service" value="<?php echo @$bizdata->service; ?>" name="service" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Business State Locations</label>
                                                                        <select multiple="multiple" name="bizstate" id="bizstate" class="multiselect-dropdown form-control" disabled>
                                                                            <?php
                                                                                $bizstates = json_decode($bizdata->bizstate);
                                                                                foreach ($bizstates as $bizstate) {
                                                                                    echo '<option selected="selected">'.$bizstate.'</option>';
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Markets</label>
                                                                        <select multiple="multiple" class="multiselect-dropdown form-control" name="bizmarket" id="bizmarket" required="required" disabled>
                                                                            <option selected>
                                                                                <?php
                                                                                    $bizmarks =  json_decode($bizdata->bizmarket);
                                                                                    foreach ($bizmarks as $bizmark)  {
                                                                                        echo '<option selected="selected">'.$bizmark.'</option>';
                                                                                    }
                                                                                ?>

                                                                            </option>
                                                                            <?php $userClass->market_dropdown_list(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Business Address</label>
                                                                    <textarea class="form-control" rows="3" name="bizaddress" id="bizaddress" disabled><?php echo @$bizdata->bizaddress; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Business Website</label>
                                                                    <input type="text" id="bizwebsite" name="bizwebsite"
                                                                           value="<?php echo @$bizdata->bizwebsite; ?>"
                                                                           class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div class="clearfix">
                                                            <button type="button" id="updatebizbtn"
                                                                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php }elseif($bizdata->status == 'Updateable'){?>
                                                    <div id="pfBody" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>Business Information</h3>
                                                                <div class="divider"></div>
                                                                <div id="messer"></div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Business Name</label>
                                                                    <input type="text" id="bizname" name="bizname"
                                                                           value="<?php echo @$bizdata->bizname; ?>"
                                                                           class="form-control">
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <label for="exampleEmail5">Business Phone Number</label>
                                                                        <input type="number" id="bizphone" name="bizphone"
                                                                           value="<?php echo @$bizdata->bizphone; ?>"
                                                                           class="form-control">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="exampleEmail5">Business Email</label>
                                                                        <input type="email" id="bizemail" name="bizemail"
                                                                           value="<?php echo @$bizdata->bizemail; ?>"
                                                                           class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label>Company registration date</label>
                                                                        <input type="text" id="bizregdate" name="bizregdate" class="form-control"
                                                                       data-toggle="datepicker" value="<?php echo @$bizdata->bizregdate; ?>"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label>Service</label>
                                                                        <input type="text" id="service" value="<?php echo @$bizdata->service; ?>" name="service" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Business State Locations</label>
                                                                        <select multiple="multiple" name="bizstate" id="bizstate" class="multiselect-dropdown form-control">
                                                                            <?php
                                                                                $bizstates = json_decode($bizdata->bizstate);
                                                                                foreach ($bizstates as $bizstate) {
                                                                                    echo '<option selected="selected">'.$bizstate.'</option>';
                                                                                }
                                                                            ?>
                                                                            <option value="Abia" label="Abia">Abia</option>
                                                                            <option value="Abuja" label="Abuja">Abuja</option>
                                                                            <option value="Adamawa" label="Adamawa">Adamawa</option>
                                                                            <option value="Akwa Ibom" label="Akwa Ibom">Akwa Ibom</option>
                                                                            <option value="Anambra" label="Anambra">Anambra</option>
                                                                            <option value="Bauchi" label="Bauchi">Bauchi</option>
                                                                            <option value="Bayelsa" label="Bayelsa">Bayelsa</option>
                                                                            <option value="Benue" label="Benue">Benue</option>
                                                                            <option value="Borno" label="Borno">Borno</option>
                                                                            <option value="Cross River" label="Cross River">Cross River</option>
                                                                            <option value="Delta" label="Delta">Delta</option>
                                                                            <option value="Ebonyi" label="Ebonyi">Ebonyi</option>
                                                                            <option value="Edo" label="Edo">Edo</option>
                                                                            <option value="Ekiti" label="Ekiti">Ekiti</option>
                                                                            <option value="Enugu" label="Enugu">Enugu</option>
                                                                            <option value="Gombe" label="Gombe">Gombe</option>
                                                                            <option value="Imo" label="Imo">Imo</option>
                                                                            <option value="Jigawa" label="Jigawa">Jigawa</option>
                                                                            <option value="Kaduna" label="Kaduna">Kaduna</option>
                                                                            <option value="Kano" label="Kano">Kano</option>
                                                                            <option value="Katsina" label="Katsina">Katsina</option>
                                                                            <option value="Kebbi" label="Kebbi">Kebbi</option>
                                                                            <option value="Kogi" label="Kogi">Kogi</option>
                                                                            <option value="Kwara" label="Kwara">Kwara</option>
                                                                            <option value="Lagos" label="Lagos">Lagos</option>
                                                                            <option value="Nasarawa" label="Nasarawa">Nasarawa</option>
                                                                            <option value="Niger" label="Niger">Niger</option>
                                                                            <option value="Ogun" label="Ogun">Ogun</option>
                                                                            <option value="Ondo" label="Ondo">Ondo</option>
                                                                            <option value="Osun" label="Osun">Osun</option>
                                                                            <option value="Oyo" label="Oyo">Oyo</option>
                                                                            <option value="Plateau" label="Plateau">Plateau</option>
                                                                            <option value="Rivers" label="Rivers">Rivers</option>
                                                                            <option value="Sokoto" label="Sokoto">Sokoto</option>
                                                                            <option value="Taraba" label="Taraba">Taraba</option>
                                                                            <option value="Yobe" label="Yobe">Yobe</option>
                                                                            <option value="Zamfara" label="Zamfara">Zamfara</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Markets</label>
                                                                        <select multiple="multiple" class="multiselect-dropdown form-control" name="bizmarket" id="bizmarket" required="required">
                                                                            <option selected>
                                                                                <?php
                                                                                    $bizmarks =  json_decode($bizdata->bizmarket);
                                                                                    foreach ($bizmarks as $bizmark)  {
                                                                                        echo '<option selected="selected">'.$bizmark.'</option>';
                                                                                    }
                                                                                ?></option>
                                                                            <?php $userClass->market_dropdown_list(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Business Address</label>
                                                                    <textarea class="form-control" rows="3" name="bizaddress" id="bizaddress"><?php echo @$bizdata->bizaddress; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Business Website</label>
                                                                    <input type="text" id="bizwebsite" name="bizwebsite"
                                                                           value="<?php echo @$bizdata->bizwebsite; ?>"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div class="clearfix">
                                                            <button type="button" id="updatebizbtn"
                                                                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                    <div id="rpBody" style="display: none;" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>T&C for Return Policy</h3>
                                                                <div class="divider"></div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Paste/Type your return policy here:</label>
                                                                    <textarea id="return_policy" name="return_policy" class="form-control" rows="10"><?php echo @$bizdata->returnpolicy; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div id="messPolicy"></div>
                                                        <div class="clearfix">
                                                            <button type="button" id="updatePolicy"
                                                                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                Update Policy
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div id="dBody" style="display: none;" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>Disclaimer</h3>
                                                                <div class="divider"></div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Paste/Type your Disclaimer here:</label>
                                                                    <textarea id="sellerdisclaimer" name="sellerdisclaimer" class="form-control" rows="10"><?php echo $bizdata->disclaimer; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div id="messDisclaimer"></div>
                                                        <div class="clearfix">
                                                            <button type="button" id="updateDisclaimer"
                                                                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                Update Disclaimer
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div id="tdBody" style="display: none;" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>Time &amp; Delivery</h3>
                                                                <div class="divider"></div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Paste/Type your time &amp; delivery here:</label>
                                                                    <textarea id="time_delivery" name="time_delivery" class="form-control" rows="10"><?php echo $bizdata->timedelivery; ?></textarea>
                                                                </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div class="clearfix">
                                                            <div id="messDelivery"></div>
                                                            <button type="button" id="updateDelivery"
                                                                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                Update Time &amp; Delivery
                                                            </button>
                                                        </div>
                                                    </div>
                                                    </div>

                                                <?php //print_r(($bizdata)); ?>
                                                <?php if(empty($bizdata->storeimage) || $bizdata->storeimage == ''){ ?>
                                                    <div id="storepicture" style="display: none;" class="card-body">
                                                        <form action="../api/controllers/add_storeimg.php" method="POST" enctype="multipart/form-data">
                                                            <div class="forms-wizard-vertical">
                                                                <div class="card-body">
                                                                    <h3>Upload Store Images</h3>
                                                                    <div class="divider"></div>
                                                                    <div class="position-relative form-group"  id="container3">
                                                                        <div class="row">
                                                                            <label for="exampleEmail4">Upload Store images
                                                                                <button class="btn btn-danger btn-sm" id="addImgFiles" type="button"><i class="fa fa-plus"></i></button>
                                                                            </label>
                                                                            <input type="file" name="productimg0" id="productimg0" class="form-control col-md-11">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="divider"></div>
                                                            <div class="clearfix">
                                                              <?php if (empty($bizdata)): ?>
                                                                here
                                                                <a href="#profileSet" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                    Business Not Set.
                                                                </a>
                                                              <?php endif; ?>
                                                                <button type="submit" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                    Upload
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div id="storepicture" style="display: none;" class="card-body">
                                                        <div class="row">
                                                            <?php
                                                                $storeimgs = json_decode($bizdata->storeimage);
                                                                // print_r($bizdata);
                                                                foreach ($storeimgs as $storeimg) {
                                                                  if ($storeimg !=="") {?>


                                                                    <div id="image-<?php echo $bizdata->id; ?>" class="col-md-6 text-center pb-3">
                                                                      <img class="d-block w-100" src="<?php echo 'storepicture/'.$userid.'/'.$storeimg; ?>" alt="Third slide">
                                                                      <button type="button" image="<?php echo $storeimg; ?>" onclick='remove_image("<?php echo $storeimg; ?>","<?php echo $bizdata->id; ?>")' class="btn btn-danger btn-sm mt-2">Remove</button>

                                                                    </div>

                                                            <?php    }else {

                                                            }  }
                                                            ?>
                                                        </div>

                                                        <div class="divider"></div>

                                                    </div>
                                                <?php } ?>
                                                <?php if(empty($bizdata->videolink) || $bizdata->videolink == ''){ ?>
                                                    <div id="storevideo" style="display: none;" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>Time &amp; Delivery</h3>
                                                                <div class="divider"></div>
                                                                <div class="form-group">
                                                                    <label for="exampleEmail5">Paste youtube link of the video of your store here:</label>
                                                                    <input type="text" id="videolink" name="videolink" class="form-control" placeholder="e.g: https://youtube.com/id8he38nhadk" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="divider"></div>
                                                        <div id="messVideo"></div>
                                                        <div class="clearfix">
                                                            <button type="button" id="videolinkBtn"
                                                                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                Add Video
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div id="storevideo" style="display: none;" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <?php //echo html_entity_decode($bizdata->videolink); ?>
                                                                <div class="embed-responsive embed-responsive-16by9">
                                                                  <iframe class="embed-responsive-item" src="<?php echo html_entity_decode($bizdata->videolink); ?>" allowfullscreen></iframe>
                                                                </div>

                                                              </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#updatebizbtn').on('click', function(){
            document.getElementById('updatebizbtn').innerHTML = "Updating...";
            document.getElementById('updatebizbtn').disabled = true;
            // alert('yes');
            // return;
            if ($("#bizname").val() !== "" && $("#bizphone").val() !== "" && $("#bizemail").val() !== "" && $("#bizregdate").val() !== "" && $("#bizstate").val() !== "" && $("#bizmarket").val() !== "" && $("#bizaddress").val() !== "" && $("#service").val() !== "") {
                $.ajax({
                    type: 'POST',
                    url: '../api/controllers/create_bizinfo.php',
                    data: {
                        bizname : $("#bizname").val(),
                        bizphone : $("#bizphone").val(),
                        bizemail : $("#bizemail").val(),
                        bizregdate : $('#bizregdate').val(),
                        bizstate : $("#bizstate").val(),
                        bizmarket : $("#bizmarket").val(),
                        service : $("#service").val(),
                        bizaddress : $("#bizaddress").val(),
                        bizwebsite : $("#bizwebsite").val()
                    },
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        // alert(response);
                        console.log(response);
                        // return;
                        if(response == 'success'){
                            document.getElementById('updatebizbtn').innerHTML = 'Update Info';
                            document.getElementById('updatebizbtn').disabled = false;
                             document.getElementById('messer').innerHTML = '<p class="alert alert-success">Update successful!</p>';
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else if(response == 'exist'){
                             document.getElementById('updatebizbtn').innerHTML = 'Update Info';
                             document.getElementById('messer').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update your business details!</p>';
                            document.getElementById('updatebizbtn').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else{
                             document.getElementById('updatebizbtn').innerHTML = 'Update Info';
                             document.getElementById('messer').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
                            document.getElementById('updatebizbtn').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }
                    }
                });
                event.preventDefault();

            } else {
                document.getElementById('messer').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
                document.getElementById('updatebizbtn').innerHTML = "Retry";
                document.getElementById('updatebizbtn').disabled = false;
            }
        });

        $('#updatePolicy').on('click', function(){
            document.getElementById('updatePolicy').innerHTML = "Updating...";
            document.getElementById('updatePolicy').disabled = true;

            if($('return_policy').val() != ''){
                $.ajax({
                    type: 'POST',
                    url: '../api/controllers/update_policy.php',
                    data: {
                        return_policy : $("#return_policy").val()
                    },
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        // alert(response);
                        console.log(response);
                        // return;
                        if(response == 'success'){
                            document.getElementById('updatePolicy').innerHTML = 'Successful...';
                            document.getElementById('updatePolicy').disabled = false;
                             document.getElementById('messPolicy').innerHTML = '<p class="alert alert-success">Update successful!</p>';
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else if(response == 'exist'){
                             document.getElementById('updatePolicy').innerHTML = 'Update Policy';
                             document.getElementById('messPolicy').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update your business details!</p>';
                            document.getElementById('updatePolicy').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else{
                             document.getElementById('updatePolicy').innerHTML = 'Update Policy';
                             document.getElementById('messPolicy').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
                            document.getElementById('updatePolicy').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }
                    }
                });
                event.preventDefault();
            }else{
                document.getElementById('messPolicy').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
                document.getElementById('updatePolicy').innerHTML = "Retry";
                document.getElementById('updatePolicy').disabled = false;
            }
        });

        $('#updateDisclaimer').on('click', function(){
            document.getElementById('updateDisclaimer').innerHTML = "Updating...";
            document.getElementById('updateDisclaimer').disabled = true;

            if($('sellerdisclaimer').val() != ''){
                $.ajax({
                    type: 'POST',
                    url: '../api/controllers/update_disclaimer.php',
                    data: {
                        sellerdisclaimer : $("#sellerdisclaimer").val()
                    },
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        // alert(response);
                        console.log(response);
                        // return;
                        if(response == 'success'){
                            document.getElementById('updateDisclaimer').innerHTML = 'Successful...';
                            document.getElementById('updateDisclaimer').disabled = false;
                             document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-success">Update successful!</p>';
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else if(response == 'exist'){
                             document.getElementById('updateDisclaimer').innerHTML = 'Update Policy';
                             document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update this details!</p>';
                            document.getElementById('updateDisclaimer').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else{
                             document.getElementById('updateDisclaimer').innerHTML = 'Update Policy';
                             document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
                            document.getElementById('updateDisclaimer').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }
                    }
                });
                event.preventDefault();
            }else{
                document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
                document.getElementById('updateDisclaimer').innerHTML = "Retry";
                document.getElementById('updateDisclaimer').disabled = false;
            }
        });

        $('#updateDelivery').on('click', function(){
            document.getElementById('updateDelivery').innerHTML = "Updating...";
            document.getElementById('updateDelivery').disabled = true;

            if($('time_delivery').val() != ''){
                $.ajax({
                    type: 'POST',
                    url: '../api/controllers/update_timedelivery.php',
                    data: {
                        time_delivery : $("#time_delivery").val()
                    },
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        // alert(response);
                        console.log(response);
                        // return;
                        if(response == 'success'){
                            document.getElementById('updateDelivery').innerHTML = 'Successful...';
                            document.getElementById('updateDelivery').disabled = true;
                             document.getElementById('messDelivery').innerHTML = '<p class="alert alert-success">Update successful!</p>';
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else if(response == 'exist'){
                             document.getElementById('updateDelivery').innerHTML = 'Update Policy';
                             document.getElementById('messDelivery').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update this details!</p>';
                            document.getElementById('updateDelivery').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else{
                             document.getElementById('updateDelivery').innerHTML = 'Update Policy';
                             document.getElementById('messDelivery').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
                            document.getElementById('updateDelivery').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }
                    }
                });
                event.preventDefault();
            }else{
                document.getElementById('messDelivery').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
                document.getElementById('updateDelivery').innerHTML = "Retry";
                document.getElementById('updateDelivery').disabled = false;
            }
        });

        $('#videolinkBtn').on('click', function(){
            document.getElementById('videolinkBtn').innerHTML = "Updating...";
            document.getElementById('videolinkBtn').disabled = true;

            if($('videolink').val() != ''){
                $.ajax({
                    type: 'POST',
                    url: '../api/controllers/update_videolink.php',
                    data: {
                        videolink : $("#videolink").val()
                    },
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        // alert(response);
                        console.log(response);
                        // return;
                        if(response == 'success'){
                            document.getElementById('videolinkBtn').innerHTML = 'Successful...';
                            document.getElementById('videolinkBtn').disabled = true;
                             document.getElementById('messVideo').innerHTML = '<p class="alert alert-success">Update successful!</p>';
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else if(response == 'exist'){
                             document.getElementById('videolinkBtn').innerHTML = 'Update Policy';
                             document.getElementById('messVideo').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update this details!</p>';
                            document.getElementById('videolinkBtn').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }else{
                             document.getElementById('videolinkBtn').innerHTML = 'Update Policy';
                             document.getElementById('messVideo').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
                            document.getElementById('videolinkBtn').disabled = false;
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                            return false;
                        }
                    }
                });
                event.preventDefault();
            }else{
                document.getElementById('messVideo').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
                document.getElementById('videolinkBtn').innerHTML = "Retry";
                document.getElementById('videolinkBtn').disabled = false;
            }
        });

    });
</script>

<script type="text/javascript">
    var prv_val,f_val;
    $('#bizstate').change(function() {
      var new_val = $(this).val();
      if(new_val != ""){
        prv_val = $('#state_selected').val();
        if(prv_val != ""){
          f_val = prv_val + "," + new_val;
        }
        else {
          f_val = new_val;
        }
        $('#state_selected').val(f_val);
      }
    });

    var prv_val2,f_val2;
    $('#bizmarket').change(function() {
      var new_val2 = $(this).val();
      if(new_val2 != ""){
        prv_val2 = $('#selected_market').val();
        if(prv_val2 != ""){
          f_val2 = prv_val2 + "," + new_val2;
        }
        else {
          f_val2 = new_val2;
        }
        $('#selected_market').val(f_val2);
      }
    });

  function remove_image(image, id) {

        $.ajax({
            type: 'POST',
            url: '../api/controllers/remove_store_image.php',
            data: {
                image : image,
                id : id
                },
            cache: false,
            dataType: 'text',
            success: function (response) {
              $('#image-'+id).hide();

          }

        });
        event.preventDefault();

};
</script>
