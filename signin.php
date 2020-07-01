<?php include('api/config/Database.php'); ?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Language" content="en">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Login - OJARH.com - home of wholesalers...</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
	/>
	<meta name="description" content="Kero HTML Bootstrap 4 Dashboard Template">

	<!-- Disable tap highlight on IE -->
	<meta name="msapplication-tap-highlight" content="no">
	<link rel="icon" href="assets/images/logo_120x@3x.png">

	<link href="seller/css/main.css" rel="stylesheet"></head>

	<body>
		<div class="app-container app-theme-white body-tabs-shadow">
			<div class="app-container">
				<div class="h-100 bg-plum-plate bg-animation">
					<div class="d-flex h-100 justify-content-center align-items-center">
						<div class="mx-auto app-login-box col-md-8">
							<div class="modal-dialog w-100 mx-auto">
								<div class="modal-content">
									<div class="modal-body">
										<div class="h5 modal-title text-center">
											<a href="index.php"><img class="rounded mb-2" width="160px" height="auto" src="assets/images/logo_120x@3x.png" alt=""></a>
											<h4 class="mt-2">
												<div>Welcome back,</div>
												<span>Please sign in to your account below.</span>
											</h4>
										</div>
										<div class="form-row">
											<?php echo isset($_GET['mess']) ?  $_GET['mess'] : ''; ?>
											<div class="col-md-12">
												<div class="position-relative form-group"><input name="username" id="username" placeholder="Username here..." type="email" class="form-control"></div>
											</div>
											<div class="col-md-12">
												<div class="position-relative form-group"><input name="password" id="password" placeholder="Password here..." type="password" class="form-control"></div>
											</div>
										</div>
										<div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Keep me logged in</label></div>
										<div class="divider"></div>
										<h6 class="mb-0">No account? <a href="signup.php" class="text-primary">Sign up now</a></h6>
									</div>
									<div class="text-primary" id="mess" style="text-align: center;">
										<?php
										if(isset($_GET['warning'])){
											echo $_GET['warning'];
										}
										?>
									</div>
									<div class="modal-footer clearfix">
										<div id="loaders" style="display: none;">
											<div
											class="loader-wrapper d-flex justify-content-center align-items-center">
											<div class="loader">
												<div class="ball-clip-rotate-multiple">
													<div></div>
													<div></div>
												</div>
											</div>
										</div>
									</div>
									<div class="float-left"><a href="password_recovery.php" class="btn-lg btn btn-link">Recover Password</a></div>
									<div class="float-right">
										<button class="btn btn-primary btn-lg" id="login-submit">Sign In</button>
									</div>
								</div>
							</div>
						</div>
						<div class="text-center text-white opacity-8 mt-3">Copyright © OJARH.com - All rights reserved. <?php echo date('Y'); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="seller/js/jquery.min.js"></script>
	<script src="seller/js/bootstrap.js"></script>
	<script type="text/javascript" src="seller/js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#login-submit").on('click', function () {
				document.getElementById('login-submit').innerHTML = "Please wait...";
				$('#loaders').show();
				if ($("#username").val() !== "" && $("#password").val() !== "") {
					$.ajax({
						type: 'POST',
						url: 'api/controllers/login_user.php',
						data: {
							username : $("#username").val(),
							password : $("#password").val()
						},
						cache: false,
						dataType: 'text',
						success: function (response) {
							// console.log(response);
              //return;
							<?php if (isset($_GET['redirect'])) {?>
								if(response == 'Seller' ||
								response == 'Admin' ||
								response == 'Sub Admin' ||
								response == 'Buyer' ||
								response == 'International'){
	              	document.getElementById('login-submit').innerHTML = 'Redirecting...';
	              	document.getElementById('login-submit').disabled = true;
	              	$('#loaders').show();
	              	setTimeout(function () {
	              		window.location = "<?php echo $_GET['redirect']; ?>";
	              	}, 3000);
	              	return false;
								}
									else if(response == 'Inactive'){
		              	document.getElementById('mess').innerHTML = 'This user account is inactive, please contact our support department.';
		              	document.getElementById('login-submit').innerHTML = "Sign In";
		              	$('#login-submit').show();
		              	$('#loaders').hide();
		              	setTimeout(function () {
		              		$('#mess').fadeOut();
		              	}, 2000);
		              	return false;
		              }else if(response == 'Invalid'){
		              	document.getElementById('mess').innerHTML = 'Invalid login information or the account is not activated.';
		              	document.getElementById('login-submit').innerHTML = "Sign In";
		              	$('#login-submit').show();
		              	$('#loaders').hide();
		              	setTimeout(function () {
		              		$('#mess').fadeOut();
		              	}, 2000);
		              	return false;
		              }
						<?php	}else { ?>


              if(response == 'Seller'){
              	document.getElementById('login-submit').innerHTML = 'Redirecting...';
              	document.getElementById('login-submit').disabled = true;
              	$('#loaders').show();
              	setTimeout(function () {
              		window.location = 'seller/';
              	}, 3000);
              	return false;
              }else if(response == 'Admin' || response == 'Sub Admin'){
              	document.getElementById('login-submit').innerHTML = 'Redirecting...';
              	document.getElementById('login-submit').disabled = true;
              	$('#loaders').show();
              	setTimeout(function () {
              		window.location = 'admin/';
              	}, 3000);
              	return false;
              }else if(response == 'Buyer'){
              	document.getElementById('login-submit').innerHTML = 'Redirecting...';
              	document.getElementById('login-submit').disabled = true;
              	$('#loaders').show();
              	setTimeout(function () {
              		window.location = 'buyer/';
              	}, 3000);
              	return false;
              }else if(response == 'International'){
              	document.getElementById('login-submit').innerHTML = 'Redirecting...';
              	document.getElementById('login-submit').disabled = true;
              	$('#loaders').show();
              	setTimeout(function () {
              		window.location = 'international/';
              	}, 3000);
              	return false;
              }else if(response == 'Inactive'){
              	document.getElementById('mess').innerHTML = 'This user account is inactive, please contact our support department.';
              	document.getElementById('login-submit').innerHTML = "Sign In";
              	$('#login-submit').show();
              	$('#loaders').hide();
              	setTimeout(function () {
              		$('#mess').fadeOut();
              	}, 2000);
              	return false;
              }else if(response == 'Invalid'){
              	document.getElementById('mess').innerHTML = 'Invalid login information or the account is not activated.';
              	document.getElementById('login-submit').innerHTML = "Sign In";
              	$('#login-submit').show();
              	$('#loaders').hide();
              	setTimeout(function () {
              		$('#mess').fadeOut();
              	}, 2000);
              	return false;
              }
							<?php	} ?>
            }
          });
					event.preventDefault();
				} else {
					document.getElementById('mess').innerHTML = 'Please fill in your information.';
					document.getElementById('login-submit').innerHTML = "Retry";
					$('#login-submit').show();
					$('#loaders').hide();
				}
			});
		});
	</script>
</body>
</html>
