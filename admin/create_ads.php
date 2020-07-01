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

          <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
            <div class="card">
              <div class="container">
                <div class="row m-5">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="heading heading-2 text-center mb-70">
                      <h2 class="heading--title">Create New Advert</h2>
                    </div>
                    <div id="result"></div>
                  </div>
                </div
                <div class="row">
                  <div class="col-md-12">
                    <div class="main-card mb-3 card">
                      <div class="card-body">
                        <hr>
                        <?php if(isset($_GET['result'])): ?>
                          <div class="alert alert-success"><?= $_GET['result'] ?></div>
                        <?php endif; ?>
                        <form action="../api/controllers/add_ad.php" method="post" enctype="multipart/form-data" class='row'>
                          <div class="position-relative form-group col-sm-12 col-md-6">
                            <label for="link" class="">Link</label>
                            <input name="link" id="link" type="text" class="form-control">
                            <input name="returnLocation" value="seller/create_ads.php" id="returnLocation" type="hidden" class="form-control">
                          </div>
                          <div class="position-relative form-group col-sm-12 col-md-6">
                            <label for="link" class="">Ads Location</label>
                            <select class="form-control" id="adslocation" name="adslocation">
                              <option value="">Choose location</option>
                              <option value="top">Top Ads</option>
                              <option value="body">Body Ads</option>
                              <option value="sidebar">Side-Bar Ads</option>
                              <option value="footer">Footer Ads</option>
                            </select>
                          </div>
                          <div class="position-relative form-group col-sm-12 col-md-6">
                            <label for="link" class="">Ad Duration</label>
                            <select name="days" required="" id="days" class="form-control">
                            	<option value=''>Select Duration</option>
                            	<?php foreach ($userClass->ad_subscriptions() as $key => $value): ?>
                            		<option data-amount='<?= $value['price'] ?>' value="<?= $value['days'] ?>"> <?= $value['title'] ?> (<?= number_format($value['price'], 2) ?>)</option>
                            	<?php endforeach ?>
                            </select>
                          </div>
                          <div class="position-relative form-group form-group col-sm-12 col-md-6">
                            <label for="marketfile" class="">Upload Ads Image</label>
                            <input name="adimg" id="adimg" type="file" class="form-control-file">
                          </div>
                          <div class=" form-group col-sm-12 col-md-6">
                          	<button type="submit" class="mt-1 btn btn-danger" id="addAdsBtn">Add Ads</button>
                          </div>
                        </form>
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
