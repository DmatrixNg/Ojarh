</div>
<div class="app-wrapper-footer">
    <div class="app-footer">
        <div class="">
            <div class="app-footer__inner">
                <div class="app-footer-left">
                    <div class="footer-dots">
                        <div class="" style="font-size: 11px; color: #999999;">Copyright © <?php echo date('Y'); ?> OJARH.com - All rights
                            reserved. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<!-- dispute form -->
<div class="modal fade" id="disputeform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <form action="<?= BASE_URL ?>api/controllers/dispute_resolution.php" method="POST" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dispute Resolution Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 text-danger">Please be careful of the report you provide. If information are found false, it might result to total ban/blacklisting on this platform.</p>
                <hr>
                <div class="position-relative form-group">
                  <label class="mb-0">Complain Type:</label>
                  <select class="form-control planner" name="subject" id="subject" required>
                    <option value="Service Failure">Service Failure</option>
                    <option value="Refund">Refund</option>
                    <option value="Failed Payment">Failed Payment</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
                <div class="position-relative form-group">
                  <label class="mb-0">Filed Against</label>
                  <input class="form-control" type="text" name="customerid" placeholder="User ID" id="customerid" class="" onclick="fetch_seller(this.id);"  onfocus="fetch_seller(this.id);" onkeyup="fetch_seller(this.id);">
                  <div id="searcher"></div>
                </div>
                <div class="position-relative form-group">
                  <label class="mb-0">Priority</label>
                  <select class="form-control planner" name="priority" id="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                  </select>
                </div>
                <div class="position-relative form-group">
                    <label for="product_description">Details of complaint</label>
                    <textarea class="form-control" name="details_priority" id="details_priority" rows="5" required></textarea>
                </div>
                <div class="divider"></div>
                <div class="position-relative form-group">
                  <label for="exampleEmail4">Upload case image or file if theres any. </label>
                  <input type="file" name="file" id="file" class="form-control col-md-11">
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-center" id="info"></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger btn-sm" id="disputeBtn">Make Report</button>
            </div>
        </div>
      </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="request_payout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Payout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="<?= BASE_URL ?>api/controllers/request_payout.php" method="post">
            <div class="modal-body">

                <label class="mb-1">Account Name</label>
                <input type="text" class="form-control" name="name" value="">

                <label class="mb-1">Account Number</label>
                <input type="text" class="form-control" name="accountnumber" value="">

                <label class="mb-1">Enter Payout Amount</label>

                <input type="hidden" name="userid" value="<?= $_SESSION['userid'] ?>">
                <input type="number" class="form-control" name="amount" max="<?= @$userClass->totaluserSales($userid)  ?>" value="">

                <label class="mb-1">Description</label>
                <textarea type="number" class="form-control" name="description" value=""></textarea>
            </div>
            <div class="modal-footer">
                <div class="text-center" id="mess"></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger btn-sm">Send request</button>

            </div>
          </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Ads_renewal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ads Renewal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <label class="mb-1">Duration:</label>
                <form class="" action="<?= BASE_URL ?>api/controllers/renew_ad.php" method="post">

                <select name="days" required="" id="days" class="form-control">
                  <option value=''>Select Duration</option>
                  <?php foreach ($userClass->ad_subscriptions() as $key => $value): ?>
                    <option data-amount='<?= $value['price'] ?>' value="<?= $value['days'] ?>"> <?= $value['title'] ?> (<?= number_format($value['price'], 2) ?>)</option>
                  <?php endforeach ?>
                </select>
                <input type="hidden" name="id" id="ads_id" value="">
                <input type="submit" id="renewBtn" name="submit" value="submit" style="display:none">
              </form>
            </div>
            <div class="modal-footer">
                <div class="text-center" id="mess"></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-sm"  onclick="payWithPaystack3('<?php echo $userDetails->email; ?>', '<?php echo $userDetails->fname; ?>', '<?php echo $userDetails->lname; ?>',  '<?php echo $userDetails->phone; ?>')">Renew</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Account Upgrades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">By upgrading my account, i hereby agree to the terms and conditions as stated on this platform.</p>
                <div class="divider"></div>
                <label class="mb-1">Select plan:</label>
                <select class="form-control planner" name="plan" id="plan">
                  <option value="Basic">Basic</option>
                  <option value="Premium">Premium</option>
                </select>
                <div class="divider"></div>
                <label class="mb-1">Select duration:</label>
                <select class="form-control planner" name="durate" id="durate">
                  <option value="1">1-month</option>
                  <option value="6">6-months</option>
                  <option value="12">12-months</option>
                </select>
            </div>
            <div class="modal-footer">
                <div class="text-center" id="mess"></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-sm" id="upgradeBtn" onclick="payWithPaystack('<?php echo $_SESSION['userid']; ?>', '<?php echo $userDetails->email; ?>', '<?php echo $userDetails->fname; ?>', '<?php echo $userDetails->lname; ?>',  '<?php echo $userDetails->phone; ?>', '<?php echo $acctType->account_type; ?>')">Request upgrade</button>
                <script src="https://js.paystack.co/v1/inline.js"></script>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="disputeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div> -->

