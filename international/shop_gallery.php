<?php
include('../api/config/Database.php');
include('../api/models/session.php');
?>
<?php include 'inc/header.php'; ?>
<div class="app-inner-layout app-inner-layout-page">
  <div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content pt-1">
      <div class="tab-content">
        <div class="container-fluid">
          <?php
          if($acctType->account_type == 'Starter'){
            echo '<div class="card-body row">
            <div class="alert alert-danger show col-md-12" role="alert">
            You can do more when you upgrade your account to BASIC &amp; PREMIUM!
            <a href="#"><button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
            </div>
            </div>';
          }elseif($acctType->account_type == 'Basic'){
            echo '<div class="card-body row">
            <div class="alert alert-danger show col-md-12" role="alert">
            You can do more when you upgrade your account to PREMIUM!
            <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
            </div>
            </div>';
          }
          ?>
          <?php
          if($acctType->account_type == 'Premium' && $userClass->bizDetails($userid) == 'empty'){
            echo '<div class="card-body row">
            <div class="alert alert-danger show col-md-12" role="alert">
            You have to update your business information <a href="business_setting.php"><button class="btn btn-info btn-sm">Update business profile</button></a>
            </div>
            </div>';
          }else{

          }
          ?>

          <div class="row">
            <div class="col-md-7">
              <div class="main-card mb-3 card">
                <?php if(isset($_GET['result'])){ ?>
                  <div class="b-radius-0 card-header">
                    <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                      <span class="form-heading"><?php echo $_GET['result']; ?></span>
                    </button>
                  </div>
                <?php } ?>
                <div class="col-md-12 pt-2">
                  <h3>Upload Store Images</h3>
                  <div class="divider"></div>
                </div>
                <?php

                $storeimgs = json_decode(@$bizdata->storeimage);
                ?>
                <form action="../api/controllers/add_storeimg.php" method="POST" enctype="multipart/form-data">
                <div id="storepicture" class="card-body row">

                    <?php for ($i=0; $i < 4; $i++) {?>

                      <div class="col-md-6 text-center pb-3" style="border-right: 1px solid #cccccc;">
                        <?php
                        $picture = 'picture'.$i;
                        if (!isset($storeimgs->$picture) && @$storeimgs->$picture == '') {?>

                          <img class="d-block w-100" src="https://via.placeholder.com/800x400" alt="Third slide">
                        <?php    }else { ?>
                          <img class="d-block w-100" src="<?php echo 'storepicture/'.$userid.'/'.$storeimgs->$picture; ?>" alt="Third slide">

                        <?php  } ?>
                        <div class="forms-wizard-vertical">
                          <div class="card-body">
                            <div class="position-relative form-group"  id="container3">
                              <div class="row">
                                <label for="exampleEmail4">Upload Store images</label>
                                <input type="file" name="productimg<?= $i ?>" id="productimg<?= $i ?>" class="form-control col-md-11">
                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    <?php } ?>



                    <div class="col-md-6 text-center">
                      <div class="clearfix">


                        <?php if($userClass->bizDetails($userid) == 'empty'){?>
                          <a href="<?= BASE_URL ?>seller/business_setting.php" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                            Business Profile not Set.
                          </a>
                        <?php }else { ?>
                          <button type="submit" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                            Upload
                          </button>

                        <?php } ?>
                      </div>

                    </div>
                </div>
              </form>
              </div>
            </div>
            <div class="col-md-5">
              <div class="main-card mb-3 card">
                <div id="storevideo" class="card-body">
                  <div class="forms-wizard-vertical">
                    <div class="card-body">
                      <h3>Store Video Link</h3>
                      <div class="divider"></div>
                      <?php if(@$bizdata->videolink == ""){ ?>
                        <img class="d-block w-100" src="https://via.placeholder.com/800x400" alt="Third slide">
                      <?php }else{ ?>
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="<?php echo html_entity_decode($bizdata->videolink); ?>" allowfullscreen></iframe>
                        </div>
                      <?php } ?>
                      <div class="form-group mt-2">
                        <label for="exampleEmail5">Paste youtube link of the video of your store here:</label>
                        <input type="text" id="videolink" name="videolink" class="form-control" placeholder="e.g: https://youtube.com/id8he38nhadk" required>
                      </div>
                    </div>
                  </div>
                  <div class="divider"></div>
                  <div id="messVideo"></div>
                  <div class="clearfix">
                    <button type="button" id="videolinkBtn"
                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                    Add Video
                  </button>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#updatebizbtn').on('click', function(){
      document.getElementById('updatebizbtn').innerHTML = "Updating...";
      document.getElementById('updatebizbtn').disabled = true;
      // alert('yes');
      // return;
      if ($("#bizname").val() !== "" && $("#bizphone").val() !== "" && $("#bizemail").val() !== "" && $("#bizregdate").val() !== "" && $("#bizstate").val() !== "" && $("#bizmarket").val() !== "" && $("#bizaddress").val() !== "") {
        $.ajax({
          type: 'POST',
          url: '../api/controllers/create_bizinfo.php',
          data: {
            bizname : $("#bizname").val(),
            bizphone : $("#bizphone").val(),
            bizemail : $("#bizemail").val(),
            bizregdate : $('#bizregdate').val(),
            bizstate : $("#bizstate").val(),
            bizmarket : $("#bizmarket").val(),
            bizaddress : $("#bizaddress").val(),
            bizwebsite : $("#bizwebsite").val()
          },
          cache: false,
          dataType: 'text',
          success: function (response) {
            // alert(response);
            console.log(response);
            // return;
            if(response == 'success'){
              document.getElementById('updatebizbtn').innerHTML = 'Update Info';
              document.getElementById('updatebizbtn').disabled = false;
              document.getElementById('messer').innerHTML = '<p class="alert alert-success">Update successful!</p>';
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else if(response == 'exist'){
              document.getElementById('updatebizbtn').innerHTML = 'Update Info';
              document.getElementById('messer').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update your business details!</p>';
              document.getElementById('updatebizbtn').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else{
              document.getElementById('updatebizbtn').innerHTML = 'Update Info';
              document.getElementById('messer').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
              document.getElementById('updatebizbtn').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }
          }
        });
        event.preventDefault();

      } else {
        document.getElementById('messer').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
        document.getElementById('updatebizbtn').innerHTML = "Retry";
        document.getElementById('updatebizbtn').disabled = false;
      }
    });

    $('#updatePolicy').on('click', function(){
      document.getElementById('updatePolicy').innerHTML = "Updating...";
      document.getElementById('updatePolicy').disabled = true;

      if($('return_policy').val() != ''){
        $.ajax({
          type: 'POST',
          url: '../api/controllers/update_policy.php',
          data: {
            return_policy : $("#return_policy").val()
          },
          cache: false,
          dataType: 'text',
          success: function (response) {
            // alert(response);
            console.log(response);
            // return;
            if(response == 'success'){
              document.getElementById('updatePolicy').innerHTML = 'Successful...';
              document.getElementById('updatePolicy').disabled = false;
              document.getElementById('messPolicy').innerHTML = '<p class="alert alert-success">Update successful!</p>';
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else if(response == 'exist'){
              document.getElementById('updatePolicy').innerHTML = 'Update Policy';
              document.getElementById('messPolicy').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update your business details!</p>';
              document.getElementById('updatePolicy').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else{
              document.getElementById('updatePolicy').innerHTML = 'Update Policy';
              document.getElementById('messPolicy').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
              document.getElementById('updatePolicy').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }
          }
        });
        event.preventDefault();
      }else{
        document.getElementById('messPolicy').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
        document.getElementById('updatePolicy').innerHTML = "Retry";
        document.getElementById('updatePolicy').disabled = false;
      }
    });

    $('#updateDisclaimer').on('click', function(){
      document.getElementById('updateDisclaimer').innerHTML = "Updating...";
      document.getElementById('updateDisclaimer').disabled = true;

      if($('sellerdisclaimer').val() != ''){
        $.ajax({
          type: 'POST',
          url: '../api/controllers/update_disclaimer.php',
          data: {
            sellerdisclaimer : $("#sellerdisclaimer").val()
          },
          cache: false,
          dataType: 'text',
          success: function (response) {
            // alert(response);
            console.log(response);
            // return;
            if(response == 'success'){
              document.getElementById('updateDisclaimer').innerHTML = 'Successful...';
              document.getElementById('updateDisclaimer').disabled = false;
              document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-success">Update successful!</p>';
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else if(response == 'exist'){
              document.getElementById('updateDisclaimer').innerHTML = 'Update Policy';
              document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update this details!</p>';
              document.getElementById('updateDisclaimer').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else{
              document.getElementById('updateDisclaimer').innerHTML = 'Update Policy';
              document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
              document.getElementById('updateDisclaimer').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }
          }
        });
        event.preventDefault();
      }else{
        document.getElementById('messDisclaimer').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
        document.getElementById('updateDisclaimer').innerHTML = "Retry";
        document.getElementById('updateDisclaimer').disabled = false;
      }
    });

    $('#updateDelivery').on('click', function(){
      document.getElementById('updateDelivery').innerHTML = "Updating...";
      document.getElementById('updateDelivery').disabled = true;

      if($('time_delivery').val() != ''){
        $.ajax({
          type: 'POST',
          url: '../api/controllers/update_timedelivery.php',
          data: {
            time_delivery : $("#time_delivery").val()
          },
          cache: false,
          dataType: 'text',
          success: function (response) {
            // alert(response);
            console.log(response);
            // return;
            if(response == 'success'){
              document.getElementById('updateDelivery').innerHTML = 'Successful...';
              document.getElementById('updateDelivery').disabled = true;
              document.getElementById('messDelivery').innerHTML = '<p class="alert alert-success">Update successful!</p>';
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else if(response == 'exist'){
              document.getElementById('updateDelivery').innerHTML = 'Update Policy';
              document.getElementById('messDelivery').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update this details!</p>';
              document.getElementById('updateDelivery').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else{
              document.getElementById('updateDelivery').innerHTML = 'Update Policy';
              document.getElementById('messDelivery').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
              document.getElementById('updateDelivery').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }
          }
        });
        event.preventDefault();
      }else{
        document.getElementById('messDelivery').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
        document.getElementById('updateDelivery').innerHTML = "Retry";
        document.getElementById('updateDelivery').disabled = false;
      }
    });

    $('#videolinkBtn').on('click', function(){
      document.getElementById('videolinkBtn').innerHTML = "Updating...";
      document.getElementById('videolinkBtn').disabled = true;

      if($('videolink').val() != ''){
        $.ajax({
          type: 'POST',
          url: '../api/controllers/update_videolink.php',
          data: {
            videolink : $("#videolink").val()
          },
          cache: false,
          dataType: 'text',
          success: function (response) {
            // alert(response);
            console.log(response);
            // return;
            if(response == 'success'){
              document.getElementById('videolinkBtn').innerHTML = 'Successful...';
              document.getElementById('videolinkBtn').disabled = true;
              document.getElementById('messVideo').innerHTML = '<p class="alert alert-success">Update successful!</p>';
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else if(response == 'exist'){
              document.getElementById('videolinkBtn').innerHTML = 'Update Policy';
              document.getElementById('messVideo').innerHTML = '<p class="alert alert-danger">You have to request to admin to be able to update this details!</p>';
              document.getElementById('videolinkBtn').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }else{
              document.getElementById('videolinkBtn').innerHTML = 'Update Policy';
              document.getElementById('messVideo').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
              document.getElementById('videolinkBtn').disabled = false;
              setTimeout(function () {
                window.location.reload();
              }, 3000);
              return false;
            }
          }
        });
        event.preventDefault();
      }else{
        document.getElementById('messVideo').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
        document.getElementById('videolinkBtn').innerHTML = "Retry";
        document.getElementById('videolinkBtn').disabled = false;
      }
    });

  });
</script>

<script type="text/javascript">
  var prv_val,f_val;
  $('#bizstate').change(function() {
    var new_val = $(this).val();
    if(new_val != ""){
      prv_val = $('#state_selected').val();
      if(prv_val != ""){
        f_val = prv_val + "," + new_val;
      }
      else {
        f_val = new_val;
      }
      $('#state_selected').val(f_val);
    }
  });

  var prv_val2,f_val2;
  $('#bizmarket').change(function() {
    var new_val2 = $(this).val();
    if(new_val2 != ""){
      prv_val2 = $('#selected_market').val();
      if(prv_val2 != ""){
        f_val2 = prv_val2 + "," + new_val2;
      }
      else {
        f_val2 = new_val2;
      }
      $('#selected_market').val(f_val2);
    }
  });
</script>
