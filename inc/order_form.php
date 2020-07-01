<div class="section-content pt-5"
     style="background-image: url(assets/images/bg_overlay.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="container">
        <div class="wraper-inner">
            <div class="row">
                <div class="col-12 col-md-12 bg-white mb-5">
                    <div class="formaccount formlogin">
                            <input type="hidden" name="form_type" value="create_customer"/>
                            <input type="hidden" name="utf8" value="✓"/>
                            <h1 class="page-title" style="color:  #C60219 !important;">Quick Order Form</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="FirstName">Seller's ID</label>
                                            <select class="form-control" id="seller" name="seller"  required>
                                                <option value="">Choose...</option>
                                                <?php $userClass->seller_dropdown_list(); ?>
                                            </select>                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md -6">
                                            <label for="FirstName">Select Product Category</label>
                                            <select class="form-control" id="seller_catalogue" name="quick_category" onchange="fetch_product_list()">
                                                <option value="">-- Select Category --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="FirstName">Select Product</label>
                                            <select class="form-control" id="quick_product_list" name="quick_product_list">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="FirstName">Quantity</label>
                                            <input class="form-control" type="number" name="q_quantity" id="q_quantity" class=""
                                                   autocorrect="off" autocapitalize="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="LastName">Full Name</label>
                                        <input class="form-control" type="text" name="q_fullname" id="q_fullname">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="Email">Email</label>
                                            <input class="form-control" type="email" name="q_email" id="q_email" class=""
                                                   autocorrect="off" autocapitalize="off">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Email">Phone Number</label>
                                            <input class="form-control" type="number" name="q_phone" id="q_phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="LastName">Delivery Address:</label>
                                        <input class="form-control" type="text" name="q_delivery" id="q_delivery">
                                    </div>
                                    <div class="form-group">
                                        <label for="CreatePassword">Additional Message</label>
                                        <textarea id="q_message" name="q_message" rows="3" class="form-control"></textarea>
                                    </div>
                                    <p class="text-center cr_acc">
                                        <button type="button" id="placeqorderBtn" onclick="place_quick_order()" class="btn btn-danger btn-lg">Place Order</button>
                                    </p>
                                </div>
                                <div class="col-md-6" id="alert"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