<div class="modal fade" id="read_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-lg-12">
          <div class="main-card mb-3 card">
              <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                      <div class="widget-content p-0">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left mr-3">
                                  <img width="42" class="rounded" src="images/avatars/1.jpg" alt="">
                              </div>
                              <div class="widget-content-left">
                                  <div class="widget-heading">James John</div>
                                  <div class="widget-subheading">This is a good product</div>
                              </div>
                              <div class="widget-content-right">
                                <div class="widget-heading">
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star-o"></i>
                                </div>
                                <button class="btn btn-success btn-sm" onclick="viewreview()">View</button>
                                <button class="btn btn-danger btn-sm" onclick="replyreview()">Reply</button>
                              </div>
                          </div>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="reply_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reply reviewed message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Review By:</label>
            <input type="text" class="form-control" id="recipient-name" value="James John" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Review Message:</label>
            <textarea class="form-control" id="message-text" readonly>This product is so good</textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Rating:</label>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Type Reply:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger">Reply Review</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="view_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reply reviewed message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Review By:</label>
            <input type="text" class="form-control" id="recipient-name" value="James John" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Review Message:</label>
            <textarea class="form-control" id="message-text" readonly>This product is so good</textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Rating:</label>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-lg-12">
          <div class="main-card mb-3 card">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" style="height: 250px !important; width:100% !important;">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="productimg/330596/330596-2_1a342131-dbfd-4a82-bfc5-fa47bbc68416_500x500_crop_center.jpg" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="productimg/330596/330596-2_1a342131-dbfd-4a82-bfc5-fa47bbc68416_500x500_crop_center.jpg" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="productimg/330596/330596-2_1a342131-dbfd-4a82-bfc5-fa47bbc68416_500x500_crop_center.jpg" alt="Third slide">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </li>
                  <li class="list-group-item">
                      <div class="widget-content p-0">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left mr-3">
                                  <img width="42" class="rounded" src="images/avatars/2.jpg" alt="">
                              </div>
                              <div class="widget-content-left">
                                  <div class="widget-heading">James John</div>
                                  <div class="widget-subheading">Wuse 2, Abuja FCT 900001</div>
                              </div>
                              <div class="widget-content-right">
                                  <button class="btn btn-danger btn-sm">View Details</button>
                              </div>
                          </div>
                      </div>
                  </li>
                  <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Billing address</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="text">Wuse 2, Abuja FCT 900001</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Customer name</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="badge badge-pill badge-success">Jame Jhoe</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Price</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="badge badge-pill badge-success">#24, 000</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Contact details:</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="badge badge-pill badge-success">+2348047484848</div><br>
                                <div class="badge badge-pill badge-success">james@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Quantity:</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="badge badge-pill badge-success"> Shoes: 3</div>
                                <div class="badge badge-pill badge-success"> Bags: 3</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Payment method:</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="badge badge-pill badge-success"> Card or Pay on delivery</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Request Location:</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="badge badge-pill badge-success"> Card or Pay on delivery</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">Message:</div>
                            </div>
                            <div class="widget-content-right ml-3">
                                <div class="text"> i want more details on the product</div>
                            </div>
                        </div>
                    </div>
                </li>
              </ul>
          </div>
      </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div> -->
    </div>
  </div>
</div>


<div class="modal fade" id="disputeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Complainant:</label>
          <input type="text" class="form-control" id="senderusername" value="" readonly>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Against:</label>
          <input type="text" class="form-control" id="againstusername" value="" readonly>
        </div>
        <div class="form-group">
          <label for="message-text" class="col-form-label">Message:</label>
          <textarea class="form-control" id="dispute_message" value=""></textarea>
        </div>
      </div>
      <input type="hidden" class="form-control" id="disputeid" value="">
      <input type="hidden" class="form-control" id="senderid" value="">
      <input type="hidden" class="form-control" id="againstid" value="">
      <div id="disputer_result"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="disputeResponseBtn">Send Message</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="buyer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-body">
			<div class="main-card mb-3 card">
				<div class="card-body">
					<h5 class="card-title">Buyer Details</h5>
					<hr>
					<div class="form-row">
						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="d_id" id="d_id" placeholder="id" type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="d_username" id="d_username" type="text" class="form-control" readonly>
							</div>
						</div>

						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="d_email" id="d_email" type="email" class="form-control" readonly>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<div class="position-relative form-group">
                <label for="d_name">First Name</label>
								<input name="d_fname" id="d_fname" type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="position-relative form-group">
                <label for="d_lname">Last Name</label>
								<input name="d_lname" id="d_lname" type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<div class="position-relative form-group">
                <label for="d_phone">Number</label>
								<input name="d_phone" id="d_phone" type="number" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-6">
              <label for="">State</label>
							<input class="form-control" name="d_statelocal" id="d_statelocal" readonly>
              </div>
              <div class="col-md-6">
                <label for="">Country</label>

							<input name="d_countrylocal" id="d_countrylocal" type="" class="form-control col-12" readonly>
						</div>
						<div class="col-md-12 mt-3">
							<div class="position-relative form-group">
                <label for="">Address</label>

								<textarea class="form-control" id="d_address" name="d_address" placeholder="Address here" rows="2"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer d-block text-center">
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script src="js/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<script>
    var editor = null;
    ClassicEditor.create(document.querySelector("#editor"), {
        toolbar: [
            "bold",
            "italic",
            "link",
            "bulletedList",
            "numberedList",
            "blockQuote",
            "undo",
            "redo"
        ]
    })
            .then(editor => {
        //debugger;
        window.editor = editor;
    })
    .catch(error => {
        console.error(error);
    });

