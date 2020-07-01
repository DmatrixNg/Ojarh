<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
?>
<?php include_once('inc/header.php'); ?>
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
											<h2 class="heading--title">Home Page Video</h2>
										</div>
										<h3 id="result" class="text-center" style="margin-bottom: 20px;"></h3>
										<div class="row">
											<div class="col-md-9">
												<input type="text" class="form-control" value="<?= $userClass->getSettings()['video_link']; ?>" id="videoInput" />
											</div>
											<div class="col-md-3">
												<button class="btn btn-primary settingsUpdater" data-output="#videoOutput" data-input="#videoInput" data-column="video_link" data-type="src" >Save Video Link</button>
											</div>

											<div class="col-xl-12 col-lg-12 col-md12 col-sm-12 col-xs-12" style="margin-top: 20px">
												<div id="shopify-section-1544955458813" class="shopify-section home-section"
												style="padding-bottom: 60px !important;">
												<iframe id="videoOutput" width="100%" height="450" src="<?= $userClass->getSettings()['video_link']; ?>"
												frameborder="0"
												allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
</div>
<?php include_once('inc/footer.php'); ?>
