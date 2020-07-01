  <?php
  require_once 'api/config/Database.php';
  require_once 'api/models/Controller.php';
  $db = getDB();
  $userClass = new Users($db);
  ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registration - OJARH.com - home of wholesalers...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Kero HTML Bootstrap 4 Dashboard Template">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="icon" href="assets/images/logo_120x@3x.png">
    <link href="seller/css/main.css" rel="stylesheet">
  </head>

  <body>
    <div class="app-container app-theme-white body-tabs-shadow">
      <div class="app-container">
        <div class="h-100 bg-premium-dark">
          <div class="d-flex h-100 justify-content-center align-items-center">
            <div class="mx-auto app-login-box col-md-8">
              <div class="modal-dialog w-100">
                <div class="modal-content formFirst">
                  <div class="modal-body">
                    <h5 class="modal-title text-center">
                      <a href="index.php"><img class="rounded mb-2" width="160px" height="auto" src="assets/images/logo_120x@3x.png" alt=""></a>
                      <h4 class="mt-2 text-center">
                        <span>Start selling/buying on<span class="text-success"> OJARH.com</span> </span></h4>
                    </h5>
                    <div class="divider row"></div>

                    <div class="form-row">
                      <div class="col-md-12">
                        <div class="position-relative form-group">
                          <select class="form-control" name="role" id="role" onchange="cityChanged(this.value)">
                            <option value="" selected>--Choose--</option>
                            <option value="Seller">Seller</option>
                            <option value="International">International Seller</option>
                            <option value="Buyer">Buyer</option>
                          </select>
                        </div>
                        <div class="position-relative form-group">
                          <input name="agentid" id="agentid" placeholder="Agent ID (For seller only)" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="position-relative form-group">
                          <input name="username" id="username" placeholder="Username here..." type="text" class="form-control"></div>
                      </div>
                      <div class="col-md-12">
                        <div class="position-relative form-group">
                          <input name="password" id="password" placeholder="Password here..." type="password" class="form-control"></div>
                      </div>
                      <div class="col-md-12">
                        <div class="position-relative form-group">
                          <input name="email" id="email" placeholder="Email here..." type="email" class="form-control"></div>
                      </div>
                    </div>
                    <div class="divider row"></div>
                    <h6 class="mb-0">Already have an account? <a href="signin.php" class="text-primary">Sign in</a> | <a href="password_recovery.php" class="text-primary">Recover Password</a></h6>
                  </div>
                  <div class="modal-footer d-block text-center">
                    <div id="loaders" style="display: none;">
                      <div class="loader-wrapper d-flex justify-content-center align-items-center">
                        <div class="loader">
                          <div class="ball-clip-rotate-multiple">
                            <div></div>
                            <div></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="mess"></div>
                    <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg" id="nextBtn">Next</button>
                  </div>
                </div>
                <div class="modal-content formSecond" style="display:  none;">
                  <div class="modal-body">
                    <h5 class="modal-title text-center">
                      <img class="rounded mb-3" src="assets/images/logo_120x@3x.png" width="100px" height="auto" alt="">
                      <button class="btn-wide btn-pill btn-shadow float-left btn-hover-shine btn btn-primary btn-small" id="backBtn" style="float: left;">Back
                      </button>
                      <h4 class="mt-2 text-center">
                        <span>Enter<span class="text-success"> Personal </span> Details</span></h4>
                    </h5>
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
                            <option value="<?php echo $userClass->getRealIpAddr(); ?>" selected="selected"><?php echo $userClass->getRealIpAddr(); ?></option>
                            <?php echo $userClass->fetchCountries(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6" id="inter2">
                        <div class="position-relative form-group">
                          <input name="stateinter" id="stateinter" placeholder="State here..." type="text" class="form-control col-12">
                        </div>
                      </div>
                      <div class="col-md-6" style="display: none;" id="stat">
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
                    <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg" id="finalNextBtn">Create Account</button>
                  </div>
                </div>
              </div>
              <div class="text-center text-white opacity-8 mt-3">Copyright © OJARH.com - All rights reserved. <?php echo date('Y'); ?> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="seller/js/jquery.min.js"></script>
    <script src="seller/js/bootstrap.js"></script>
    <script type="text/javascript" src="seller/js/main.js"></script>
  </body>
  <script type="text/javascript">
    $(document).ready(function() {

      $("#backBtn").on('click', function() {
        $('.formSecond').hide();
        $('.formFirst').show();
        $('#nextBtn').show();
        $('#loaders').hide();
        return false;
      });

      $("#nextBtn").on('click', function() {
        $('#nextBtn').hide();
        $('#loaders').show();

        let data = {
          role: $('#role').val(),
          agentid: $('#agentid').val(),
          username: $('#username').val(),
          email: $('#email').val(),
          password: $('#password').val()
        }

        if (!validateEmail(data.email)) {
          document.getElementById('mess').innerHTML = 'Email is not valid.';
          $('#nextBtn').show();
          $('#loaders').hide();
          setTimeout(function() {
            $('#mess').fadeOut();
          }, 2000);
          return false;
        }


        if (data.role !== '' && data.username !== '' && data.password !== '' && data.email !== '') {
          setTimeout(function() {
            $('.formFirst').hide();
          }, 3000);
          setTimeout(function() {
            $('.formSecond').show();
          }, 3000);
        } else {
          document.getElementById('mess').innerHTML = 'Field(s) empty!';
          $('#nextBtn').show();
          $('#loaders').hide();
        }
      });

      $('#finalNextBtn').on('click', function() {
        $('#finalNextBtn').hide();
        $('#loaders2').show();

        if ($('#role').val() == 'Seller') {
          var state = $('#statelocal').val();
          var country = $('#countrylocal').val();
        } else if ($('#role').val() == 'International' || $('#role').val() == 'Buyer') {
          var state = $('#stateinter').val();
          var country = $('#countryinter').val();
        }

        let data2 = {
          fname: $('#fname').val(),
          lname: $('#lname').val(),
          phone: $('#phone').val(),
          state: state,
          country: country,
          address: $('#address').val()
        }

        if (!validatePhone(data2.phone)) {
          document.getElementById('mess2').innerHTML = 'Phone number not properly formatted.';
          $('#finalNextBtn').show();
          $('#loaders2').hide();
          setTimeout(function() {
            $('#mess2').fadeOut();
          }, 2000);
          return false;
        }

        if ($('#agentid').val() == '') {
          var agentid = '0001';
        } else {
          var agentid = $('#agentid').val();
        }

        if (data2.fname !== '' || data2.lname !== '' || data2.phone !== '' || data2.country !== '' || data2.state !== '' || data2.address !== '') {
          $.ajax({
            type: 'POST',
            url: 'api/controllers/create_user.php',
            data: {
              role: $('#role').val(),
              agentid: agentid,
              username: $('#username').val(),
              email: $('#email').val(),
              password: $('#password').val(),
              fname: $('#fname').val(),
              lname: $('#lname').val(),
              phone: $('#phone').val(),
              state: state,
              country: country,
              address: $('#address').val()
            },
            cache: false,
            dataType: 'text',
            success: function(response) {
              console.log(response);
              if (response == "username") {
                document.getElementById('mess2').innerHTML = 'Username taken!';
                $('#finalNextBtn').show();
                $('#loaders2').hide();
                setTimeout(function() {
                  $('#mess2').fadeOut();
                }, 2000);
                return;
              } else if (response == "email") {
                document.getElementById('mess2').innerHTML = 'Email already in use!';
                $('#finalNextBtn').show();
                $('#loaders2').hide();
                setTimeout(function() {
                  $('#mess2').fadeOut();
                }, 2000);
                return;
              } else if (response == "success") {
                document.getElementById('finalNextBtn').innerHTML = 'Redirecting...';
                document.getElementById('mess2').innerHTML = 'Success. Redirecting...';
                setTimeout(function() {
                  window.location = 'signin.php?warning=A verification link has been sent to your mail, please confirm!';
                }, 3000);
                return;
              } else {
                document.getElementById('mess2').innerHTML = response;
                $('#finalNextBtn').show();
                $('#loaders2').hide();
                setTimeout(function() {
                  $('#mess2').fadeOut();
                }, 2000);
                return;
              }

            }
          });
          event.preventDefault();
        } else {
          document.getElementById('mess2').innerHTML = 'Field(s) empty!';
          $('#finalNextBtn').show();
          $('#loaders2').hide();
        }
      });
    });

    function cityChanged(i) {
      console.log(i);
      if (i == 'Seller') {
        $('#inter').hide();
        $('#inter2').hide();
        $('#stat').show();
      } else if (i == 'International') {
        $('#inter').show();
        $('#inter2').show();
        $('#stat').hide();
      }
    }

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validatePhone(phone) {
      var re = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;
      return re.test(phone);
    }
  </script>

  </html>