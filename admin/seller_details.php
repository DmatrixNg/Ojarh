<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
$pageName = "User Details";
?>
<?php include 'inc/header.php'; ?>
<div class="app-inner-layout__wrapper ml-4 mr-4 mb-4">
	<div class="col-md-12">
		<div class="app-inner-layout__content card pt-4 pl-4 pr-4 pb-4">
	        <div class="app-inner-layout__top-pane row mb-2">
	            <div class="pane-left row col-md-12">
	                <div class="mobile-app-menu-btn">
	                    <button type="button" class="hamburger hamburger--elastic">
	                    <span class="hamburger-box">
	                        <span class="hamburger-inner"></span>
	                    </span>
	                    </button>
	                </div>
									<?php $user = $userClass->userDetails($_GET['userid']);
									 ?>
									 <div class="col-lg-6">

										 <h4 class="mb-0">User Details</h4>
										 <div id="result"> </div>
									 </div>
									 <div class="col-lg-6 text-right">
										 <div class="app-inner-layout__top-pane">
											 <div class="pane-right">
												 <div class="btn-group">
													 <a href="verified_seller.php"><button type="button" class="ml-2 btn btn-primary">
														 <span class="opacity-7 mr-1">
															 <i class="fa fa-arrow-left"></i>
														 </span> Back
													 </button></a>
												 </div>
											 </div>
										 </div>
									 </div>
	            </div>

	        </div>
	  <div class="bg-white">

	  <div class="form-group">
	    <label for="recipient-name" class="col-form-label">Seller name:</label>
	    <input type="text" class="form-control" id="complainer_fullname" value="<?php echo $user->fname.' '.$user->lname; ?>" readonly>
	  </div>
	  <div class="form-group">
	    <label for="recipient-email" class="col-form-label">Email:</label>
	    <input type="text" class="form-control" id="complainer_email" value="<?php echo $user->email; ?>" readonly>
	  </div>
	  <div class="form-group">
	    <label for="recipient-email" class="col-form-label">Agent ID</label>
	    <input type="text" class="form-control" id="complainer_email" value="<?php echo $user->agentid; ?>" readonly>
	  </div>
	  <div class="form-group">
	    <label for="recipient-email" class="col-form-label">Phone no:</label>
	    <input type="text" class="form-control" id="complainer_phone" value="<?php echo $user->phone; ?>" readonly>
	  </div>
		<div class="row">

			<div class="form-group col-lg-4">
				<label for="recipient-email" class="col-form-label">Country:</label>
				<input type="text" class="form-control" value="<?php echo $user->country; ?>" readonly>
			</div>
			<div class="form-group col-lg-4">
				<label for="recipient-email" class="col-form-label">State:</label>
				<input type="text" class="form-control" value="<?php echo $user->state; ?>" readonly>
			</div>
			<div class="form-group col-lg-4">
				<label for="recipient-email" class="col-form-label">Address:</label>
				<textarea type="text" class="form-control" readonly> <?php echo $user->address; ?></textarea>
			</div>
		</div>
	  <div class="form-group">
			<?php $data = $userClass->UserVerification($_GET['userid']);
			 ?>
	    <label for="recipient-email" class="col-form-label"><?php echo $data->documenttype ?>:</label>
	    <?php
	    if($data->verifyfile== "")
	    {
	        echo "NO FILE FOUND";
	    }else {
				?>
	      <a target="_blank" href="../verifyfile/<?php echo $data->verifyid; ?>/<?php echo $data->verifyfile; ?>">Click to view Verification Document</a>
	    <?php }?>
	 </div>

</div>
<div class="row" style="justify-content:center;">
	<div class="col-12">
		<?php if ($data->verifystatus == "Activate") {?>
			<button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateVerify('<?php echo $data->verifyid; ?>', '<?php echo $_GET['userid']; ?>')">Disapprove</button>

		<?php }else{ ?>
		<button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateVerify('<?php echo $data->verifyid; ?>', '<?php echo $_GET['userid']; ?>')" style="float: left;">Approve</button>

		<button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateVerify('<?php echo $data->verifyid; ?>', '<?php echo $_GET['userid']; ?>')">Disapprove</button>
		<?php }?>
	</div>
</div>

	</div>

	</div>

</div>
<?php include 'inc/footer.php'; ?>