</script>
<script type="text/javascript">

  function replyDispute(disputeid, senderid, againstid, recipientname){
    var fields = recipientname.split('-');
    var senderusername = fields[0];
    var againstusername = fields[1];
    document.getElementById("againstusername").value = againstusername;
    document.getElementById("senderusername").value = senderusername;
    document.getElementById("disputeid").value = disputeid;
    document.getElementById("senderid").value = senderid;
    document.getElementById("againstid").value = againstid;
    document.getElementById("exampleModalLabel").innerHTML = "RE: Dispute Between " + senderusername + " &amp; " + againstusername;
    $('#disputeModal').modal('show');
  }

  function payWithPaystack(userid, useremail, fname, lname, fone, readyPlan){

    var planner = $('#plan').val();
    var durate = $('#durate').val();

    // alert(readyPlan + ' ' + planner);
    // return;

    if(planner == readyPlan){
      console.log('You are already on this plan!');
      document.getElementById('mess').innerHTML = "<span class='alert alert-warning alert-sm' style='font-size: 12px;'>You are already on this plan!</span>";
      setTimeout(function () {
        $('#mess').fadeOut();
      }, 4000);
      return;
    }

    if(planner == 'Basic'){
      var amountToPay = 200000;
    }else if(planner == 'Premium'){
      var amountToPay = 400000;
    }

    if(durate == 1){
      var amountToPay = amountToPay*1;
    }else if(durate == 6){
      var amountToPay = amountToPay*6;
    }else if(durate == 12){
      var amountToPay = amountToPay*12;
    }

    var handler = PaystackPop.setup({
      key: 'pk_test_7974282ff9c7f73d5afc1a79fd11746cba653e28',
      first_name: fname,
      last_name: lname,
      email: useremail,
      amount: amountToPay,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: fone
            }
         ]
      },
      callback: function(response){
           // alert('success. transaction ref is ' + response.message);
           // alert(response.status);
           // return;
          if(response.status == 'success'){
            submitUpgrade(userid, useremail);
          }else{
            alert('Error:' + response.message)
          }
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }


  function payWithPaystack2( useremail, fname, lname, fone,){

    var amount = $('#days').find(':selected').data('amount')
    console.log(amount);

    // alert(readyPlan + ' ' + planner);
    // return;
    console.log(amount);
    var handler = PaystackPop.setup({
      key: 'pk_test_7974282ff9c7f73d5afc1a79fd11746cba653e28',
      first_name: fname,
      last_name: lname,
      email: useremail,
      amount: amount * 100,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: fone
            }
         ]
      },
      callback: function(response){
           alert('success. transaction ref is ' + response.message);
           alert(response.status);
           console.log(response);
           // return;
          if(response.status == 'success'){

             $('#addAdsBtn').click();
          }else{
            alert('Error:' + response.message)
          }
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }

  function ads_renewal(id){
    $('#ads_id').val(id);
  $('#Ads_renewal').modal('show');
  }

  function payWithPaystack3(useremail, fname, lname, fone,){

    var amount = $('#days').find(':selected').data('amount')
    var handler = PaystackPop.setup({
      key: 'pk_test_7974282ff9c7f73d5afc1a79fd11746cba653e28',
      first_name: fname,
      last_name: lname,
      email: useremail,
      amount: amount * 100,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
        custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: fone
            }
        ]
      },
      callback: function(response){
          alert('success. transaction ref is ' + response.message);
          alert(response.status);
          console.log(response);
          // return;
          if(response.status == 'success'){
            $('#renewBtn').click();
          }else{
            alert('Error:' + response.message)
          }
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
  function submitUpgrade(userid, useremail){
    document.getElementById('upgradeBtn').innerHTML = "Please wait...";
    document.getElementById('upgradeBtn').disabled = true;

    var plan = $('#plan').val();
    var durate = $('#durate').val();

    $.ajax({
        type: 'POST',
        url: '<?= BASE_URL ?>api/controllers/upgrade_account.php',
        data: {
          plan : plan,
          durate : durate,
          userid : userid,
          useremail : useremail
        },
        cache: false,
        dataType: 'text',
        success: function (response) {
          // alert(response);
          // return;
          if(response == 'success'){
            document.getElementById('upgradeBtn').innerHTML = "Reloading...";
            document.getElementById('upgradeBtn').disabled = true;
            document.getElementById('mess').innerHTML = "<span class='alert alert-success alert-sm' style='font-size: 12px;'>Account upgrade successful.</span>";
            setTimeout(function () {
              window.location.reload();
            }, 3000);
          }else if(response='already'){
            document.getElementById('upgradeBtn').innerHTML = "Request upgrade";
            document.getElementById('upgradeBtn').disabled = false;
            console.log(response);
            document.getElementById('mess').innerHTML = "<span class='alert alert-danger alert-sm' style='font-size: 12px;'>Account already on the plan!</span>";
            setTimeout(function () {
              $('#mess').fadeOut();
            }, 2000);
          }else{
            document.getElementById('upgradeBtn').innerHTML = "Request upgrade";
            document.getElementById('upgradeBtn').disabled = false;
            console.log(response);
            document.getElementById('mess').innerHTML = "<span class='alert alert-danger alert-sm' style='font-size: 12px;'>Account upgrade not successful, try again!</span>";
            setTimeout(function () {
              $('#mess').fadeOut();
            }, 2000);
          }
        }
    });
    event.preventDefault();
  }

    $(document).ready(function () {

      $("#disputeResponseBtn").on('click',(function(e){
        document.getElementById('disputeResponseBtn').innerHTML = "Please wait...";
        document.getElementById('disputeResponseBtn').disabled = true;
        document.getElementById('disputer_result').innerHTML = '';

        if($('#dispute_message').val() != ''){
          $.ajax({
                type: 'POST',
                url: '<?= BASE_URL ?>api/controllers/dispute_response_user.php',
                data: {
                  senderusername : $('#senderusername').val(),
                  againstusername : $('#againstusername').val(),
                  dispute_message : $('#dispute_message').val(),
                  disputeid : $('#disputeid').val(),
                  senderid : $('#senderid').val(),
                  againstid : $('#againstid').val()
                },
                cache: false,
                dataType: 'text',
                success: function (response) {
                  console.log(response);
                    if(response == 'success'){
                      document.getElementById('disputeResponseBtn').innerHTML = "Success";
                      document.getElementById('disputeResponseBtn').disabled = true;
                      document.getElementById('disputer_result').innerHTML = '<p class="alert alert-success">Dispute responded to and waiting for confirmation!</p>';
                      setTimeout(function () {
                          window.location.reload();
                      }, 3000);
                    }
                    else if(response == 'exist'){
                      document.getElementById('disputeResponseBtn').innerHTML = "Send Message";
                      document.getElementById('disputeResponseBtn').disabled = false;
                      document.getElementById('disputer_result').innerHTML = '<p class="alert alert-danger">You have submitted this request, our admin is currently investigating, please wait!</p>';
                      setTimeout(function () {
                        $('#disputeModal').modal('dispose');
                        $('#disputer_result').fadeOut();
                      }, 5000);
                    }else{
                        document.getElementById('disputeResponseBtn').innerHTML = "Send Message";
                        document.getElementById('disputeResponseBtn').disabled = false;
                        document.getElementById('disputer_result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
                        setTimeout(function () {
                          $('#disputeModal').modal('dispose');
                          $('#disputer_result').fadeOut();
                        }, 4000);
                    }
                }
            });
            event.preventDefault();
        }else{
            document.getElementById('disputeResponseBtn').innerHTML = "Send Message";
            document.getElementById('disputeResponseBtn').disabled = false;
            document.getElementById('disputer_result').innerHTML = '<p class="alert alert-danger">State your response to the complaint or request.</p>';
            setTimeout(function () {
                $('#disputer_result').fadeOut();
            }, 4000);
        }
      }));

        $('#logoutBtn').on('click', function(){
            window.location = '<?= BASE_URL ?>api/controllers/logout.php';
        });

        $('#profileSet').on('click', function () {
            $('#pfBody').show();
            $('#rpBody').hide();
            $('#dBody').hide();
            $('#tdBody').hide();
            $('#storepicture').hide();
            $('#storevideo').hide();
        });

        $('#returnPolicy').on('click', function () {
            $('#pfBody').hide();
            $('#rpBody').show();
            $('#dBody').hide();
            $('#tdBody').hide();
            $('#storepicture').hide();
            $('#storevideo').hide();
        });

        $('#disclaimer').on('click', function () {
            $('#pfBody').hide();
            $('#rpBody').hide();
            $('#dBody').show();
            $('#tdBody').hide();
            $('#storepicture').hide();
            $('#storevideo').hide();
        });

        $('#timeDelivery').on('click', function () {
            $('#pfBody').hide();
            $('#rpBody').hide();
            $('#dBody').hide();
            $('#tdBody').show();
            $('#storepicture').hide();
            $('#storevideo').hide();
        });

        $('#timeDelivery').on('click', function () {
            $('#pfBody').hide();
            $('#rpBody').hide();
            $('#dBody').hide();
            $('#tdBody').show();
            $('#storepicture').hide();
            $('#storevideo').hide();
        });

        $('#storepic').on('click', function () {
            $('#pfBody').hide();
            $('#rpBody').hide();
            $('#dBody').hide();
            $('#tdBody').hide();
            $('#storepicture').show();
            $('#storevideo').hide();
        });

        $('#storevid').on('click', function () {
            $('#pfBody').hide();
            $('#rpBody').hide();
            $('#dBody').hide();
            $('#tdBody').hide();
            $('#storepicture').hide();
            $('#storevideo').show();
        });

        $('.carousel.carousel-multi-item.v-2 .carousel-item').each(function () {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < 4; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
            }
        });

        $("#catBtn").on('click',(function(e){
          document.getElementById('catBtn').innerHTML = "Please wait...";
          document.getElementById('catBtn').disabled = true;
          var catData = {
            catname : $("#catname").val(),
            catdescription : $("#catdescription").val()
          }
          $.ajax({
                  type: 'POST',
                  url: '<?= BASE_URL ?>api/controllers/user_category.php',
                  data: catData,
                  cache: false,
                  dataType: 'text',
                  success: function (response) {
                      // alert(response);
                      // return;
                      if(response == 'success'){
                        document.getElementById('catBtn').innerHTML = "Create Catalogue";
                        document.getElementById('catBtn').disabled = false;
                        document.getElementById('result').innerHTML = '<p class="alert alert-success">Catalogue added!</p>';
                        window.location.reload();
                          return true;
                      }
                      else if(response == 'exist'){
                        document.getElementById('catBtn').innerHTML = "Create Catalogue";
                        document.getElementById('catBtn').disabled = false;
                        document.getElementById('result').innerHTML = '<p class="alert alert-danger">Catalogue exist!</p>';
                        return true;
                      }else{
                          document.getElementById('catBtn').innerHTML = "Create Catalogue";
                          document.getElementById('catBtn').disabled = false;
                          document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
                          return true;
                      }
                  }
              });
              event.preventDefault();
          }));

        var num = 1;
        var max_fields = 8;
        var wrapper = $("#container1");
        var add_button = $("#add");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                var num = x++;
                $(wrapper).append('<div class="row"><div class="col-md-3"><div class="position-relative form-group"><label for="exampleEmail11" class="">Product pack</label><select class="form-control" id="product_pack'+num+'" name="product_pack'+num+'"><option value="">Choose...</option><option value="3">3</option><option value="5">5</option><option value="6">6</option><option value="9">9</option><option value="10">10</option><option value="12">12</option><option value="Pack">Pack</option><option value="Carton">Carton</option></select></div></div><div class="col-md-5"><div class="position-relative form-group"><label for="exampleEmail11" class="">Product Price</label><input name="product_price'+num+'" id="product_price'+num+'"  type="number" class="form-control" required></div></div><div class="col-md-3"><div class="position-relative form-group"><label for="exampleEmail11" class="">Discount(in %)</label><input id="product_discount'+num+'" name="product_discount'+num+'" type="number" class="form-control" value="0"></div></div><button class="btn btn-danger btn-sm btn-shadow delete mt-4 mb-5"><i class="fa fa-times"></i></button></div>'); //add input box
            } else {
                alert('You Reached the limits');
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });


        var nums = 1;
        var max_fieldss = 7;
        var wrappers = $("#container2");
        var add_buttons = $("#addImgFile");

        var xx = 1;
        $(add_buttons).click(function(e) {
            e.preventDefault();
            if (xx < max_fieldss) {
                var nums = xx++;
                $(wrappers).append('<div class="row"><label for="exampleEmail4">More product images</label><input type="file" name="productimg'+nums+'" id="productimg'+nums+'" class="form-control col-md-11"><button class="btn btn-danger btn-sm btn-shadow deletes col-md-1" style=""><i class="fa fa-times"></i></button></div>');
            } else {
                alert('You cannot add more than 7 product picture.');
            }
        });

        $(wrappers).on("click", ".deletes", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            xx--;
        });

        var numss = 1;
        var max_fieldsss = 5;
        var wrapperss = $("#container3");
        var add_buttonss = $("#addImgFiles");

        var xxs = 1;
        $(add_buttonss).click(function(e) {
            e.preventDefault();
            if (xxs < max_fieldsss) {
                var numss = xxs++;
                $(wrapperss).append('<div class="row"><label for="exampleEmail4">More product images</label><input type="file" name="productimg'+numss+'" id="productimg'+numss+'" class="form-control col-md-11"><button class="btn btn-danger btn-sm btn-shadow deletes col-md-1" style=""><i class="fa fa-times"></i></button></div>');
            } else {
                alert('You cannot add more than 5 store picture.');
            }
        });

        $(wrapperss).on("click", ".deletes", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            xxs--;
        });
    });


