<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?php include 'inc/header.php'; ?>
<div class="app-inner-layout app-inner-layout-page">
	<div class="app-inner-layout__wrapper">
		<div class="app-inner-layout__content">
			<div class="tab-content">
				<div class="container-fluid">
							<div class="row">
									<div class="col-md-6 col-xl-4">
											<div class="card mb-3 widget-content bg-danger">
													<div class="widget-content-wrapper text-white">
															<div class="widget-content-left mr-5">
																	<div class="widget-heading">Total Income</div>
																	<div class="widget-subheading"></div>
															</div>
															<div class="widget-content-right">
																	<div class="widget-numbers text-white"><span><?php $userClass->totaladminBalance($userid); ?></span></div>
															</div>
													</div>
											</div>
									</div>
									<div class="col-md-6 col-xl-4">
											<div class="card mb-3 widget-content bg-success">
													<div class="widget-content-wrapper text-white">
															<div class="widget-content-left mr-5">
																	<div class="widget-heading">Total Payout</div>
																	<div class="widget-subheading"></div>
															</div>
															<div class="widget-content-right">
																	<div class="widget-numbers text-white"><span> <?php $userClass->totalAdminPayout($userid); ?></span></div>
															</div>
													</div>
											</div>
									</div>
									<div class="col-md-6 col-xl-4">
											<div class="card mb-3 widget-content bg-secondary">
													<div class="widget-content-wrapper text-white">
															<div class="widget-content-left mr-5">
																	<div class="widget-heading">Net balance</div>
																	<div class="widget-subheading"></div>
															</div>
															<div class="widget-content-right">
																	<div class="widget-numbers text-white"><span><?php $userClass->totaluserSales($userid); ?></span></div>
															</div>
													</div>
											</div>
									</div>
									<!-- <div class="col-md-6 col-xl-4">
											<div class="card mb-3 widget-content bg-secondary">
													<div class="widget-content-wrapper text-white">
															<div class="widget-content-left mr-5">
																	<div class="widget-heading"><button onclick="requestP()" class="btn btn-primary-sm">Request Payout</button></div>
															</div>
															<div class="widget-content-right">
															</div>

													</div>
											</div>
									</div> -->
							</div>
                    <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                        <div class="card">
                            <div class="container">
                                <div class="row m-5">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="heading heading-2 text-center mb-70">
                                            <h2 class="heading--title">All Pending transaction</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                        <thead>
																					<tr role="row">
																						<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 48.2px;" aria-sort="ascending" aria-label="Producid:">Seller ID</th>
																						<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Buyer's Name:">Amount</th>
																						<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Account Name:">Account Name</th>
																						<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Account Number:">Account Number</th>
																						<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Description:">Description</th>
																						<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 60.2px;" aria-label="Action:">Action</th>
																					</tr>
                                        </thead>
																				<tbody>
																						<?php $userClass->view_pending_payout($userid); ?>
																				</tbody>

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
<?php include 'inc/footer.php'; ?>
