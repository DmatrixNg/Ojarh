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
											<h2 class="heading--title">Create New Account</h2>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-lg-8 offset-2">
										<div class="main-card mb-3 card">
											<div class="card-body">
                                                <h4 class="mt-2 text-center"><span>Enter<span class="text-success"> <?php echo isset($_GET['role']) ? $_GET['role'] : 'Seller'; ?> </span> Information</span></h4>
												<hr>
												<?php if(isset($_GET['result'])): ?>
													<div class="alert alert-success"><?= $_GET['result'] ?></div>
                                                <?php endif; ?>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative form-group">
                                                            <input name="role" id="role" placeholder="Username here..." type="text" class="form-control" value="<?php echo isset($_GET['role']) ? $_GET['role'] : 'Seller'; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="position-relative form-group">
                                                            <input name="username" id="username" placeholder="Username here..." type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="position-relative form-group">
                                                            <input name="password" id="password" placeholder="Password here..."
                                                            type="password" class="form-control"></div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="position-relative form-group">
                                                            <input name="email" id="email" placeholder="Email here..."
                                                            type="email" class="form-control"></div>
                                                        </div>
                                                </div>
                                                    <div class="divider row"></div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <input name="fname" id="fname" placeholder="First Name here..." type="text" class="form-control"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                <input name="lname" id="lname" placeholder="Last Name here..." type="text" class="form-control"></div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <input name="phone" id="phone" placeholder="Phone Number here..." type="number" class="form-control">
                                                </div>
                                                </div>
                                                <div class="col-md-6" id="inter">
                                                <div class="position-relative form-group">
                                                    <select class="form-control col-12" name="countryinter" id="countryinter" required="required">
                                                    <?php echo $userClass->fetchCountries(); ?>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <input name="stateinter" id="state" placeholder="State here..." type="text" class="form-control col-12">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                <div class="position-relative form-group">
                                                    <textarea class="form-control" id="address" name="address" placeholder="Address here" rows="2"></textarea>
                                                </div>
                                                </div>
                                                <div class="mt-3 position-relative form-check">
                                                <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                                <label for="exampleCheck" class="form-check-label">Accept our <a href="javascript:void(0);">Terms
                                                and Conditions</a>.</label></div>
                                                </div>
                                            </div>
                                            <div id="mess2" style="text-align: center;" class="pb-4"></div>
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
                                                <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg" id="final_sub" onclick="submitform(this.id)">Create Account</button>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="text-center text-white opacity-8 mt-3">Copyright © OJARH.com - All rights reserved. <?php echo date('Y'); ?> </div>
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
  </div>
</div>
<?Php include_once('inc/footer.php'); ?>
<script type="text/javascript">
    function submitform(id){

        $('#'+id).hide();
        $('#loaders2').show();

        let data = {
            role: $('#role').val(),
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            phone: $('#phone').val(),
            state: $('#state').val(),
            country: $('#countryinter').val(),
            address: $('#address').val()
        }

        if (!validatePhone(data.phone)) {
          $('#mess2').html('Phone number not properly formatted.');
          $('#'+id).show();
          $('#loaders2').hide();
          setTimeout(function() {
            $('#mess2').fadeOut();
          }, 2000);
          return false;
        }

        $.ajax({
            type: 'POST',
            url: '../api/controllers/create_user.php',
            data: data,
            cache: false,
            dataType: 'text',
            success: function(response) {
              console.log(response);
              if (response == "username") {
                $('#mess2').html('Username Taken.');
                $('#'+id).show();
                $('#loaders2').hide();
                setTimeout(function() {
                  $('#mess2').fadeOut();
                }, 2000);
                return;
              } else if (response == "email") {
                $('#mess2').html('Email already in use.');
                $('#'+id).show();
                $('#loaders2').hide();
                setTimeout(function() {
                  $('#mess2').fadeOut();
                }, 2000);
                return;
              } else if (response == "success") {
                $('#'+id).html('Reloading...');
                $('#mess2').html('Successful...');
                setTimeout(function() {
                    window.location.reload();
                }, 3000);
                return;
              } else {
                $('#mess2').html(response);
                $('#'+id).show();
                $('#loaders2').hide();
                setTimeout(function() {
                  $('#mess2').fadeOut(5000);
                }, 2000);
                return;
              }

            }
          });
          event.preventDefault();

    }
</script>
