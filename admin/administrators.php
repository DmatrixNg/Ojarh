<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?Php include_once('inc/header.php'); ?>
<div class="app-inner-layout app-inner-layout-page">
	<div class="app-inner-layout__wrapper">
		<div class="app-inner-layout__content">
			<div class="tab-content">
				<div class="container-fluid">
					<div class="card no-shadow bg-transparent no-border rm-borders mb-3">
						<div class="card">
							<div class="container">
								<div class="row m-5">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="heading heading-2 text-center mb-70">
											<h2 class="heading--title">Administrator List</h2>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<div class="main-card mb-3 card">
											<div class="card-body">
												<h5 class="card-title">Add New Admin</h5>
												<hr>
												<?php if(isset($_GET['result'])): ?>
													<div class="alert alert-success"><?= $_GET['result'] ?></div>
												<?php endif; ?>
												<div class="form-row">
													<div class="col-md-12">
														<div class="position-relative form-group">
															<select class="form-control" name="role" id="role" >
																<option value="" selected>--Choose--</option>
																<option value="Admin">Admin</option>
																<option value="Sub Admin">Sub Admin</option>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="position-relative form-group">
															<input name="username" id="username" placeholder="Username here..." type="text" class="form-control">
														</div>
													</div>
													<div class="col-md-12">
														<div class="position-relative form-group">
															<input name="password" id="password" placeholder="Password here..."type="hidden" value="123456" class="form-control">
														</div>
													</div>
													<div class="col-md-12">
														<div class="position-relative form-group">
															<input name="email" id="email" placeholder="Email here..." type="email" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-row">
													<div class="col-md-6">
														<div class="position-relative form-group">
															<input name="fname" id="fname" placeholder="First Name here..." type="text" class="form-control">
														</div>
													</div>
													<div class="col-md-6">
														<div class="position-relative form-group">
															<input name="lname" id="lname" placeholder="Last Name here..." type="text" class="form-control">
														</div>
													</div>
													<div class="col-md-6">
														<div class="position-relative form-group">
															<input name="phone" id="phone" placeholder="Phone Number here..." type="number" class="form-control">
														</div>
													</div>
													<div class="col-md-6" id="stat">
														<select class="form-control" name="statelocal" id="statelocal" required="required">
															<option value="" selected="selected">Select State</option>
															<?php echo $userClass->fetchStates(); ?>
														</select>
														<input name="countrylocal" id="countrylocal" value="Nigeria" type="hidden" class="form-control col-12">
													</div>
													<div class="col-md-12 mt-3">
														<div class="position-relative form-group">
															<textarea class="form-control" id="address" name="address" placeholder="Address here" rows="2"></textarea>
														</div>
													</div>
												</div>
												<div id="mess3" style="text-align: center;" class="pb-4"></div>
												<div class="modal-footer d-block text-center">
													<div id="loaders2" style="display: none;">
														<div class="loader-wrapper d-flex justify-content-center align-items-center">
															<div class="loader">
																<div class="ball-clip-rotate-multiple">
																	<div></div>
																	<div></div>
																</div>
															</div>
														</div>
													</div>
													<button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-danger btn-sm" id="finalNextBtn">Create Account</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-lg-8"><div class="main-card mb-3 card">
										<div class="card-body">
											<table id="example" class="table table-hover table-striped table-bordered">
												<thead>
													<tr>
														<th>Admin ID</th>
														<th>Full Name</th>
														<th>status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($userClass->view_admins() as $key => $value): ?>
														<tr>
															<td><?= $value['userid']; ?></td>
															<td><?= $value['username']; ?></td>
															<?php if($value['status']==1): ?>
																<td><span class="badge badge-success">Active</span></td>
																<?php elseif($value['status']==0): ?>
																	<td><span class="badge badge-warning">Pending</span></td>
																	<?php elseif($value['status']==2): ?>
																		<td><span class="badge badge-danger">Inactive</span></td>
																	<?php endif; ?>
																	<td>
																		<?php if($_SESSION['userid'] != $value['userid']): ?>
																			<?php if($value['status']==1): ?>
																			<button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateSeller('<?= $value['userid'] ?>', 'Buyer')">
																			Deactivate
																			</button>
																			<?php else: ?>
																			<button class="mb-2 mr-2 btn btn-shadow btn-success btn-sm" onclick="activateSeller('<?= $value['userid'] ?>', 'Buyer')">
																			Activate
																			</button>
																			<?php endif ?>
																		<?php endif; ?>
																		<button onclick="subadmindetails(this.id)" id="<?= $value['userid'] ?>" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button>
																	</td>
																</tr>
															<?php endforeach; ?>
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
<?Php include_once('inc/footer.php'); ?>
