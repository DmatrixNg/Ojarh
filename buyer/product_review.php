<?php include 'inc/header.php'; ?>
<div class="app-inner-layout app-inner-layout-page">
	<div class="app-inner-layout__wrapper">
		<div class="app-inner-layout__content">
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
				
					<div class="card no-shadow bg-transparent no-border rm-borders mb-3">
						<div class="card">
							<div class="container">
								<div class="row m-5">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="heading heading-2 text-center mb-70">
											<h2 class="heading--title">List of products</h2>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="main-card mb-3 card">
											<div class="card-body">
												<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
													<thead>
														<tr>
															<th>Product ID</th>
															<th>Product title</th>
															<th>Product Category</th>
															<th>Product Availability</th>
															<th>Status</th>
															<th>Created On</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php $userClass->user_product_list($userid); ?>
													</tbody>
                                      <!-- <tfoot>
                                        <tr>
                                          <th>Product ID</th>
                                          <th>Product title</th>
                                          <th>Product Category</th>
                                          <th>Product Availability</th>
                                          <th>Status</th>
                                          <th>Created On</th>
                                        </tr>
                                      </tfoot> -->
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php include 'inc/footer.php'; ?>
