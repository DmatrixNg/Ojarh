<?php
include('../api/config/Database.php');
include('../api/models/session.php');
include('can_access.php');
$pageName = "Messages";
?>
<?php include 'inc/header.php'; ?>
<div class="app-inner-layout__wrapper ml-4 mr-4 mb-4">
	<div class="row">
		<div class="col-md-3">
			<div class="app-inner-layout__sidebar card">
				<ul class="nav flex-column">
						<li class="pt-3 pl-3 pr-3 pb-3 nav-item">
								<button onclick="getview('create')" class="btn-pill btn-shadow btn btn-primary btn-block">Write New Email
								</button>
						</li>
						<li class="nav-item-header nav-item">My Account</li>
						<li class="nav-item"><a href="javascript:getview('inbox');" class="nav-link"><i
														class="nav-link-icon pe-7s-chat"> </i><span>Inbox</span>
										<div class="ml-auto badge badge-pill badge-info"><?php echo $userClass->get_admin_message_count(); ?></div>
								</a></li>
						<!-- <li class="nav-item"><a href="javascript:getview('sent');" class="nav-link"><i
														class="nav-link-icon pe-7s-wallet"> </i><span>Sent Items</span></a></li> -->
				</ul>
		</div>
	</div>
	<div class="col-md-9">
		<div id="view"></div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
<script>
$.ajax({
  type: 'GET',
  url: '../api/controllers/get_admin_message_view.php',
  data: {
    view : "inbox"
  },
  cache: false,
  dataType: 'text',
  success: function (response) {
    $('#view').html(response)

  },
  error: function (response) {

  }
});
</script>