// var num = 1;
// document.getElementById('add').addEventListener("click",addInput);

// function addInput(){
// var demo = document.getElementById('demo');
// demo.insertAdjacentHTML('beforeend','<div class="row"><div class="col-md-3"><div class="position-relative form-group"><label for="exampleEmail11" class="">Product pack</label><select class="form-control" id="product_pack['+num+']" name="product_pack['+num+']"><option value="3">3</option><option value="5">5</option><option value="6">6</option><option value="9">9</option><option value="10">10</option><option value="12">12</option><option value="Pack">Pack</option><option value="Carton">Carton</option></select></div></div><div class="col-md-5"><div class="position-relative form-group"><label for="exampleEmail11" class="">Product Price</label><input name="product_price['+num+']" id="product_price['+num+']"  type="number" class="form-control"></div></div><div class="col-md-3"><div class="position-relative form-group"><label for="exampleEmail11" class="">Discount(in %)</label><input id="product_discount['+num+']" name="product_discount['+num+']" type="number" class="form-control"></div></div><div class="col-md-1" style="padding-top: 34px;"><a href="#" class="delete"><button class="btn btn-danger btn-sm btn-shadow"><i class="fa fa-times"></i></button></a></div></div>');
//  num++;
// }

function buyerdetails(id){
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/get_single_sub_admin.php',
		data : {
			subadminid : id
		},
		cache: false,
		dataType: 'text',
		success: function (response) {
			var vvv = JSON.parse(response)
			// //console.log(response);
			$('#d_id').val(vvv.userid);
			$('#d_username').val(vvv.username);
			$('#d_email').val(vvv.email);
			$('#d_fname').val(vvv.fname);
			$('#d_lname').val(vvv.lname);
			$('#d_phone').val(vvv.phone);
			$('#d_statelocal').val(vvv.state);
			$('#d_countrylocal').val(vvv.country);
			$('#d_address').val(vvv.address);
			$('#buyer-modal').modal('show');
		},
		error: function (response) {
			//console.log(response);
		}
	});
	event.preventDefault();
}

