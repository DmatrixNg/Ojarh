<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?php include('inc/header.php'); ?>
<div class="app-inner-layout app-inner-layout-page">
	<div class="app-inner-layout__wrapper">
		<div class="app-inner-layout__content">
			<div class="tab-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<div class="row">
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">Buyers</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4">
																<?= $userClass->getUsersCount("Buyer") ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">Local Sellers</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4 text-danger">
																<?= $userClass->getUsersCount("Seller") ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">International Sellers</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4">
																<?= $userClass->getUsersCount("International") ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">Totals Users</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4">
																<?= $userClass->getUsersCount() ?>
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
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<div class="row">
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">Brands</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4">
																<?= count($userClass->getBrands()) ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">Markets</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4 text-danger">
																<?= $userClass->marketCount() ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">Categories</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4">
																<?= $userClass->categoryCount() ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-3">
									<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
										<div class="widget-chat-wrapper-outer">
											<div class="widget-chart-content">
												<h6 class="widget-subheading">Products</h6>
												<div class="widget-chart-flex">
													<div class="widget-numbers mb-0 w-100">
														<div class="widget-chart-flex">
															<div class="fsize-4">
																<?= $userClass->productCount() ?>
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
					<div class="main-card mb-3 card">
						<div class="card-header pb-4">
							<div class="card-header-title font-size-lg text-capitalize font-weight-normal">
								Recently Registered Sellers
							</div>
							<div class="btn-actions-pane-right">
								<button type="button" id="PopoverCustomT-1" class="btn-icon btn-wide btn-outline-2x btn btn-outline-focus btn-sm">
									Actions Menu
									<span class="pl-2 align-middle opactiy-7">
										<i class="fa fa-angle-down"></i>
									</span>
								</button>
							</div>
						</div>
						<div class="table-responsive">
							<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
								<thead>
									<tr>
										<th>Sellers ID</th>
										<th>Username</th>
										<th>Full Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Date Registered</th>
										<th>status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $userClass->view_all(''); ?>
								</tbody>
							</table>
						</div>
						<div class="d-block p-4 text-center card-footer">
							<a href="view_all_seller.php"><button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-lg">
								<span class="mr-2 opacity-7"> <i class="fa fa-cog fa-spin"></i></span>
								<span class="mr-1">View All</span>
							</button></a>
						</div>
					</div>
                    <!-- <div class="main-card mb-3 card">
                      <div class="card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                          Recently Registered Buyers
                        </div>
                        <div class="btn-actions-pane-right">
                          <button type="button" id="PopoverCustomT-1"
                              class="btn-icon btn-wide btn-outline-2x btn btn-outline-focus btn-sm">
                            Actions Menu
                            <span class="pl-2 align-middle opactiy-7">
                              <i class="fa fa-angle-down"></i>
                            </span>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="align-middle text-truncate mb-0 table table-borderless table-hover">
                          <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Avatar</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Company</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Due Date</th>
                            <th class="text-center">Target Achievement</th>
                            <th class="text-center">Actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td class="text-center text-muted" style="width: 80px;">#54</td>
                            <td class="text-center" style="width: 80px;">
                              <img width="40" class="rounded-circle"
                                 src="assets/images/avatars/1.jpg" alt="">
                            </td>
                            <td class="text-center"><a href="javascript:void(0)">Juan C.
                              Cargill</a>
                            </td>
                            <td class="text-center"><a href="javascript:void(0)">Micro
                              Electronics</a></td>
                            <td class="text-center">
                              <div class="badge badge-pill badge-danger">Canceled</div>
                            </td>
                            <td class="text-center">
                              <span class="pr-2 opacity-6">
                                <i class="fa fa-business-time"></i>
                              </span>
                              12 Dec
                            </td>
                            <td class="text-center" style="width: 200px;">
                              <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                  <div class="widget-content-wrapper">
                                    <div class="widget-content-left pr-2">
                                      <div class="widget-numbers fsize-1 text-danger">
                                        71%
                                      </div>
                                    </div>
                                    <div class="widget-content-right w-100">
                                      <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-danger"
                                           role="progressbar" aria-valuenow="71"
                                           aria-valuemin="0" aria-valuemax="100"
                                           style="width: 71%;"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                              <div role="group" class="btn-group-sm btn-group">
                                <button class="btn-shadow btn btn-primary">Hire</button>
                                <button class="btn-shadow btn btn-primary">Fire</button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-center text-muted" style="width: 80px;">#55</td>
                            <td class="text-center" style="width: 80px;">
                              <img width="40" class="rounded-circle"
                                 src="assets/images/avatars/2.jpg" alt="">
                            </td>
                            <td class="text-center"><a href="javascript:void(0)">Johnathan
                              Phelan</a></td>
                            <td class="text-center"><a href="javascript:void(0)">Hatchworks</a>
                            </td>
                            <td class="text-center">
                              <div class="badge badge-pill badge-info">On Hold</div>
                            </td>
                            <td class="text-center">
                              <span class="pr-2 opacity-6">
                                <i class="fa fa-business-time"></i>
                              </span>
                              12 Dec
                            </td>
                            <td class="text-center" style="width: 200px;">
                              <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                  <div class="widget-content-wrapper">
                                    <div class="widget-content-left pr-2">
                                      <div class="widget-numbers fsize-1 text-warning">
                                        54%
                                      </div>
                                    </div>
                                    <div class="widget-content-right w-100">
                                      <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-warning"
                                           role="progressbar" aria-valuenow="54"
                                           aria-valuemin="0" aria-valuemax="100"
                                           style="width: 54%;"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                              <div role="group" class="btn-group-sm btn-group">
                                <button class="btn-shadow btn btn-primary">Hire</button>
                                <button class="btn-shadow btn btn-primary">Fire</button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-center text-muted" style="width: 80px;">#56</td>
                            <td class="text-center" style="width: 80px;">
                              <img width="40" class="rounded-circle"
                                 src="assets/images/avatars/3.jpg" alt="">
                            </td>
                            <td class="text-center"><a href="javascript:void(0)">Darrell
                              Lowe</a>
                            </td>
                            <td class="text-center"><a href="javascript:void(0)">Riddle
                              Electronics</a></td>
                            <td class="text-center">
                              <div class="badge badge-pill badge-warning">In Progress</div>
                            </td>
                            <td class="text-center">
                              <span class="pr-2 opacity-6">
                                <i class="fa fa-business-time"></i>
                              </span>
                              12 Dec
                            </td>
                            <td class="text-center" style="width: 200px;">
                              <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                  <div class="widget-content-wrapper">
                                    <div class="widget-content-left pr-2">
                                      <div class="widget-numbers fsize-1 text-success">
                                        97%
                                      </div>
                                    </div>
                                    <div class="widget-content-right w-100">
                                      <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-success"
                                           role="progressbar" aria-valuenow="97"
                                           aria-valuemin="0" aria-valuemax="100"
                                           style="width: 97%;"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                              <div role="group" class="btn-group-sm btn-group">
                                <button class="btn-shadow btn btn-primary">Hire</button>
                                <button class="btn-shadow btn btn-primary">Fire</button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-center text-muted" style="width: 80px;">#56</td>
                            <td class="text-center" style="width: 80px;">
                              <img width="40" class="rounded-circle"
                                 src="assets/images/avatars/4.jpg" alt="">
                            </td>
                            <td class="text-center"><a href="javascript:void(0)">George T.
                              Cottrell</a></td>
                            <td class="text-center"><a href="javascript:void(0)">Pixelcloud</a>
                            </td>
                            <td class="text-center">
                              <div class="badge badge-pill badge-success">Completed</div>
                            </td>
                            <td class="text-center">
                              <span class="pr-2 opacity-6">
                                <i class="fa fa-business-time"></i>
                              </span>
                              12 Dec
                            </td>
                            <td class="text-center" style="width: 200px;">
                              <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                  <div class="widget-content-wrapper">
                                    <div class="widget-content-left pr-2">
                                      <div class="widget-numbers fsize-1 text-info">
                                        88%
                                      </div>
                                    </div>
                                    <div class="widget-content-right w-100">
                                      <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-info"
                                           role="progressbar" aria-valuenow="88"
                                           aria-valuemin="0" aria-valuemax="100"
                                           style="width: 88%;"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="text-center">
                              <div role="group" class="btn-group-sm btn-group">
                                <button class="btn-shadow btn btn-primary">Hire</button>
                                <button class="btn-shadow btn btn-primary">Fire</button>
                              </div>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="d-block p-4 text-center card-footer">
                        <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-lg">
                          <span class="mr-2 opacity-7">
                            <i class="fa fa-cog fa-spin"></i>
                          </span>
                          <span class="mr-1">View All</span>
                        </button>
                      </div>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include('inc/footer.php'); ?>