$(document).ready(function (e) {
 $("#adslocation").on('change',(function(e) {
  e.preventDefault();
  $.ajax({
         url: '<?= BASE_URL ?>api/controllers/check_ad.php',
   type: "POST",
   data:  new FormData(document.getElementById('form')),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    // $("#err").fadeOut();
   },
   success: function(data)
      {
        console.log(data);
        $("#err").html(data);

      },
     error: function(e)
      {
    // $("#err").html(e).fadeIn();
      }
    });
 }));
});

function check_ads(){
  console.log($('#form'));
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/check_ad.php',
		data : {
			data : new FormData(document.getElementById('form')),
			adslocation : $('#adslocation').val()
		},
		cache: false,
    processData: false,
    contentType: false,
		success: function (response) {
			// var vvv = JSON.parse(response)
			console.log(response);
			// $('#d_id').val(vvv.userid);
			// $('#d_username').val(vvv.username);
			// $('#d_email').val(vvv.email);
			// $('#d_fname').val(vvv.fname);
			// $('#d_lname').val(vvv.lname);
			// $('#d_phone').val(vvv.phone);
			// $('#d_statelocal').val(vvv.state);
			// $('#d_countrylocal').val(vvv.country);
			// $('#d_address').val(vvv.address);
			// $('#buyer-modal').modal('show');
		},
		error: function (response) {
			console.log(response);
		}
	});
	event.preventDefault();
}
function SendReply(id) {

            document.getElementById("reply"+id).innerHTML = "Please wait...";
            document.getElementById("replyBtn"+id).disabled = true;
            var data = {
              product_id  : $("#p"+id).val(),
              reviewid    : $("#r"+id).val(),
              user_id     : $("#u"+id).val(),
              r_name      : $("#n"+id).val(),
              r_email     : $("#e"+id).val(),
              r_title       : $("#t"+id).val(),
              r_body      : $("#reply"+id).val()
            }
            $.ajax({
                    type: 'POST',
                    url: '<?= BASE_URL ?>api/controllers/reply_review.php',
                    data: data,
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        alert(response);
                        // return;
                        if(response){
                          document.getElementById("replyBtn"+id).innerHTML = "Reply Sent";
                          document.getElementById("replyBtn"+id).disabled = false;
                          document.getElementById('result'+id).innerHTML = '<p class="alert alert-success">Reply Sent!</p>';
                          window.location.reload();
                            return true;
                        }
                    }
                });
                event.preventDefault();

}
function fetch_all_user(id){
  $( "#"+id ).autocomplete({
    source : '<?= BASE_URL ?>api/controllers/fetch_all_user.php',
  });
}

function fetch_seller(id){
  var sellerid = $('#'+id).val();
  $( "#"+id ).autocomplete({
    source : '<?= BASE_URL ?>api/controllers/fetch_seller.php?sellerid='+sellerid,
  });
}


function orderdetails(id){
  $('#order_details-'+id).modal('show');
}


function readreview(id){
  $('#read_review'+id).modal('show');
}

function replyreview(id){
  $('#reply_review'+id).modal('show');
}

function viewreview(id){
  $('#view_review'+id).modal('show');
}

 function getview(view) {
   $.ajax({
     type: 'GET',
     url: '<?= BASE_URL ?>api/controllers/get_message_view.php',
     data: {
       view : view
     },
     cache: false,
     dataType: 'text',
     success: function (response) {
      $('#view').html(response)

     },
     error: function (response) {

     }
   });
 }
 function getMessage(id=0) {
   $.ajax({
     type: 'GET',
     url: '<?= BASE_URL ?>api/controllers/get_message_view.php',
     data: {
       messageid : id,
       view : "seen"
     },
     cache: false,
     dataType: 'text',
     success: function (response) {
      $('#view').html(response)

     },
     error: function (response) {

     }
   });
 }

 <?php if (isset($_GET['disputeid'])) {?>

   setInterval(function() {
     load_dispute(<?php echo '"'.$_GET['disputeid'].'"'; ?>);
   }, 5000);
 <?php } ?>

     function load_dispute(id) {
       $.ajax({
         type: 'GET',
         url: '<?= BASE_URL ?>api/controllers/get_dispute.php',
         data: {
           id : id,
         },
         cache: false,
         dataType: 'text',
         success: function (response) {
 // console.log(response);
            $('#chat-box').html(response)

         },
         error: function (response) {

         }
       });
     }
 function getDispute(id='') {
   $.ajax({
     type: 'GET',
     url: '<?= BASE_URL ?>api/controllers/get_dispute_view.php',
     data: {
       view : id
     },
     cache: false,
     dataType: 'text',
     success: function (response) {
      $('#view').html(response)
console.log(response);
     },
     error: function (response) {

     }
   });
 }

 function loadChat(id) {
   $.ajax({
     type: 'GET',
     url: '<?= BASE_URL ?>api/controllers/get_chat_messages.php',
     // data: {
     //   ids : ids,
     //   b_message : $('#b_message').val(),
     //   b_name : $('#b_name').val(),
     //   b_phone : $('#b_phone').val(),
     //   b_email : $('#b_email').val()
     // },
     cache: false,
     // dataType: 'text',
     success: function (response) {
       // console.log(response);
       // setTimeout(() => {
       //   $('#mmm').fadeOut();
       // }, 3000);
       // setTimeout(() => {
       //   window.location.reload();
       // }, 4000);

           $('#chat-box').html(response)

     },
     error: function (response) {

     }
   });

 }

 function reply_dispute_chat(receiverid) {
   var msg = $('#b_message').val()
   var time = "<?php echo date("Y-m-d H:i:s");?>";
   var img = "<?php echo $userClass->profilepic_link($userid);?>";

   $.ajax({
     type: 'POST',
     url: '<?= BASE_URL ?>api/controllers/dispute_response_user.php',

     data: {
       receiverid : $('#receiverid').val(),
       senderusername : $('#senderusername').val(),
       againstusername : $('#againstusername').val(),
       dispute_message : $('#b_message').val(),
       disputeid : $('#disputeid').val(),
       senderid : $('#senderid').val(),
       againstid : $('#againstid').val()

     },
     cache: false,
     dataType: 'text',
     success: function (response) {
       console.log(response);
       $('#chat-box').append(

          "   <div class='chat-box-wrapper chat-box-wrapper-right float-right' style=' width: 52%;'>"+
            "     <div>"+
            "         <div class='chat-box'>"+msg+
            "         </div>"+
            "         <small class='opacity-6'>"+
            "             <i class='fa fa-calendar-alt mr-1'></i>"+
            "             "+time+""+
            "         </small>"+
            "     </div>"+
            "     <div>"+
            "         <div class='avatar-icon-wrapper ml-1'>"+
            "             <div class='badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg'></div>"+
            "             <div class='avatar-icon avatar-icon-lg rounded'><img src='"+img+"'"+
            "                     alt=''></div>"+
            "         </div>"+
          "   </div>"+
        " </div>")
        $('#b_message').val('')
     },
     error: function (response) {
console.log(response);
     }
   });
 }

 function ReplyChat(receiverid) {
   var msg = $('#dispute_message').val()
   var time = "<?php echo date("Y-m-d H:i:s");?>";
   var img = "<?php echo $userClass->profilepic_link($userid);?>";


  $.ajax({
   type: 'POST',
     url: '<?= BASE_URL ?>api/controllers/reply_chat_messages.php',
     data: {
       receiverid : receiverid,
       b_message : msg

     },
     cache: false,
     dataType: 'text',
     success: function (response) {
       // console.log(response);
       $('#chat-box').append(
       "<div class='float-right'>"+
          "   <div class='chat-box-wrapper chat-box-wrapper-right'>"+
            "     <div>"+
            "         <div class='chat-box'>"+msg+
            "         </div>"+
            "         <small class='opacity-6'>"+
            "             <i class='fa fa-calendar-alt mr-1'></i>"+
            "             "+time+""+
            "         </small>"+
            "     </div>"+
            "     <div>"+
            "         <div class='avatar-icon-wrapper ml-1'>"+
            "             <div class='badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg'></div>"+
            "             <div class='avatar-icon avatar-icon-lg rounded'><img src='"+img+"'"+
            "                     alt=''></div>"+
            "         </div>"+
            "     </div>"+
          "   </div>"+
        " </div>")
        $('#b_message').val('')
     },
     error: function (response) {
console.log(response);
     }
   });
 }

function sendMseller(){
  // document.getElementById(ids).innerHTML = "Please wait...";
  // document.getElementById(ids).disabled = true;
  $.ajax({
    type: 'POST',
    url: '<?= BASE_URL ?>api/controllers/message_seller.php',
    data: {
      b_message : $('#b_message').val(),
      receiverid : $('#receiverid').val(),
      b_name : $('#b_name').val()
    },
    cache: false,
    dataType: 'text',
    success: function (response) {
      console.log(response);
      $('#mmm').html('<span class="alert alert-warning">'+response+'</span>');
      $('#b_message').val('');
      setTimeout(() => {
        $('#mmm').fadeOut();
      }, 3000);
      setTimeout(() => {
        // window.location.reload();
      }, 4000);
    },
    error: function (response) {
      console.log(response);
      // document.getElementById(ids).innerHTML = "Send Message";
      // document.getElementById(ids).disabled = false;
      $('#mmm').html('<span class="alert alert-warning">'+response+'</span>');
      setTimeout(() => {
        $('#mmm').fadeOut();
      }, 3000);
    }
  });
}
function deactivateProduct(productid, sellerid){
// alert(sellerid);
// return;
$.ajax({
  type: 'POST',
  url: '<?= BASE_URL ?>api/controllers/deactivate_product.php',
  data: {
    productid : productid,
    sellerid : sellerid
  },
  cache: false,
  dataType: 'text',
  success: function (response) {
    // alert(response);
    // return;
    if(response == 'success'){
      document.getElementById('result').innerHTML = '<p class="alert alert-danger">Product Disapproved!</p>';
      setTimeout(function () {
        window.location.reload();
      }, 3000);
      return;
    }else{
      document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
      setTimeout(function () {
        window.location.reload();
      }, 3000);
      return;
    }
    }
  });
  event.preventDefault();
}
  function changeStatus(status,orderid,buyerid){
// alert(orderid);
// return;
      $.ajax({
          type: 'GET',
          url: '<?= BASE_URL ?>api/controllers/order_status.php',
          data: {
              orderid : orderid,
              status : $('#'+status).val(),
              buyerid : buyerid
          },
          cache: false,
          dataType: 'text',
          success: function (response) {
              // alert(response);
              // return;
              if(response == 'success'){
                  let text = $('#'+status).val().charAt(0).toUpperCase() + $('#'+status).val().slice(1)
                  $('#text-'+orderid).html(text);
              }
          }
      });
      event.preventDefault();
  }

function deleteProduct(productid){
// alert(sellerid);
// return;
$.ajax({
  type: 'POST',
  url: '<?= BASE_URL ?>api/controllers/delete_product.php',
  data: {
    productid : productid
  },
  cache: false,
  dataType: 'text',
  success: function (response) {
    // alert(response);
    // return;
    if(response == 'success'){
      document.getElementById('result').innerHTML = '<p class="alert alert-danger">Product Disapproved!</p>';
      setTimeout(function () {
        window.location.reload();
      }, 3000);
      return;
    }else{
      document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
      setTimeout(function () {
        window.location.reload();
      }, 3000);
      return;
    }
    }
  });
  event.preventDefault();
}

function requestP(){
    // console.log('here');
  $('#request_payout').modal('show');
  }
</script>
</body>

</html>
